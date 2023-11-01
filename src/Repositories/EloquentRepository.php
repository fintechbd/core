<?php

namespace Fintech\Core\Repositories;

use Fintech\Core\Exceptions\RelationReturnMissingException;
use Fintech\Core\Supports\Constant;
use Fintech\Core\Traits\HasUploadFiles;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;
use ReflectionClass;
use Throwable;

/**
 * Class EloquentRepository
 */
abstract class EloquentRepository
{
    use HasUploadFiles;

    protected ?Model $model;

    protected array $fields = [];

    protected array $relations = [];

    protected bool $hasFileUploads;

    /**
     * split the direct model fields and relational fields
     *
     * @return void
     *
     * @throws RelationReturnMissingException
     * @throws \ReflectionException
     */
    protected function splitFieldRelationFilesFromInput(array $inputs)
    {
        $fileGroups = [];

        $reflection = new ReflectionClass($this->model);

        $this->hasFileUploads = method_exists($this->model, "getRegisteredMediaCollections");

        if ($this->hasFileUploads) {
            $fileGroups = $this->model->getRegisteredMediaCollections()->pluck('name')->toArray();
        }

        foreach ($inputs as $field => $value) {
            //Relation
            if ($reflection->hasMethod($field)) {
                $reflectionMethod = $reflection->getMethod($field);
                if (!$reflectionMethod->hasReturnType()) {
                    throw (new RelationReturnMissingException())
                        ->setModel($reflectionMethod->class, $reflectionMethod->name);
                }

                $this->relations[$field] = ['type' => (string)$reflectionMethod->getReturnType(), 'value' => $value];
                continue;
            }
            //File
            if ($this->hasFileUploads && in_array($field, $fileGroups)) {
                $this->files[$field] = $value;
                continue;

            }//Direct Field

            $this->fields[$field] = $value;
        }
    }

    /**
     * Create a new entry resource
     *
     * @param array $attributes
     * @return Model|null
     */
    public function create(array $attributes = [])
    {
        return DB::transaction(function () use (&$attributes) {

            $this->splitFieldRelationFilesFromInput($attributes);

            $this->model->fill($this->fields);

            if ($this->model->save()) {

                $this->relationCreateOperation();

                if ($this->hasFileUploads) {
                    $this->uploadMediaFiles();
                }
                return $this->model;
            }

            return null;
        });
    }

    /**
     * find and delete a entry from records
     *
     * @param int|string $id
     * @param bool $onlyTrashed
     * @return Model|null
     */
    public function find(int|string $id, $onlyTrashed = false)
    {
        if ($onlyTrashed) {
            if (!method_exists($this->model, 'restore')) {
                throw new InvalidArgumentException('This model does not have `Illuminate\Database\Eloquent\SoftDeletes` trait to perform trash check.');
            }

            return $this->model->onlyTrashed()->find($id);
        }

        return $this->model->find($id);
    }

    /**
     * find and update a resource attributes
     *
     * @param int|string $id
     * @param array $attributes
     * @return Model|null
     */
    public function update(int|string $id, array $attributes = [])
    {
        $this->model = $this->find($id);

        if (!$this->model) {
            throw (new ModelNotFoundException())->setModel(
                get_class($this->model),
                array_diff([$id], $this->model->modelKeys())
            );
        }

        return DB::transaction(function () use (&$attributes) {

            $this->splitFieldRelationFilesFromInput($attributes);

            if ($this->model->update($this->fields)) {

                $this->relationUpdateOperation();

                if ($this->hasFileUploads) {
                    $this->uploadMediaFiles();
                }

                return $this->model;
            }

            return null;
        });

    }

    /**
     * find and delete a entry from records
     *
     * @param int|string $id
     * @return bool|null
     *
     * @throws Throwable
     */
    public function delete(int|string $id)
    {
        $model = $this->find($id);

        if (!$model) {
            throw (new ModelNotFoundException())->setModel(
                get_class($this->model),
                array_diff([$id], $this->model->modelKeys())
            );
        }

        return $model->deleteOrFail();
    }

    /**
     * find and restore a entry from records
     *
     * @param int|string $id
     * @return bool
     *
     */
    public function restore(int|string $id)
    {
        $model = $this->find($id, true);

        if (!$model) {
            throw (new ModelNotFoundException())->setModel(
                get_class($this->model),
                array_diff([$id], $this->model->modelKeys())
            );
        }

        return $model->restore();
    }

    /**
     * @return void
     */
    private function relationCreateOperation()
    {
        if (empty($this->relations)) {
            return;
        }

        foreach ($this->relations as $relation => $params) {
            switch ($params['type']) {
                case BelongsToMany::class:

                    $this->model->{$relation}()->sync($params['value']);
                    break;

                case HasOne::class:

                    $this->model->{$relation}()->create($params['value']);
                    break;

                case HasMany::class:

                    $this->model->{$relation}()->createMany($params['value']);
                    break;

                default:
                    break;
            }
        }
    }

    /**
     * @param array $relations
     *
     * @return void
     *
     */
    private function relationUpdateOperation()
    {
        if (empty($this->relations)) {
            return;
        }

        foreach ($this->relations as $relation => $params) {
            switch ($params['type']) {
                case BelongsToMany::class:

                    $this->model->{$relation}()->sync($params['value']);
                    break;

                    //                case HasOne::class:
                    //
                    //                    $this->model->{$relation}()->create($params['value']);
                    //                    break;
                    //
                    //                case HasMany::class:
                    //
                    //                    $this->model->{$relation}()->createMany($params['value']);
                    //                    break;

                default:
                    break;
            }
        }
    }

    /**
     * @param Builder $query
     * @return Builder[]|Paginator|Collection
     */
    public function executeQuery(Builder $query, array $options = [])
    {
        $asPagination = $options['paginate'] ?? request()->boolean('paginate');

        $perPageCount = $options['per_page'] ?? request()->integer('per_page', array_key_first(Constant::PAGINATE_LENGTHS));

        $paginateMethod = config('fintech.core.pagination_type', 'paginate');

        if (!method_exists($query, $paginateMethod)) {
            throw new \BadMethodCallException("Invalid pagination type [$paginateMethod] configured for `Illuminate\Database\Eloquent\Builder`.");
        }

        return ($asPagination)
            ? $query->{$paginateMethod}($perPageCount)
            : $query->get();
    }
}

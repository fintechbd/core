<?php

namespace Fintech\Core\Repositories;

use Fintech\Core\Exceptions\RelationReturnMissingException;
use Fintech\Core\Supports\Constant;
use Fintech\Core\Traits\HasUploadFiles;
use Illuminate\Contracts\Container\BindingResolutionException;
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

    /**
     * @var array $fields model direct assignable fields
     */
    protected array $fields = [];

    /**
     * @var array $relations model relation fields
     */
    protected array $relations = [];

    /**
     * @var bool $hasFileUploads if this model has file upload
     */
    protected bool $hasFileUploads;
    /**
     * @var bool $useTransaction if this model has file upload
     */
    protected bool $useTransaction = false;

    /**
     * split the direct model fields and relational fields
     *
     * @param array $inputs
     * @return void
     *
     * @throws RelationReturnMissingException
     * @throws \ReflectionException
     */
    protected function splitFieldRelationFilesFromInput(array $inputs): void
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
                if (!empty($value)) {
                    $this->files[$field] = $value;
                }
                continue;

            }//Direct Field

            $this->fields[$field] = $value;
        }
    }

    /**
     * create a new resource
     *
     * @param array $attributes
     * @return Model|mixed|null
     * @throws RelationReturnMissingException
     * @throws \ReflectionException
     * @throws BindingResolutionException
     */
    public function create(array $attributes = []): mixed
    {
        $this->splitFieldRelationFilesFromInput($attributes);

        $this->model = app()->make(get_class($this->model));

        return ($this->useTransaction) ? DB::transaction(fn() => $this->executeCreate()) : $this->executeCreate();
    }

    /**
     * @throws \Exception
     */
    private function executeCreate(): ?Model
    {
        $this->model->fill($this->fields);

        if ($this->model->save()) {

            $this->relationCreateOperation();

            if ($this->hasFileUploads) {
                $this->uploadMediaFiles();
            }
            return $this->model;
        }

        return null;
    }

    /**
     * find and delete a entry from records
     *
     * @param int|string $id
     * @param bool $onlyTrashed
     * @return Model|null
     */
    public function find(int|string $id, bool $onlyTrashed = false): ?Model
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
     * @throws \Exception
     */
    public function update(int|string $id, array $attributes = []): ?Model
    {
        $this->model = $this->find($id);

        if (!$this->model) {
            throw (new ModelNotFoundException())->setModel(
                get_class($this->model),
                array_diff([$id], $this->model->modelKeys())
            );
        }

        $this->splitFieldRelationFilesFromInput($attributes);

        return ($this->useTransaction) ? DB::transaction(fn() => $this->executeUpdate()) : $this->executeUpdate();

    }

    /**
     * @throws \Exception
     */
    private function executeUpdate(): ?Model
    {
        if ($this->model->update($this->fields)) {

            $this->relationUpdateOperation();

            if ($this->hasFileUploads) {
                $this->uploadMediaFiles();
            }

            return $this->model;
        }

        return null;
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

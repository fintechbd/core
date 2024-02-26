<?php

namespace Fintech\Core\Repositories;

use Exception;
use Fintech\Core\Exceptions\RelationReturnMissingException;
use Fintech\Core\Models\ApiLog;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use ReflectionException;

/**
 * Class EloquentRepository
 */
abstract class EloquentRepository
{
    use \Fintech\Core\Traits\HasUploadFiles;
    public function __construct(string $className)
    {
        $model = app($className);

        if (!$model instanceof Model) {
            throw new \InvalidArgumentException("Eloquent repository require model class to be `Illuminate\Database\Eloquent\Model` instance.");
        }

        $this->model = $model;
    }

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
     * create a new resource
     *
     * @param array $attributes
     * @return Model|mixed|null
     * @throws RelationReturnMissingException
     * @throws ReflectionException
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     * @throws Exception
     */
    public function create(array $attributes = []): mixed
    {
        $this->splitFieldRelationFilesFromInput($attributes);

        $this->model = app()->make(get_class($this->model));

        return ($this->useTransaction)
            ? \DB::transaction(fn() => $this->executeCreate())
            : $this->executeCreate();
    }

    /**
     * split the direct model fields and relational fields
     *
     * @param array $inputs
     * @return void
     *
     * @throws RelationReturnMissingException
     * @throws ReflectionException
     */
    protected function splitFieldRelationFilesFromInput(array $inputs): void
    {
        $fileGroups = [];

        $reflection = new \ReflectionClass($this->model);

        $this->hasFileUploads = method_exists($this->model, "getRegisteredMediaCollections");

        if ($this->hasFileUploads) {
            $fileGroups = $this->model->getRegisteredMediaCollections()->pluck('name')->toArray();
        }

        foreach ($inputs as $field => $value) {
            //Relation
            $relationName = \Illuminate\Support\Str::camel($field);
            if ($reflection->hasMethod($relationName)) {
                $reflectionMethod = $reflection->getMethod($relationName);
                if (!$reflectionMethod->hasReturnType()) {
                    throw (new RelationReturnMissingException())
                        ->setModel($reflectionMethod->class, $reflectionMethod->name);
                }

                $this->relations[$relationName] = ['type' => (string)$reflectionMethod->getReturnType(), 'value' => $value];
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
     * @throws Exception
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
     * find and update a resource attributes
     *
     * @param int|string $id
     * @param array $attributes
     * @return Model|null
     * @throws Exception
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

        return ($this->useTransaction)
            ? \DB::transaction(fn() => $this->executeUpdate())
            : $this->executeUpdate();
    }

    /**
     * find and delete a entry from records
     *
     * @param int|string $id
     * @param bool $onlyTrashed
     * @return Model|null
     */
    public function find(int|string $id, $onlyTrashed = false): ?Model
    {
        if ($onlyTrashed) {
            if (!method_exists($this->model, 'restore')) {
                throw new \InvalidArgumentException('This model does not have `Illuminate\Database\Eloquent\SoftDeletes` trait to perform trash check.');
            }

            return $this->model->onlyTrashed()->find($id);
        }

        return $this->model->find($id);
    }

    /**
     * @throws Exception
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
     * find and delete a entry from records
     *
     * @param int|string $id
     * @return bool|null
     *
     * @throws \Throwable
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
     * @param Builder $query
     * @param array $options
     * @return Builder[]|Paginator|\Illuminate\Support\Collection
     */
    public function executeQuery(Builder $query, array $options = [])
    {
        $asPagination = $options['paginate'] ?? request()->boolean('paginate');

        $perPageCount = $options['per_page'] ?? request()->integer('per_page', array_key_first(\Fintech\Core\Supports\Constant::PAGINATE_LENGTHS));

        $paginateMethod = config('fintech.core.pagination_type', 'paginate');

        if (!method_exists($query, $paginateMethod)) {
            throw new \BadMethodCallException("Invalid pagination type [$paginateMethod] configured for `Illuminate\Database\Eloquent\Builder`.");
        }

        return ($asPagination)
            ? $query->{$paginateMethod}($perPageCount)->withQueryString()
            : $query->get();
    }
}

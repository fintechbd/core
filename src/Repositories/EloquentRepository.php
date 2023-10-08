<?php

namespace Fintech\Core\Repositories;

use Fintech\Core\Exceptions\RelationReturnMissingException;
use Fintech\Core\Supports\Constant;
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
    protected ?Model $model;

    protected string $paginateFunction;

    /**
     * split the direct model fields and relational fields
     *
     * @return array[]
     *
     * @throws RelationReturnMissingException
     * @throws \ReflectionException
     */
    protected function splitDirectAndRelationFields(array $inputs)
    {
        $reflection = new ReflectionClass($this->model);

        $directFields = [];

        $relationFields = [];

        foreach ($inputs as $field => $value) {

            if ($reflection->hasMethod($field)) {

                $reflectionMethod = $reflection->getMethod($field);

                if (!$reflectionMethod->hasReturnType()) {
                    throw (new RelationReturnMissingException())
                        ->setModel($reflectionMethod->class, $reflectionMethod->name);
                }

                $relationFields[$field] = ['type' => (string)$reflectionMethod->getReturnType(), 'value' => $value];

                continue;
            }

            $directFields[$field] = $value;
        }

        return [$directFields, $relationFields];
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

            [$directFields, $relationFields] = $this->splitDirectAndRelationFields($attributes);

            $this->model->fill($directFields);

            if ($this->model->save()) {

                $this->relationCreateOperation($relationFields);

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

            [$directFields, $relationFields] = $this->splitDirectAndRelationFields($attributes);

            if ($this->model->update($directFields)) {

                $this->relationUpdateOperation($relationFields);

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
     * @param array $relations
     *
     * @return void
     *
     */
    private function relationCreateOperation(array $relations = [])
    {
        if (empty($relations)) {
            return;
        }

        foreach ($relations as $relation => $params) {
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
    private function relationUpdateOperation(array $relations = [])
    {
        if (empty($relations)) {
            return;
        }

        foreach ($relations as $relation => $params) {
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
    public function executeQuery(Builder $query)
    {
        $asPagination = request('paginate', false);

        $perPageCount = request('per_page', array_key_first(Constant::PAGINATE_LENGTHS));

        $paginateMethod = config('fintech.core.pagination_type', 'paginate');

        if (!method_exists($query, $paginateMethod)) {
            throw new \BadMethodCallException("Invalid pagination type [$paginateMethod] configured for `Illuminate\Database\Eloquent\Builder`.");
        }

        return ($asPagination)
            ? $query->{$paginateMethod}($perPageCount)
            : $query->get();
    }
}

<?php

namespace Fintech\Core\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use InvalidArgumentException;

/**
 * Class EloquentRepository
 * @package Fintech\Core\Repositories
 */
abstract class EloquentRepository
{
    /**
     * @var Model $model
     */
    protected Model $model;

    /**
     * return a list or pagination of items from
     * filtered options
     *
     * @return LengthAwarePaginator|Builder[]|Collection
     */
    abstract public function list(array $filters = []);

    /**
     * Create a new entry resource
     *
     * @param array $attributes
     * @return Model|null
     *
     * @throws \Throwable
     */
    public function create(array $attributes = [])
    {
        $this->model->fill($attributes);

        if ($this->model->saveOrFail()) {

            $this->model->refresh();

            return $this->model;
        }

        return null;
    }

    /**
     * find and delete a entry from records
     *
     * @param  bool  $onlyTrashed
     * @return Model|null
     *
     */
    public function find(int|string $id, $onlyTrashed = false)
    {
        if($onlyTrashed) {
            if (! method_exists($this->model, 'restore')) {
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
     * @param  array $attributes
     * @return Model|null
     *
     */
    public function update(int|string $id, array $attributes = [])
    {
        $model = $this->read($id);

        if (!$model) {
            throw (new ModelNotFoundException)->setModel(
                get_class($model), array_diff([$id], $this->model->modelKeys())
            );
        }

        if ($model->updateOrFail($attributes)) {

            $this->model->refresh();

            return $this->model;
        }

        return null;
    }

    /**
     * find and delete a entry from records
     *
     * @return bool|null
     *
     */
    public function delete(int|string $id)
    {
        $model = $this->read($id);

        if (!$model) {
            throw (new ModelNotFoundException)->setModel(
                get_class($model), array_diff([$id], $this->model->modelKeys())
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
            throw (new ModelNotFoundException)->setModel(
                get_class($model), array_diff([$id], $this->model->modelKeys())
            );
        }

        return $model->restore();
    }
}

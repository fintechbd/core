<?php

namespace Fintech\Core\Repositories;

use Fintech\Core\Exceptions\EloquentRepositoryException;
use Fintech\Core\Exceptions\ResourceNotFoundException;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use InvalidArgumentException;

/**
 * Class EloquentRepository
 * @package Fintech\Core\Repositories
 */
abstract class EloquentRepository
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * return a list or pagination of items from
     * filtered options
     *
     * @param array $filters
     * @return LengthAwarePaginator|Builder[]|Collection
     */
    abstract public function list(array $filters = []);

    /**
     * Create a new entry resource
     *
     * @param array $attributes
     * @return Model|null
     *
     * @throws EloquentRepositoryException
     */
    public function create(array $attributes = [])
    {
        try {
            if ($this->model->saveOrFail($attributes)) {

                $this->model->refresh();

                return $this->model;
            }
        } catch (\Throwable $exception) {

            throw new EloquentRepositoryException($exception->getMessage(), 0, $exception);
        }

        return null;
    }

    /**
     * find and update a resource attributes
     *
     * @param int|string $id
     * @param array $attributes
     * @return Model|null
     *
     * @throws EloquentRepositoryException
     */
    public function update(int|string $id, array $attributes = [])
    {
        try {

            $this->model = $this->model->findOrFail($id);

        } catch (\Throwable $exception) {

            throw new ModelNotFoundException($exception->getMessage(), 0, $exception);
        }

        try {
            if ($this->model->updateOrFail($attributes)) {

                $this->model->refresh();

                return $this->model;
            }
        } catch (\Throwable $exception) {

            throw new EloquentRepositoryException($exception->getMessage(), 0, $exception);
        }

        return null;
    }

    /**
     * find and delete a entry from records
     *
     * @param  bool  $onlyTrashed
     * @return Model|null
     *
     * @throws ResourceNotFoundException
     */
    public function read(int|string $id, $onlyTrashed = false)
    {
        try {

            return ($onlyTrashed)
                ? $this->model->onlyTrashed()->findOrFail($id) /** @phpstan-ignore-line */
                : $this->model->findOrFail($id);

        } catch (\Throwable $exception) {

            throw new ResourceNotFoundException($exception->getMessage(), 0, $exception);
        }
    }

    /**
     * find and delete a entry from records
     *
     * @return bool|null
     *
     * @throws EloquentRepositoryException
     * @throws ResourceNotFoundException
     */
    public function delete(int|string $id)
    {
        try {

            $this->model = $this->model->findOrFail($id);

        } catch (\Throwable $exception) {

            throw new ResourceNotFoundException($exception->getMessage(), 0, $exception);
        }

        try {

            return $this->model->deleteOrFail();

        } catch (\Throwable $exception) {

            throw new EloquentRepositoryException($exception->getMessage(), 0, $exception);
        }
    }

    /**
     * find and restore a entry from records
     *
     * @return bool|null
     *
     * @throws EloquentRepositoryException
     */
    public function restore(int|string $id)
    {
        if (! method_exists($this->model, 'restore')) {
            throw new InvalidArgumentException('This model does not have `Illuminate\Database\Eloquent\SoftDeletes` Trait to perform restoration.');
        }

        try {

            /** @phpstan-ignore-next-line */
            $this->model = $this->model->onlyTrashed()->findOrFail($id);

        } catch (\Throwable $exception) {

            throw new ResourceNotFoundException($exception->getMessage(), 0, $exception);
        }

        try {

            return $this->model->restore();

        } catch (\Throwable $exception) {

            throw new EloquentRepositoryException($exception->getMessage(), 0, $exception);
        }
    }

    /**
     * return a fresh instance of eloquent query builder
     *
     * @return mixed
     */
    protected function queryBuilder()
    {
        return $this->model->newQuery();
    }

    /**
     * After modifying the query path the query buider
     * to execute method collect output
     *
     * @param  array  $options
     * @return mixed
     */
    protected function execute(&$query, &$options = [])
    {
        $options['sort'] = $options['sort'] ?? $this->model->getKeyName();
        $options['dir'] = $options['dir'] ?? 'desc';
        $options['paginate'] = $options['paginate'] ?? false;
        $options['per_page'] = $options['per_page'] ?? $this->model->getPerPage();
        $options['page'] = $options['page'] ?? 1;

        //Handle Sorting
        $query->orderBy($options['sort'], $options['direction']);

        //Prepare Output
        if (isset($options['paginate']) && $options['paginate'] == true) {
            return $query->paginate($options['per_page'], ['*'], 'page', $options['page']);
        } elseif (isset($options['paginate']) && $options['paginate'] == 'simple') {
            return $query->simplePaginate($options['per_page'], ['*'], 'page', $options['page']);
        } else {
            return $query->get();
        }
    }
}

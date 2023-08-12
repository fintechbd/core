<?php


namespace Fintech\Core\Abstracts;


use Fintech\Core\Exceptions\MongodbRepositoryException;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Jenssegers\Mongodb\Collection;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\ModelNotFoundException;

abstract class MongodbRepository
{
    /**
     * @var Jenssegers\Mongodb\Eloquent\Model $model
     */
    protected $model;

    /**
     * return a list or pagination of items from
     * filtered options
     *
     * @param array $filters
     * @return LengthAwarePaginator|Builder[]|Collection
     */
    public abstract function list(array $filters = []);

    /**
     * Create a new entry resource
     *
     * @param array $attributes
     * @return Model|null
     * @throws MongodbRepositoryException
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
     * @throws MongodbRepositoryException
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
     * @param string|int $id
     * @param bool $onlyTrashed
     * @return bool|null
     * @throws MongodbRepositoryException
     */
    public function read(int|string $id, $onlyTrashed = false)
    {
        try {

            return ($onlyTrashed)
                ? $this->model->onlyTrashed()->findOrFail($id)
                : $this->model->findOrFail($id);

        } catch (\Throwable $exception) {

            throw new ModelNotFoundException($exception->getMessage(), 0, $exception);
        }

        return null;
    }

    /**
     * find and delete a entry from records
     *
     * @param string|int $id
     * @return bool|null
     * @throws MongodbRepositoryException
     */
    public function delete(int|string $id)
    {
        try {

            $this->model = $this->model->findOrFail($id);

        } catch (\Throwable $exception) {

            throw new ModelNotFoundException($exception->getMessage(), 0, $exception);
        }

        try {

            return $this->model->deleteOrFail();

        } catch (\Throwable $exception) {

            throw new EloquentRepositoryException($exception->getMessage(), 0, $exception);
        }

        return null;
    }

    /**
     * find and restore a entry from records
     *
     * @param string|int $id
     * @return bool|null
     * @throws MongodbRepositoryException
     */
    public function restore(int|string $id)
    {
        if (!method_exists($this->model, 'restore')) {
            throw new InvalidArgumentException('This model does not have `Jenssegers\Mongodb\Eloquent\SoftDeletes` Trait to perform restoration.');
        }

        try {

            $this->model = $this->model->onlyTrashed()->findOrFail($id);

        } catch (\Throwable $exception) {

            throw new ModelNotFoundException($exception->getMessage(), 0, $exception);
        }

        try {

            return $this->model->restore();

        } catch (\Throwable $exception) {

            throw new EloquentRepositoryException($exception->getMessage(), 0, $exception);
        }

        return null;
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
     * @param $query
     * @param array $options
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
        } else if (isset($options['paginate']) && $options['paginate'] == 'simple') {
            return $query->simplePaginate($options['per_page'], ['*'], 'page', $options['page']);
        } else {
            return $query->get();
        }
    }
}

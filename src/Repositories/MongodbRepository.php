<?php

namespace Fintech\Core\Repositories;

use Fintech\Core\Supports\Constant;
use Fintech\Core\Traits\HasUploadFiles;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use InvalidArgumentException;
use MongoDB\Laravel\Collection;
use MongoDB\Laravel\Eloquent\Builder;
use MongoDB\Laravel\Eloquent\Model;
use Throwable;

/**
 * Class MongodbRepository
 */
abstract class MongodbRepository
{
    use HasUploadFiles;

    protected Model $model;

    /**
     * Create a new entry resource
     *
     * @return Model|null
     *
     * @throws Throwable
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
     * @throws Throwable
     */
    public function find(int|string $id, $onlyTrashed = false)
    {
        if ($onlyTrashed) {
            if (!method_exists($this->model, 'restore')) {
                throw new InvalidArgumentException('This model does not have `MongoDB\Laravel\Eloquent\SoftDeletes` trait to perform trash check.');
            }

            return $this->model->onlyTrashed()->find($id);
        }

        return $this->model->find($id);
    }

    /**
     * find and update a resource attributes
     *
     * @return Model|null
     *
     * @throws Throwable
     */
    public function update(int|string $id, array $attributes = [])
    {
        $model = $this->find($id);

        if (!$model) {
            throw (new ModelNotFoundException())->setModel(
                get_class($model),
                array_diff([$id], $this->model->modelKeys())
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
     * @throws Throwable
     */
    public function delete(int|string $id)
    {
        $model = $this->find($id);

        if (!$model) {
            throw (new ModelNotFoundException())->setModel(
                get_class($model),
                array_diff([$id], $this->model->modelKeys())
            );
        }

        return $model->deleteOrFail();
    }

    /**
     * find and restore a entry from records
     *
     * @return bool
     *
     * @throws Throwable
     */
    public function restore(int|string $id)
    {
        $model = $this->find($id, true);

        if (!$model) {
            throw (new ModelNotFoundException())->setModel(
                get_class($model),
                array_diff([$id], $this->model->modelKeys())
            );
        }

        return $model->restore();
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
            ? $query->{$paginateMethod}($perPageCount)->withQueryString()
            : $query->get();
    }
}

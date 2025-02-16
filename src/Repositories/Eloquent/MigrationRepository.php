<?php

namespace Fintech\Core\Repositories\Eloquent;

use Fintech\Core\Repositories\EloquentRepository;
use Fintech\Core\Interfaces\MigrationRepository as InterfacesMigrationRepository;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class MigrationRepository
 * @package Fintech\Core\Repositories\Eloquent
 */
class MigrationRepository extends EloquentRepository implements InterfacesMigrationRepository
{
    public function __construct()
    {
        parent::__construct(config('fintech.core.migration_model', \Fintech\Core\Models\Migration::class));
    }

    /**
     * return a list or pagination of items from
     * filtered options
     *
     * @return Paginator|Collection
     */
    public function list(array $filters = [])
    {
        $query = $this->model->newQuery();

        $query->where(function ($query) use ($filters) {
            return $query->where('migration', 'like', '%' . $filters['search'] . '%')
                ->orWhere('batch', 'like', '%' . $filters['search'] . '%');
        });

        if (!empty($filters['id_in'])) {
            $query->where('id_in', $filters['id_in']);
        }

        if (!empty($filters['migration'])) {
            $query->where('migration', (array)$filters['migration']);
        }

        //Handle Sorting
        $query->orderBy($filters['sort'] ?? $this->model->getKeyName(), $filters['dir'] ?? 'desc');

        //Execute Output
        return $this->executeQuery($query, $filters);

    }
}

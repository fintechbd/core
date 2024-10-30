<?php

namespace Fintech\Core\Repositories\Eloquent;

use Fintech\Core\Interfaces\ApiLogRepository as InterfacesApiLogRepository;
use Fintech\Core\Models\ApiLog;
use Fintech\Core\Repositories\EloquentRepository;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class ApiLogRepository
 * @package Fintech\Core\Repositories\Eloquent
 */
class ApiLogRepository extends EloquentRepository implements InterfacesApiLogRepository
{
    public function __construct()
    {
        parent::__construct(config('fintech.core.api_log_model', ApiLog::class));
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

        //Searching
        if (!empty($filters['search'])) {
            $query->where($this->model->getKeyName(), 'like', "%{$filters['search']}%")
                ->orWhere('request_id', '=', $filters['search'])
                ->orWhere('user_id', '=', $filters['search'])
                ->orWhere('method', '=', $filters['search'])
                ->orWhere('ip_address', '=', $filters['search'])
                ->orWhere('status_code', '=', $filters['search'])
                ->orWhere('host', 'like', "%{$filters['search']}%")
                ->orWhere('direction', 'like', "%{$filters['search']}%")
                ->orWhere('url', 'like', "%{$filters['search']}%")
                ->orWhere('request', 'like', "%{$filters['search']}%")
                ->orWhere('response', 'like', "%{$filters['search']}%")
                ->orWhere('user_agent', 'like', "%{$filters['search']}%");
        }

        if (!empty($filters['id_not_in'])) {
            $query->whereNotIn($this->model->getKeyName(), (array)$filters['id_not_in']);
        }

        if (!empty($filters['id_in'])) {
            $query->whereIn($this->model->getKeyName(), (array)$filters['id_in']);
        }

        if (!empty($filters['method'])) {
            $query->where('method', $filters['method']);
        }

        if (!empty($filters['direction'])) {
            $query->where('direction', '=', $filters['direction']);
        }

        //Display Trashed
        if (isset($filters['trashed']) && $filters['trashed'] === true) {
            $query->onlyTrashed();
        }

        //Handle Sorting
        $query->orderBy($filters['sort'] ?? $this->model->getKeyName(), $filters['dir'] ?? 'asc');

        //Execute Output
        return $this->executeQuery($query, $filters);

    }
}

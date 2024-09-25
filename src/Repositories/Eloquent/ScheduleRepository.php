<?php

namespace Fintech\Core\Repositories\Eloquent;

use Fintech\Core\Interfaces\ScheduleRepository as InterfacesScheduleRepository;
use Fintech\Core\Models\Schedule;
use Fintech\Core\Repositories\EloquentRepository;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class ScheduleRepository
 * @package Fintech\Core\Repositories\Eloquent
 */
class ScheduleRepository extends EloquentRepository implements InterfacesScheduleRepository
{
    public function __construct()
    {
        parent::__construct(config('fintech.core.schedule_model', Schedule::class));
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
            if (is_numeric($filters['search'])) {
                $query->where($this->model->getKeyName(), 'like', "%{$filters['search']}%");
            } else {
                $query->where('name', 'like', "%{$filters['search']}%");
                $query->orWhere('schedule_data', 'like', "%{$filters['search']}%");
            }
        }

        if (!empty($filters['command'])) {
            $query->where('command', '=', $filters['command']);
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

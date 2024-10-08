<?php

namespace Fintech\Core\Repositories\Eloquent;

use Fintech\Core\Interfaces\SettingRepository as InterfacesSettingRepository;
use Fintech\Core\Models\Setting;
use Fintech\Core\Repositories\EloquentRepository;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class SettingRepository
 * @package Fintech\Core\Repositories\Eloquent
 */
class SettingRepository extends EloquentRepository implements InterfacesSettingRepository
{
    public function __construct()
    {
        parent::__construct(config('fintech.core.setting_model', Setting::class));
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

        if (!empty($filters['user_id'])) {
            $query->where('user_id', $filters['user_id']);
        } else {
            $query->whereNull('user_id');
        }

        //Searching
        if (!empty($filters['search'])) {
            if (is_numeric($filters['search'])) {
                $query->where($this->model->getKeyName(), 'like', "%{$filters['search']}%");
            } else {
                $query->where('name', 'like', "%{$filters['search']}%");
            }
        }

        if (!empty($filters['package'])) {
            $query->where('package', '=', strtolower($filters['package']));
        }

        if (!empty($filters['id_not_in'])) {
            $query->whereNotIn($this->model->getKeyName(), (array)$filters['id_not_in']);
        }

        if (!empty($filters['id_in'])) {
            $query->whereIn($this->model->getKeyName(), (array)$filters['id_in']);
        }

        if (!empty($filters['key'])) {
            $query->where('key', '=', $filters['key']);
        }

        if (!empty($filters['type'])) {
            $query->where('type', '=', $filters['type']);
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

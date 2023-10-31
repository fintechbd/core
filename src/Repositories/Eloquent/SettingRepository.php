<?php

namespace Fintech\Core\Repositories\Eloquent;

use Fintech\Core\Interfaces\SettingRepository as InterfacesSettingRepository;
use Fintech\Core\Repositories\EloquentRepository;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use InvalidArgumentException;

/**
 * Class SettingRepository
 * @package Fintech\Core\Repositories\Eloquent
 */
class SettingRepository extends EloquentRepository implements InterfacesSettingRepository
{
    public function __construct()
    {
        $model = app(config('fintech.core.setting_model', \Fintech\Core\Models\Setting::class));

        if (!$model instanceof Model) {
            throw new InvalidArgumentException("Eloquent repository require model class to be `Illuminate\Database\Eloquent\Model` instance.");
        }

        $this->model = $model;
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

        if (isset($filters['user_id']) && !empty($filters['user_id'])) {
            $query->where('user_id', $filters['user_id']);
        } else {
            $query->whereNull('user_id');
        }

        //Searching
        if (isset($filters['search']) && ! empty($filters['search'])) {
            if (is_numeric($filters['search'])) {
                $query->where($this->model->getKeyName(), 'like', "%{$filters['search']}%");
            } else {
                $query->where('name', 'like', "%{$filters['search']}%");
            }
        }

        if (isset($filters['package']) && !empty($filters['package'])) {
            $query->where('package', '=', strtolower($filters['package']));
        }

        if (isset($filters['key']) && !empty($filters['key'])) {
            $query->where('key', '=', $filters['key']);
        }

        if (isset($filters['type']) && !empty($filters['type'])) {
            $query->where('type', '=', $filters['type']);
        }

        //Display Trashed
        if (isset($filters['trashed']) && !empty($filters['trashed'])) {
            $query->onlyTrashed();
        }

        //Handle Sorting
        $query->orderBy($filters['sort'] ?? $this->model->getKeyName(), $filters['dir'] ?? 'asc');

        //Execute Output
        return $this->executeQuery($query, $filters);

    }
}

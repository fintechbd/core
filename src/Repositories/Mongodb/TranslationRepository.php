<?php

namespace Fintech\Core\Repositories\Mongodb;

use Fintech\Core\Interfaces\TranslationRepository as InterfacesTranslationRepository;
use Fintech\Core\Repositories\MongodbRepository;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class TranslationRepository
 * @package Fintech\Core\Repositories\Mongodb
 */
class TranslationRepository extends MongodbRepository implements InterfacesTranslationRepository
{
    public function __construct()
    {
        parent::__construct(config('fintech.core.translation_model', \Fintech\Core\Models\Translation::class));
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
        if (! empty($filters['search'])) {
            if (is_numeric($filters['search'])) {
                $query->where($this->model->getKeyName(), 'like', "%{$filters['search']}%");
            } else {
                $query->where('name', 'like', "%{$filters['search']}%");
                $query->orWhere('translation_data', 'like', "%{$filters['search']}%");
            }
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

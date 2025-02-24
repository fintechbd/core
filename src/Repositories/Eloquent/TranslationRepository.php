<?php

namespace Fintech\Core\Repositories\Eloquent;

use Fintech\Core\Interfaces\TranslationRepository as InterfacesTranslationRepository;
use Fintech\Core\Models\Translation;
use Fintech\Core\Repositories\EloquentRepository;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class TranslationRepository
 * @package Fintech\Core\Repositories\Eloquent
 */
class TranslationRepository extends EloquentRepository implements InterfacesTranslationRepository
{
    public function __construct()
    {
        parent::__construct(config('fintech.core.translation_model', Translation::class));
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
            $query->where(function ($query) use ($filters) {
                return $query->where('key', 'like', '%' . $filters['search'] . '%')
                    ->orWhere('locale', 'like', '%' . $filters['search'] . '%');
            });
        }

        if (!empty($filters['key'])) {
            $query->where('key', '=', $filters['search']);
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

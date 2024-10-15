<?php

namespace Fintech\Core\Repositories\Mongodb;

use Fintech\Core\Repositories\MongodbRepository;
use Fintech\Core\Interfaces\JobBatchRepository as InterfacesJobBatchRepository;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;
use MongoDB\Laravel\Eloquent\Model;
use InvalidArgumentException;

/**
 * Class JobBatchRepository
 * @package Fintech\Core\Repositories\Mongodb
 */
class JobBatchRepository extends MongodbRepository implements InterfacesJobBatchRepository
{
    public function __construct()
    {
       parent::__construct(config('fintech.core.job_batch_model', \Fintech\Core\Models\JobBatch::class));
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
                $query->orWhere('job_batch_data', 'like', "%{$filters['search']}%");
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
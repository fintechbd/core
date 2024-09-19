<?php

namespace Fintech\Core\Services;

use Fintech\Core\Interfaces\FailedJobRepository;

/**
 * Class FailedJobService
 * @package Fintech\Core\Services
 *
 */
class FailedJobService
{
    use \Fintech\Core\Traits\HasFindWhereSearch;

    /**
     * FailedJobService constructor.
     * @param FailedJobRepository $failedJobRepository
     */
    public function __construct(private readonly FailedJobRepository $failedJobRepository)
    {
    }

    public function find($id, $onlyTrashed = false)
    {
        return $this->failedJobRepository->find($id, $onlyTrashed);
    }

    public function update($id, array $inputs = [])
    {
        return $this->failedJobRepository->update($id, $inputs);
    }

    public function destroy($id)
    {
        return $this->failedJobRepository->delete($id);
    }

    public function restore($id)
    {
        return $this->failedJobRepository->restore($id);
    }

    public function export(array $filters)
    {
        return $this->failedJobRepository->list($filters);
    }

    /**
     * @param array $filters
     * @return mixed
     */
    public function list(array $filters = [])
    {
        return $this->failedJobRepository->list($filters);

    }

    public function import(array $filters)
    {
        return $this->failedJobRepository->create($filters);
    }

    public function create(array $inputs = [])
    {
        return $this->failedJobRepository->create($inputs);
    }
}

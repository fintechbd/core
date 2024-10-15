<?php

namespace Fintech\Core\Services;

use Fintech\Core\Interfaces\JobBatchRepository;

/**
 * Class JobBatchService
 * @package Fintech\Core\Services
 *
 */
class JobBatchService
{
    /**
     * JobBatchService constructor.
     * @param JobBatchRepository $jobBatchRepository
     */
    public function __construct(private readonly JobBatchRepository $jobBatchRepository)
    {
    }

    /**
     * @param array $filters
     * @return mixed
     */
    public function list(array $filters = [])
    {
        return $this->jobBatchRepository->list($filters);

    }

    public function create(array $inputs = [])
    {
        return $this->jobBatchRepository->create($inputs);
    }

    public function find($id, $onlyTrashed = false)
    {
        return $this->jobBatchRepository->find($id, $onlyTrashed);
    }

    public function update($id, array $inputs = [])
    {
        return $this->jobBatchRepository->update($id, $inputs);
    }

    public function destroy($id)
    {
        return $this->jobBatchRepository->delete($id);
    }

    public function restore($id)
    {
        return $this->jobBatchRepository->restore($id);
    }

    public function export(array $filters)
    {
        return $this->jobBatchRepository->list($filters);
    }

    public function import(array $filters)
    {
        return $this->jobBatchRepository->create($filters);
    }
}

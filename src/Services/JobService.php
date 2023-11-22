<?php

namespace Fintech\Core\Services;

use Fintech\Core\Interfaces\JobRepository;

/**
 * Class JobService
 * @package Fintech\Core\Services
 *
 */
class JobService
{
    /**
     * JobService constructor.
     * @param JobRepository $jobRepository
     */
    public function __construct(private readonly JobRepository $jobRepository)
    {
    }

    /**
     * @param array $filters
     * @return mixed
     */
    public function list(array $filters = [])
    {
        return $this->jobRepository->list($filters);

    }

    public function create(array $inputs = [])
    {
        return $this->jobRepository->create($inputs);
    }

    public function find($id, $onlyTrashed = false)
    {
        return $this->jobRepository->find($id, $onlyTrashed);
    }

    public function update($id, array $inputs = [])
    {
        return $this->jobRepository->update($id, $inputs);
    }

    public function destroy($id)
    {
        return $this->jobRepository->delete($id);
    }

    public function restore($id)
    {
        return $this->jobRepository->restore($id);
    }

    public function export(array $filters)
    {
        return $this->permissionRepository->list($filters);
    }

    public function import(array $filters)
    {
        return $this->permissionRepository->create($filters);
    }
}

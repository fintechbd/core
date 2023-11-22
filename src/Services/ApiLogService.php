<?php

namespace Fintech\Core\Services;

use Fintech\Core\Interfaces\ApiLogRepository;

/**
 * Class ApiLogService
 * @package Fintech\Core\Services
 *
 */
class ApiLogService
{
    /**
     * ApiLogService constructor.
     * @param ApiLogRepository $apiLogRepository
     */
    public function __construct(private readonly ApiLogRepository $apiLogRepository)
    {
    }

    /**
     * @param array $filters
     * @return mixed
     */
    public function list(array $filters = [])
    {
        return $this->apiLogRepository->list($filters);

    }

    public function create(array $inputs = [])
    {
        return $this->apiLogRepository->create($inputs);
    }

    public function find($id, $onlyTrashed = false)
    {
        return $this->apiLogRepository->find($id, $onlyTrashed);
    }

    public function update($id, array $inputs = [])
    {
        return $this->apiLogRepository->update($id, $inputs);
    }

    public function destroy($id)
    {
        return $this->apiLogRepository->delete($id);
    }

    public function restore($id)
    {
        return $this->apiLogRepository->restore($id);
    }

    public function export(array $filters)
    {
        return $this->apiLogRepository->list($filters);
    }

    public function import(array $filters)
    {
        return $this->apiLogRepository->create($filters);
    }
}

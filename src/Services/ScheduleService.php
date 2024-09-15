<?php

namespace Fintech\Core\Services;

use Fintech\Core\Interfaces\ScheduleRepository;

/**
 * Class ScheduleService
 * @package Fintech\Core\Services
 *
 */
class ScheduleService
{
    /**
     * ScheduleService constructor.
     * @param ScheduleRepository $scheduleRepository
     */
    public function __construct(private readonly ScheduleRepository $scheduleRepository)
    {
    }

    public function find($id, $onlyTrashed = false)
    {
        return $this->scheduleRepository->find($id, $onlyTrashed);
    }

    public function update($id, array $inputs = [])
    {
        return $this->scheduleRepository->update($id, $inputs);
    }

    public function destroy($id)
    {
        return $this->scheduleRepository->delete($id);
    }

    public function restore($id)
    {
        return $this->scheduleRepository->restore($id);
    }

    public function export(array $filters)
    {
        return $this->scheduleRepository->list($filters);
    }

    /**
     * @param array $filters
     * @return mixed
     */
    public function list(array $filters = [])
    {
        return $this->scheduleRepository->list($filters);

    }

    public function import(array $filters)
    {
        return $this->scheduleRepository->create($filters);
    }

    public function create(array $inputs = [])
    {
        return $this->scheduleRepository->create($inputs);
    }
}

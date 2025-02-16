<?php

namespace Fintech\Core\Services;


use Fintech\Core\Interfaces\MigrationRepository;

/**
 * Class MigrationService
 * @package Fintech\Core\Services
 *
 */
class MigrationService
{
    /**
     * MigrationService constructor.
     * @param MigrationRepository $migrationRepository
     */
    public function __construct(private readonly MigrationRepository $migrationRepository) { }

    /**
     * @param array $filters
     * @return mixed
     */
    public function list(array $filters = [])
    {
        return $this->migrationRepository->list($filters);

    }

    public function create(array $inputs = [])
    {
        return $this->migrationRepository->create($inputs);
    }

    public function find($id, $onlyTrashed = false)
    {
        return $this->migrationRepository->find($id, $onlyTrashed);
    }

    public function update($id, array $inputs = [])
    {
        return $this->migrationRepository->update($id, $inputs);
    }

    public function destroy($id)
    {
        return $this->migrationRepository->delete($id);
    }

    public function restore($id)
    {
        return $this->migrationRepository->restore($id);
    }

    public function export(array $filters)
    {
        return $this->migrationRepository->list($filters);
    }

    public function import(array $filters)
    {
        return $this->migrationRepository->create($filters);
    }
}

<?php

namespace Fintech\Core\Services;


use Fintech\Core\Interfaces\ClientErrorRepository;

/**
 * Class ClientErrorService
 * @package Fintech\Core\Services
 *
 */
class ClientErrorService
{
    /**
     * ClientErrorService constructor.
     * @param ClientErrorRepository $clientErrorRepository
     */
    public function __construct(private readonly ClientErrorRepository $clientErrorRepository) { }

    /**
     * @param array $filters
     * @return mixed
     */
    public function list(array $filters = [])
    {
        return $this->clientErrorRepository->list($filters);

    }

    public function create(array $inputs = [])
    {
        return $this->clientErrorRepository->create($inputs);
    }

    public function find($id, $onlyTrashed = false)
    {
        return $this->clientErrorRepository->find($id, $onlyTrashed);
    }

    public function update($id, array $inputs = [])
    {
        return $this->clientErrorRepository->update($id, $inputs);
    }

    public function destroy($id)
    {
        return $this->clientErrorRepository->delete($id);
    }

    public function restore($id)
    {
        return $this->clientErrorRepository->restore($id);
    }

    public function export(array $filters)
    {
        return $this->clientErrorRepository->list($filters);
    }

    public function import(array $filters)
    {
        return $this->clientErrorRepository->create($filters);
    }
}

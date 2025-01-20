<?php

namespace Fintech\Core\Services;


use Fintech\Core\Interfaces\MailRepository;

/**
 * Class MailService
 * @package Fintech\Core\Services
 *
 */
class MailService
{
    /**
     * MailService constructor.
     * @param MailRepository $mailRepository
     */
    public function __construct(private readonly MailRepository $mailRepository) { }

    /**
     * @param array $filters
     * @return mixed
     */
    public function list(array $filters = [])
    {
        return $this->mailRepository->list($filters);

    }

    public function create(array $inputs = [])
    {
        return $this->mailRepository->create($inputs);
    }

    public function find($id, $onlyTrashed = false)
    {
        return $this->mailRepository->find($id, $onlyTrashed);
    }

    public function update($id, array $inputs = [])
    {
        return $this->mailRepository->update($id, $inputs);
    }

    public function destroy($id)
    {
        return $this->mailRepository->delete($id);
    }

    public function restore($id)
    {
        return $this->mailRepository->restore($id);
    }

    public function export(array $filters)
    {
        return $this->mailRepository->list($filters);
    }

    public function import(array $filters)
    {
        return $this->mailRepository->create($filters);
    }
}

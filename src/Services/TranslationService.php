<?php

namespace Fintech\Core\Services;

use Fintech\Core\Interfaces\TranslationRepository;

/**
 * Class TranslationService
 * @package Fintech\Core\Services
 *
 */
class TranslationService
{
    use \Fintech\Core\Traits\HasFindWhereSearch;

    /**
     * TranslationService constructor.
     * @param TranslationRepository $translationRepository
     */
    public function __construct(private readonly TranslationRepository $translationRepository)
    {
    }

    /**
     * @param array $filters
     * @return mixed
     */
    public function list(array $filters = [])
    {
        return $this->translationRepository->list($filters);

    }

    public function create(array $inputs = [])
    {
        return $this->translationRepository->create($inputs);
    }

    public function find($id, $onlyTrashed = false)
    {
        return $this->translationRepository->find($id, $onlyTrashed);
    }

    public function update($id, array $inputs = [])
    {
        return $this->translationRepository->update($id, $inputs);
    }

    public function destroy($id)
    {
        return $this->translationRepository->delete($id);
    }

    public function restore($id)
    {
        return $this->translationRepository->restore($id);
    }

    public function export(array $filters)
    {
        return $this->translationRepository->list($filters);
    }

    public function import(array $filters)
    {
        return $this->translationRepository->create($filters);
    }
}

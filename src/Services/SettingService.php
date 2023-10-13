<?php

namespace Fintech\Core\Services;

use Fintech\Core\Interfaces\SettingRepository;

/**
 * Class SettingService
 * @package Fintech\Core\Services
 *
 */
class SettingService
{
    /**
     * @var SettingRepository
     */
    private SettingRepository $settingRepository;

    /**
     * SettingService constructor.
     * @param SettingRepository $settingRepository
     */
    public function __construct(SettingRepository $settingRepository)
    {
        $this->settingRepository = $settingRepository;
    }

    /**
     * @param array $filters
     * @return mixed
     */
    public function list(array $filters = [])
    {
        return $this->settingRepository->list($filters);

    }

    public function create(array $inputs = [])
    {
        return $this->settingRepository->create($inputs);
    }

    public function find($id, $onlyTrashed = false)
    {
        return $this->settingRepository->find($id, $onlyTrashed);
    }

    public function update($id, array $inputs = [])
    {
        return $this->settingRepository->update($id, $inputs);
    }

    public function destroy($id)
    {
        return $this->settingRepository->delete($id);
    }

    public function restore($id)
    {
        return $this->settingRepository->restore($id);
    }
}

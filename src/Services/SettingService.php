<?php

namespace Fintech\Core\Services;

use Fintech\Core\Interfaces\SettingRepository;
use Fintech\Core\Supports\Utility;

/**
 * Class SettingService
 * @package Fintech\Core\Services
 *
 */
class SettingService
{
    /**
     * SettingService constructor.
     * @param SettingRepository $settingRepository
     */
    public function __construct(private readonly SettingRepository $settingRepository)
    {
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

    /**
     * Set value for system configuration
     *
     * @param string $package
     * @param string $key
     * @param null $value
     * @param string|null $type
     * @param null $user_id
     * @return void
     * @throws \Exception
     */
    public function setValue(string $package, string $key, $value = null, string $type = null, $user_id = null)
    {
        $entry = $this->list(['package' => $package, 'key' => $key, 'type' => $type, 'user_id' => $user_id])->first();

        if (!$entry) {
            try {

                $this->create([
                    'package' => $package,
                    'key' => $key,
                    'type' => $this->checkType($value, $type),
                    'value' => (string)Utility::stringify($entry->type, $value)
                ]);

                return;

            } catch (\Exception $exception) {
                throw  new \Exception($exception->getMessage(), 0, $exception);
            }
        }

        $this->update($entry->getKey(), ['value' => (string)Utility::stringify($entry->type, $value)]);

    }

    /**
     * @param mixed $value
     * @param string|null $type
     * @return bool|string
     */
    private function checkType($value, ?string $type)
    {
        if ($type != null) {
            return $type;
        }

        $valueType = strtolower((gettype($value) ?? ''));

        switch ($valueType) {
            case 'array' :
            case 'object' :
                return 'json';

            case 'boolean' :
                return 'bool';

            case 'string' :
            case 'null':
                return 'string';

            default:
                return $valueType;
        }
    }
}

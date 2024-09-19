<?php

namespace Fintech\Core\Services;

use Exception;
use Fintech\Core\Interfaces\SettingRepository;
use Fintech\Core\Supports\Utility;

/**
 * Class SettingService
 * @package Fintech\Core\Services
 *
 */
class SettingService
{
    use \Fintech\Core\Traits\HasFindWhereSearch;

    /**
     * SettingService constructor.
     * @param SettingRepository $settingRepository
     */
    public function __construct(private readonly SettingRepository $settingRepository)
    {
    }

    public function find($id, $onlyTrashed = false)
    {
        return $this->settingRepository->find($id, $onlyTrashed);
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
     * @throws Exception
     */
    public function setValue(string $package, string $key, $value = null, string $type = null, $user_id = null): void
    {
        $entry = $this->list(['package' => $package, 'key' => $key, 'type' => $type, 'user_id' => $user_id])->first();

        if (!$entry) {
            try {
                $attributes = [
                    'package' => $package,
                    'key' => $key,
                    'label' => ucwords(str_replace(['_', '.'], [' ', ' '], $package . '_' . $key)),
                    'description' => ucwords(str_replace(['_', '.'], [' ', ' '], $package . '_' . $key)),
                    'type' => $this->checkType($value, $type),
                ];

                $attributes['value'] = (string)Utility::stringify($attributes['type'], $value);

                if ($user_id != null) {
                    $attributes['user_id'] = $user_id;
                }

                $this->create($attributes);

                return;

            } catch (Exception $exception) {
                throw  new Exception($exception->getMessage(), 0, $exception);
            }
        }

        $this->update($entry->getKey(), ['value' => (string)Utility::stringify($entry->type, $value)]);

        cache()->forget('fintech.setting');

    }

    /**
     * @param array $filters
     * @return mixed
     */
    public function list(array $filters = [])
    {
        return $this->settingRepository->list($filters);

    }

    /**
     * @param mixed $value
     * @param string|null $type
     * @return bool|string
     */
    private function checkType(mixed $value, ?string $type): bool|string
    {
        if ($type != null) {
            return $type;
        }

        $valueType = strtolower((gettype($value) ?? ''));

        return match ($valueType) {
            'array', 'object' => 'json',
            'boolean' => 'bool',
            'string', 'null' => 'string',
            default => $valueType,
        };
    }

    public function create(array $inputs = [])
    {
        return $this->settingRepository->create($inputs);
    }

    public function update($id, array $inputs = [])
    {
        return $this->settingRepository->update($id, $inputs);
    }

    /**
     * Set value for system configuration
     *
     * @param string $package
     * @param string $key
     * @param null $default
     * @return mixed|null
     */
    public function getValue(string $package, string $key, $default = null): mixed
    {
        $entry = $this->list(['package' => $package, 'key' => $key])->first();

        if ($entry) {
            return Utility::typeCast($entry->value, $entry->type);
        }

        return $default;

    }

    public function configurations(): array
    {
        $values = [];

        foreach ($this->list() as $setting) {
            $values["fintech.{$setting->package}.{$setting->key}"] = Utility::typeCast($setting->value, $setting->type);
        }

        return $values;
    }
}

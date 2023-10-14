<?php

namespace Fintech\Core\Http\Controllers;

use Fintech\Core\Exceptions\DeleteOperationException;
use Fintech\Core\Http\Requests\UpdateConfigurationRequest;
use Fintech\Core\Http\Resources\ConfigurationResource;
use Fintech\Core\Traits\ApiResponseTrait;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Config;

/**
 * Class ConfigurationController
 * @package Fintech\Core\Http\Controllers
 *
 * @lrd:start
 * This class handle create, display, update, delete & restore
 * operation related to setting
 * @lrd:end
 *
 */
class ConfigurationController extends Controller
{
    use ApiResponseTrait;

    private array $hiddenFields = ['repositories', 'root_prefix', 'middleware', '^(.*)_model', '^(.*)_rules', 'packages'];

    /**
     * @lrd:start
     * Return a listing of the configurations in key and value format.
     * @lrd:end
     *
     * @param string $configuration
     * @return ConfigurationResource|JsonResponse
     */
    public function show(string $configuration): ConfigurationResource|JsonResponse
    {
        try {
            $configurations = Config::get("fintech.{$configuration}", []);

            foreach ($configurations as $key => $value) {
                foreach ($this->hiddenFields as $field) {
                    if (preg_match("/{$field}/i", $key) === 1) {
                        unset($configurations[$key]);
                    }
                }
            }


            return new ConfigurationResource($configurations);

        } catch (\Exception $exception) {

            return $this->failed($exception->getMessage());
        }
    }

    /**
     * @lrd:start
     * Update a specified setting resource using id.
     * @lrd:end
     *
     * @param UpdateConfigurationRequest $request
     * @param string $configuration
     * @return JsonResponse
     */
    public function update(UpdateConfigurationRequest $request, string $configuration): JsonResponse
    {
        try {

        } catch (\Exception $exception) {

            return $this->failed($exception->getMessage());
        }
    }

    /**
     * @lrd:start
     * Soft delete a specified setting resource using id.
     * @lrd:end
     *
     * @param string $configuration
     * @return JsonResponse
     */
    public function destroy(string $configuration)
    {
        try {

            $setting = \Core::setting()->read($id);

            if (!$setting) {
                throw (new ModelNotFoundException())->setModel(config('fintech.core.setting_model'), $id);
            }

            if (!\Core::setting()->destroy($id)) {

                throw (new DeleteOperationException())->setModel(config('fintech.core.setting_model'), $id);
            }

            return $this->deleted(__('core::messages.resource.deleted', ['model' => 'Setting']));

        } catch (ModelNotFoundException $exception) {

            return $this->notfound($exception->getMessage());

        } catch (\Exception $exception) {

            return $this->failed($exception->getMessage());
        }
    }
}

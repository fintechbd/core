<?php

namespace Fintech\Core\Http\Controllers;

use Fintech\Core\Exceptions\DeleteOperationException;
use Fintech\Core\Exceptions\UpdateOperationException;
use Fintech\Core\Http\Requests\IndexConfigurationRequest;
use Fintech\Core\Http\Requests\UpdateConfigurationRequest;
use Fintech\Core\Http\Requests\UpdateSettingRequest;
use Fintech\Core\Http\Resources\ConfigurationCollection;
use Fintech\Core\Traits\ApiResponseTrait;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

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

    /**
     * @lrd:start
     * Return a listing of the configurations in key and value format.
     * @lrd:end
     *
     * @param IndexConfigurationRequest $request
     * @return ConfigurationCollection|JsonResponse
     */
    public function index(IndexConfigurationRequest $request): ConfigurationCollection|JsonResponse
    {
        try {
            $inputs = $request->validated();

            $configurations = \Core::setting()->list($inputs);

            return new ConfigurationCollection($configurations);

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
     * @param string|int $id
     * @return JsonResponse
     */
    public function update(UpdateConfigurationRequest $request, string|int $id): JsonResponse
    {
        try {

            $setting = \Core::setting()->read($id);

            if (!$setting) {
                throw (new ModelNotFoundException())->setModel(config('fintech.core.setting_model'), $id);
            }

            $inputs = $request->validated();

            if (!\Core::setting()->update($id, $inputs)) {

                throw (new UpdateOperationException())->setModel(config('fintech.core.setting_model'), $id);
            }

            return $this->updated(__('core::messages.resource.updated', ['model' => 'Setting']));

        } catch (ModelNotFoundException $exception) {

            return $this->notfound($exception->getMessage());

        } catch (\Exception $exception) {

            return $this->failed($exception->getMessage());
        }
    }

    /**
     * @lrd:start
     * Soft delete a specified setting resource using id.
     * @lrd:end
     *
     * @param string|int $id
     * @return JsonResponse
     * @throws ModelNotFoundException
     */
    public function destroy(string|int $id)
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

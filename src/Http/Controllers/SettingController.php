<?php

namespace Fintech\Core\Http\Controllers;

use Core;
use Exception;
use Fintech\Core\Exceptions\DeleteOperationException;
use Fintech\Core\Exceptions\RestoreOperationException;
use Fintech\Core\Exceptions\StoreOperationException;
use Fintech\Core\Exceptions\UpdateOperationException;
use Fintech\Core\Http\Requests\ImportSettingRequest;
use Fintech\Core\Http\Requests\IndexSettingRequest;
use Fintech\Core\Http\Requests\StoreSettingRequest;
use Fintech\Core\Http\Requests\UpdateSettingRequest;
use Fintech\Core\Http\Resources\SettingCollection;
use Fintech\Core\Http\Resources\SettingResource;
use Fintech\Core\Traits\ApiResponseTrait;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

/**
 * Class SettingController
 * @package Fintech\Core\Http\Controllers
 *
 * @lrd:start
 * This class handle create, display, update, delete & restore
 * operation related to setting
 * @lrd:end
 *
 */
class SettingController extends Controller
{
    use ApiResponseTrait;

    /**
     * @lrd:start
     * Return a listing of the setting resource as collection.
     *
     * *```paginate=false``` returns all resource as list not pagination*
     * @lrd:end
     *
     * @param IndexSettingRequest $request
     * @return SettingCollection|JsonResponse
     */
    public function index(IndexSettingRequest $request): SettingCollection|JsonResponse
    {
        try {
            $inputs = $request->validated();

            $settingPaginate = Core::setting()->list($inputs);

            return new SettingCollection($settingPaginate);

        } catch (Exception $exception) {

            return $this->failed($exception->getMessage());
        }
    }

    /**
     * @lrd:start
     * Create a new setting resource in storage.
     * @lrd:end
     *
     * @param StoreSettingRequest $request
     * @return JsonResponse
     * @throws StoreOperationException
     */
    public function store(StoreSettingRequest $request): JsonResponse
    {
        try {
            $inputs = $request->validated();

            $setting = Core::setting()->create($inputs);

            if (!$setting) {
                throw (new StoreOperationException())->setModel(config('fintech.core.setting_model'));
            }

            return $this->created([
                'message' => __('core::messages.resource.created', ['model' => 'Setting']),
                'id' => $setting->getKey()
            ]);

        } catch (Exception $exception) {

            return $this->failed($exception->getMessage());
        }
    }

    /**
     * @lrd:start
     * Return a specified setting resource found by id.
     * @lrd:end
     *
     * @param string|int $id
     * @return SettingResource|JsonResponse
     * @throws ModelNotFoundException
     */
    public function show(string|int $id): SettingResource|JsonResponse
    {
        try {

            $setting = Core::setting()->find($id);

            if (!$setting) {
                throw (new ModelNotFoundException())->setModel(config('fintech.core.setting_model'), $id);
            }

            return new SettingResource($setting);

        } catch (ModelNotFoundException $exception) {

            return $this->notfound($exception->getMessage());

        } catch (Exception $exception) {

            return $this->failed($exception->getMessage());
        }
    }

    /**
     * @lrd:start
     * Update a specified setting resource using id.
     * @lrd:end
     *
     * @param UpdateSettingRequest $request
     * @param string|int $id
     * @return JsonResponse
     * @throws ModelNotFoundException
     */
    public function update(UpdateSettingRequest $request, string|int $id): JsonResponse
    {
        try {

            $setting = Core::setting()->read($id);

            if (!$setting) {
                throw (new ModelNotFoundException())->setModel(config('fintech.core.setting_model'), $id);
            }

            $inputs = $request->validated();

            if (!Core::setting()->update($id, $inputs)) {

                throw (new UpdateOperationException())->setModel(config('fintech.core.setting_model'), $id);
            }

            return $this->updated(__('core::messages.resource.updated', ['model' => 'Setting']));

        } catch (ModelNotFoundException $exception) {

            return $this->notfound($exception->getMessage());

        } catch (Exception $exception) {

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
     * @throws DeleteOperationException
     */
    public function destroy(string|int $id)
    {
        try {

            $setting = Core::setting()->read($id);

            if (!$setting) {
                throw (new ModelNotFoundException())->setModel(config('fintech.core.setting_model'), $id);
            }

            if (!Core::setting()->destroy($id)) {

                throw (new DeleteOperationException())->setModel(config('fintech.core.setting_model'), $id);
            }

            return $this->deleted(__('core::messages.resource.deleted', ['model' => 'Setting']));

        } catch (ModelNotFoundException $exception) {

            return $this->notfound($exception->getMessage());

        } catch (Exception $exception) {

            return $this->failed($exception->getMessage());
        }
    }

    /**
     * @lrd:start
     * Restore the specified setting resource from trash.
     * ** ```Soft Delete``` needs to enabled to use this feature**
     * @lrd:end
     *
     * @param string|int $id
     * @return JsonResponse
     */
    public function restore(string|int $id)
    {
        try {

            $setting = Core::setting()->find($id, true);

            if (!$setting) {
                throw (new ModelNotFoundException())->setModel(config('fintech.core.setting_model'), $id);
            }

            if (!Core::setting()->restore($id)) {

                throw (new RestoreOperationException())->setModel(config('fintech.core.setting_model'), $id);
            }

            return $this->restored(__('core::messages.resource.restored', ['model' => 'Setting']));

        } catch (ModelNotFoundException $exception) {

            return $this->notfound($exception->getMessage());

        } catch (Exception $exception) {

            return $this->failed($exception->getMessage());
        }
    }

    /**
     * @lrd:start
     * Create a exportable list of the setting resource as document.
     * After export job is done system will fire  export completed event
     *
     * @lrd:end
     *
     * @param IndexSettingRequest $request
     * @return JsonResponse
     */
    public function export(IndexSettingRequest $request): JsonResponse
    {
        try {
            $inputs = $request->validated();

            $settingPaginate = Core::setting()->export($inputs);

            return $this->exported(__('core::messages.resource.exported', ['model' => 'Setting']));

        } catch (Exception $exception) {

            return $this->failed($exception->getMessage());
        }
    }

    /**
     * @lrd:start
     * Create a exportable list of the setting resource as document.
     * After export job is done system will fire  export completed event
     *
     * @lrd:end
     *
     * @param ImportSettingRequest $request
     * @return SettingCollection|JsonResponse
     */
    public function import(ImportSettingRequest $request): JsonResponse
    {
        try {
            $inputs = $request->validated();

            $settingPaginate = Core::setting()->list($inputs);

            return new SettingCollection($settingPaginate);

        } catch (Exception $exception) {

            return $this->failed($exception->getMessage());
        }
    }
}

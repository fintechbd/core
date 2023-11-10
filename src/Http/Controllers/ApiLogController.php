<?php

namespace Fintech\Core\Http\Controllers;
use Exception;
use Fintech\Core\Exceptions\StoreOperationException;
use Fintech\Core\Exceptions\UpdateOperationException;
use Fintech\Core\Exceptions\DeleteOperationException;
use Fintech\Core\Exceptions\RestoreOperationException;
use Fintech\Core\Traits\ApiResponseTrait;
use Fintech\Core\Facades\Core;
use Fintech\Core\Http\Resources\ApiLogResource;
use Fintech\Core\Http\Resources\ApiLogCollection;
use Fintech\Core\Http\Requests\ImportApiLogRequest;
use Fintech\Core\Http\Requests\StoreApiLogRequest;
use Fintech\Core\Http\Requests\UpdateApiLogRequest;
use Fintech\Core\Http\Requests\IndexApiLogRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

/**
 * Class ApiLogController
 * @package Fintech\Core\Http\Controllers
 *
 * @lrd:start
 * This class handle create, display, update, delete & restore
 * operation related to ApiLog
 * @lrd:end
 *
 */

class ApiLogController extends Controller
{
    use ApiResponseTrait;

    /**
     * @lrd:start
     * Return a listing of the *ApiLog* resource as collection.
     *
     * *```paginate=false``` returns all resource as list not pagination*
     * @lrd:end
     *
     * @param IndexApiLogRequest $request
     * @return ApiLogCollection|JsonResponse
     */
    public function index(IndexApiLogRequest $request): ApiLogCollection|JsonResponse
    {
        try {
            $inputs = $request->validated();

            $apiLogPaginate = Core::apiLog()->list($inputs);

            return new ApiLogCollection($apiLogPaginate);

        } catch (Exception $exception) {

            return $this->failed($exception->getMessage());
        }
    }

    /**
     * @lrd:start
     * Create a new *ApiLog* resource in storage.
     * @lrd:end
     *
     * @param StoreApiLogRequest $request
     * @return JsonResponse
     * @throws StoreOperationException
     */
    public function store(StoreApiLogRequest $request): JsonResponse
    {
        try {
            $inputs = $request->validated();

            $apiLog = Core::apiLog()->create($inputs);

            if (!$apiLog) {
                throw (new StoreOperationException)->setModel(config('fintech.core.api_log_model'));
            }

            return $this->created([
                'message' => __('core::messages.resource.created', ['model' => 'Api Log']),
                'id' => $apiLog->id
             ]);

        } catch (Exception $exception) {

            return $this->failed($exception->getMessage());
        }
    }

    /**
     * @lrd:start
     * Return a specified *ApiLog* resource found by id.
     * @lrd:end
     *
     * @param string|int $id
     * @return ApiLogResource|JsonResponse
     * @throws ModelNotFoundException
     */
    public function show(string|int $id): ApiLogResource|JsonResponse
    {
        try {

            $apiLog = Core::apiLog()->find($id);

            if (!$apiLog) {
                throw (new ModelNotFoundException)->setModel(config('fintech.core.api_log_model'), $id);
            }

            return new ApiLogResource($apiLog);

        } catch (ModelNotFoundException $exception) {

            return $this->notfound($exception->getMessage());

        } catch (Exception $exception) {

            return $this->failed($exception->getMessage());
        }
    }

    /**
     * @lrd:start
     * Update a specified *ApiLog* resource using id.
     * @lrd:end
     *
     * @param UpdateApiLogRequest $request
     * @param string|int $id
     * @return JsonResponse
     * @throws ModelNotFoundException
     * @throws UpdateOperationException
     */
    public function update(UpdateApiLogRequest $request, string|int $id): JsonResponse
    {
        try {

            $apiLog = Core::apiLog()->find($id);

            if (!$apiLog) {
                throw (new ModelNotFoundException)->setModel(config('fintech.core.api_log_model'), $id);
            }

            $inputs = $request->validated();

            if (!Core::apiLog()->update($id, $inputs)) {

                throw (new UpdateOperationException)->setModel(config('fintech.core.api_log_model'), $id);
            }

            return $this->updated(__('core::messages.resource.updated', ['model' => 'Api Log']));

        } catch (ModelNotFoundException $exception) {

            return $this->notfound($exception->getMessage());

        } catch (Exception $exception) {

            return $this->failed($exception->getMessage());
        }
    }

    /**
     * @lrd:start
     * Soft delete a specified *ApiLog* resource using id.
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

            $apiLog = Core::apiLog()->find($id);

            if (!$apiLog) {
                throw (new ModelNotFoundException)->setModel(config('fintech.core.api_log_model'), $id);
            }

            if (!Core::apiLog()->destroy($id)) {

                throw (new DeleteOperationException())->setModel(config('fintech.core.api_log_model'), $id);
            }

            return $this->deleted(__('core::messages.resource.deleted', ['model' => 'Api Log']));

        } catch (ModelNotFoundException $exception) {

            return $this->notfound($exception->getMessage());

        } catch (Exception $exception) {

            return $this->failed($exception->getMessage());
        }
    }

    /**
     * @lrd:start
     * Restore the specified *ApiLog* resource from trash.
     * ** ```Soft Delete``` needs to enabled to use this feature**
     * @lrd:end
     *
     * @param string|int $id
     * @return JsonResponse
     */
    public function restore(string|int $id)
    {
        try {

            $apiLog = Core::apiLog()->find($id, true);

            if (!$apiLog) {
                throw (new ModelNotFoundException)->setModel(config('fintech.core.api_log_model'), $id);
            }

            if (!Core::apiLog()->restore($id)) {

                throw (new RestoreOperationException())->setModel(config('fintech.core.api_log_model'), $id);
            }

            return $this->restored(__('core::messages.resource.restored', ['model' => 'Api Log']));

        } catch (ModelNotFoundException $exception) {

            return $this->notfound($exception->getMessage());

        } catch (Exception $exception) {

            return $this->failed($exception->getMessage());
        }
    }

    /**
     * @lrd:start
     * Create a exportable list of the *ApiLog* resource as document.
     * After export job is done system will fire  export completed event
     *
     * @lrd:end
     *
     * @param IndexApiLogRequest $request
     * @return JsonResponse
     */
    public function export(IndexApiLogRequest $request): JsonResponse
    {
        try {
            $inputs = $request->validated();

            $apiLogPaginate = Core::apiLog()->export($inputs);

            return $this->exported(__('core::messages.resource.exported', ['model' => 'Api Log']));

        } catch (Exception $exception) {

            return $this->failed($exception->getMessage());
        }
    }

    /**
     * @lrd:start
     * Create a exportable list of the *ApiLog* resource as document.
     * After export job is done system will fire  export completed event
     *
     * @lrd:end
     *
     * @param ImportApiLogRequest $request
     * @return ApiLogCollection|JsonResponse
     */
    public function import(ImportApiLogRequest $request): JsonResponse
    {
        try {
            $inputs = $request->validated();

            $apiLogPaginate = Core::apiLog()->list($inputs);

            return new ApiLogCollection($apiLogPaginate);

        } catch (Exception $exception) {

            return $this->failed($exception->getMessage());
        }
    }
}

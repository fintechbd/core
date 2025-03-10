<?php

namespace Fintech\Core\Http\Controllers;

use Exception;
use Fintech\Core\Exceptions\DeleteOperationException;
use Fintech\Core\Facades\Core;
use Fintech\Core\Http\Requests\IndexApiLogRequest;
use Fintech\Core\Http\Resources\ApiLogCollection;
use Fintech\Core\Http\Resources\ApiLogResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

/**
 * Class ApiLogController
 *
 * @lrd:start
 * This class handle create, display, update, delete & restore
 * operation related to ApiLog
 *
 * @lrd:end
 */
class ApiLogController extends Controller
{
    /**
     * @lrd:start
     * Return a listing of the *ApiLog* resource as collection.
     *
     * *```paginate=false``` returns all resource as list not pagination*
     *
     * @lrd:end
     */
    public function index(IndexApiLogRequest $request): ApiLogCollection|JsonResponse
    {
        try {
            $inputs = $request->validated();

            $apiLogPaginate = Core::apiLog()->list($inputs);

            return new ApiLogCollection($apiLogPaginate);

        } catch (Exception $exception) {

            return response()->failed($exception);
        }
    }

    /**
     * @lrd:start
     * Return a specified *ApiLog* resource found by id.
     *
     * @lrd:end
     *
     * @throws ModelNotFoundException
     */
    public function show(string|int $id): ApiLogResource|JsonResponse
    {
        try {

            $apiLog = Core::apiLog()->find($id);

            if (! $apiLog) {
                throw (new ModelNotFoundException())->setModel(config('fintech.core.api_log_model'), $id);
            }

            return new ApiLogResource($apiLog);

        } catch (Exception $exception) {

            return response()->failed($exception);
        }
    }

    /**
     * @lrd:start
     * Soft delete a specified *ApiLog* resource using id.
     *
     * @lrd:end
     *
     * @return JsonResponse
     *
     * @throws ModelNotFoundException
     */
    public function destroy(string|int $id)
    {
        try {

            $apiLog = Core::apiLog()->find($id);

            if (! $apiLog) {
                throw (new ModelNotFoundException())->setModel(config('fintech.core.api_log_model'), $id);
            }

            if (! Core::apiLog()->destroy($id)) {

                throw (new DeleteOperationException())->setModel(config('fintech.core.api_log_model'), $id);
            }

            return response()->deleted(__('core::messages.resource.deleted', ['model' => 'Api Log']));

        } catch (Exception $exception) {

            return response()->failed($exception);
        }
    }
}

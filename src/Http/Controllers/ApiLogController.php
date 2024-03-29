<?php

namespace Fintech\Core\Http\Controllers;

use Exception;
use Fintech\Core\Exceptions\DeleteOperationException;
use Fintech\Core\Facades\Core;
use Fintech\Core\Http\Requests\IndexApiLogRequest;
use Fintech\Core\Http\Resources\ApiLogCollection;
use Fintech\Core\Http\Resources\ApiLogResource;
use Fintech\Core\Traits\ApiResponseTrait;
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
                throw (new ModelNotFoundException())->setModel(config('fintech.core.api_log_model'), $id);
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
     * Soft delete a specified *ApiLog* resource using id.
     * @lrd:end
     *
     * @param string|int $id
     * @return JsonResponse
     * @throws ModelNotFoundException
     */
    public function destroy(string|int $id)
    {
        try {

            $apiLog = Core::apiLog()->find($id);

            if (!$apiLog) {
                throw (new ModelNotFoundException())->setModel(config('fintech.core.api_log_model'), $id);
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
}

<?php

namespace Fintech\Core\Http\Controllers;

use Fintech\Core\Exceptions\StoreOperationException;
use Fintech\Core\Exceptions\UpdateOperationException;
use Fintech\Core\Exceptions\DeleteOperationException;
use Fintech\Core\Exceptions\RestoreOperationException;
use Fintech\Core\Traits\ApiResponseTrait;
use Fintech\Core\Http\Resources\JobResource;
use Fintech\Core\Http\Resources\JobCollection;
use Fintech\Core\Http\Requests\ImportJobRequest;
use Fintech\Core\Http\Requests\StoreJobRequest;
use Fintech\Core\Http\Requests\UpdateJobRequest;
use Fintech\Core\Http\Requests\IndexJobRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

/**
 * Class JobController
 * @package Fintech\Core\Http\Controllers
 *
 * @lrd:start
 * This class handle create, display, update, delete & restore
 * operation related to Job
 * @lrd:end
 *
 */

class JobController extends Controller
{
    use ApiResponseTrait;

    /**
     * @lrd:start
     * Return a listing of the *Job* resource as collection.
     *
     * *```paginate=false``` returns all resource as list not pagination*
     * @lrd:end
     *
     * @param IndexJobRequest $request
     * @return JobCollection|JsonResponse
     */
    public function index(IndexJobRequest $request): JobCollection|JsonResponse
    {
        try {
            $inputs = $request->validated();

            $jobPaginate = \Core::job()->list($inputs);

            return new JobCollection($jobPaginate);

        } catch (\Exception $exception) {

            return $this->failed($exception->getMessage());
        }
    }

    /**
     * @lrd:start
     * Create a new *Job* resource in storage.
     * @lrd:end
     *
     * @param StoreJobRequest $request
     * @return JsonResponse
     * @throws StoreOperationException
     */
    public function store(StoreJobRequest $request): JsonResponse
    {
        try {
            $inputs = $request->validated();

            $job = \Core::job()->create($inputs);

            if (!$job) {
                throw (new StoreOperationException())->setModel(config('fintech.core.job_model'));
            }

            return $this->created([
                'message' => __('core::messages.resource.created', ['model' => 'Job']),
                'id' => $job->getKey()
             ]);

        } catch (\Exception $exception) {

            return $this->failed($exception->getMessage());
        }
    }

    /**
     * @lrd:start
     * Return a specified *Job* resource found by id.
     * @lrd:end
     *
     * @param string|int $id
     * @return JobResource|JsonResponse
     * @throws ModelNotFoundException
     */
    public function show(string|int $id): JobResource|JsonResponse
    {
        try {

            $job = \Core::job()->find($id);

            if (!$job) {
                throw (new ModelNotFoundException())->setModel(config('fintech.core.job_model'), $id);
            }

            return new JobResource($job);

        } catch (ModelNotFoundException $exception) {

            return $this->notfound($exception->getMessage());

        } catch (\Exception $exception) {

            return $this->failed($exception->getMessage());
        }
    }

    /**
     * @lrd:start
     * Update a specified *Job* resource using id.
     * @lrd:end
     *
     * @param UpdateJobRequest $request
     * @param string|int $id
     * @return JsonResponse
     * @throws ModelNotFoundException
     * @throws UpdateOperationException
     */
    public function update(UpdateJobRequest $request, string|int $id): JsonResponse
    {
        try {

            $job = \Core::job()->read($id);

            if (!$job) {
                throw (new ModelNotFoundException())->setModel(config('fintech.core.job_model'), $id);
            }

            $inputs = $request->validated();

            if (!\Core::job()->update($id, $inputs)) {

                throw (new UpdateOperationException())->setModel(config('fintech.core.job_model'), $id);
            }

            return $this->updated(__('core::messages.resource.updated', ['model' => 'Job']));

        } catch (ModelNotFoundException $exception) {

            return $this->notfound($exception->getMessage());

        } catch (\Exception $exception) {

            return $this->failed($exception->getMessage());
        }
    }

    /**
     * @lrd:start
     * Soft delete a specified *Job* resource using id.
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

            $job = \Core::job()->read($id);

            if (!$job) {
                throw (new ModelNotFoundException())->setModel(config('fintech.core.job_model'), $id);
            }

            if (!\Core::job()->destroy($id)) {

                throw (new DeleteOperationException())->setModel(config('fintech.core.job_model'), $id);
            }

            return $this->deleted(__('core::messages.resource.deleted', ['model' => 'Job']));

        } catch (ModelNotFoundException $exception) {

            return $this->notfound($exception->getMessage());

        } catch (\Exception $exception) {

            return $this->failed($exception->getMessage());
        }
    }

    /**
     * @lrd:start
     * Restore the specified *Job* resource from trash.
     * ** ```Soft Delete``` needs to enabled to use this feature**
     * @lrd:end
     *
     * @param string|int $id
     * @return JsonResponse
     */
    public function restore(string|int $id)
    {
        try {

            $job = \Core::job()->find($id, true);

            if (!$job) {
                throw (new ModelNotFoundException())->setModel(config('fintech.core.job_model'), $id);
            }

            if (!\Core::job()->restore($id)) {

                throw (new RestoreOperationException())->setModel(config('fintech.core.job_model'), $id);
            }

            return $this->restored(__('core::messages.resource.restored', ['model' => 'Job']));

        } catch (ModelNotFoundException $exception) {

            return $this->notfound($exception->getMessage());

        } catch (\Exception $exception) {

            return $this->failed($exception->getMessage());
        }
    }

    /**
     * @lrd:start
     * Create a exportable list of the *Job* resource as document.
     * After export job is done system will fire  export completed event
     *
     * @lrd:end
     *
     * @param IndexJobRequest $request
     * @return JsonResponse
     */
    public function export(IndexJobRequest $request): JsonResponse
    {
        try {
            $inputs = $request->validated();

            $jobPaginate = \Core::job()->export($inputs);

            return $this->exported(__('core::messages.resource.exported', ['model' => 'Job']));

        } catch (\Exception $exception) {

            return $this->failed($exception->getMessage());
        }
    }

    /**
     * @lrd:start
     * Create a exportable list of the *Job* resource as document.
     * After export job is done system will fire  export completed event
     *
     * @lrd:end
     *
     * @param ImportJobRequest $request
     * @return JobCollection|JsonResponse
     */
    public function import(ImportJobRequest $request): JsonResponse
    {
        try {
            $inputs = $request->validated();

            $jobPaginate = \Core::job()->list($inputs);

            return new JobCollection($jobPaginate);

        } catch (\Exception $exception) {

            return $this->failed($exception->getMessage());
        }
    }
}

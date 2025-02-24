<?php

namespace Fintech\Core\Http\Controllers;

use Exception;
use Fintech\Core\Exceptions\DeleteOperationException;
use Fintech\Core\Exceptions\RestoreOperationException;
use Fintech\Core\Exceptions\StoreOperationException;
use Fintech\Core\Exceptions\UpdateOperationException;
use Fintech\Core\Facades\Core;
use Fintech\Core\Http\Requests\ImportMigrationRequest;
use Fintech\Core\Http\Requests\IndexMigrationRequest;
use Fintech\Core\Http\Requests\StoreMigrationRequest;
use Fintech\Core\Http\Requests\UpdateMigrationRequest;
use Fintech\Core\Http\Resources\MigrationCollection;
use Fintech\Core\Http\Resources\MigrationResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

/**
 * Class MigrationController
 * @package Fintech\Core\Http\Controllers
 *
 * @lrd:start
 * This class handle create, display, update, delete & restore
 * operation related to Migration
 * @lrd:end
 *
 */

class MigrationController extends Controller
{
    /**
     * @lrd:start
     * Return a listing of the *Migration* resource as collection.
     *
     * *```paginate=false``` returns all resource as list not pagination*
     * @lrd:end
     *
     * @param IndexMigrationRequest $request
     * @return MigrationCollection|JsonResponse
     */
    public function index(IndexMigrationRequest $request): MigrationCollection|JsonResponse
    {
        try {
            $inputs = $request->validated();

            $migrationPaginate = Core::migration()->list($inputs);

            return new MigrationCollection($migrationPaginate);

        } catch (Exception $exception) {

            return response()->failed($exception);
        }
    }

    /**
     * @lrd:start
     * Create a new *Migration* resource in storage.
     * @lrd:end
     *
     * @param StoreMigrationRequest $request
     * @return JsonResponse
     * @throws StoreOperationException
     */
    public function store(StoreMigrationRequest $request): JsonResponse
    {
        try {
            $inputs = $request->validated();

            $migration = Core::migration()->create($inputs);

            if (!$migration) {
                throw (new StoreOperationException())->setModel(config('fintech.core.migration_model'));
            }

            return response()->created([
                'message' => __('core::messages.resource.created', ['model' => 'Migration Controller']),
                'id' => $migration->id
             ]);

        } catch (Exception $exception) {

            return response()->failed($exception);
        }
    }

    /**
     * @lrd:start
     * Return a specified *Migration* resource found by id.
     * @lrd:end
     *
     * @param string|int $id
     * @return MigrationResource|JsonResponse
     * @throws ModelNotFoundException
     */
    public function show(string|int $id): MigrationResource|JsonResponse
    {
        try {

            $migration = Core::migration()->find($id);

            if (!$migration) {
                throw (new ModelNotFoundException())->setModel(config('fintech.core.migration_model'), $id);
            }

            return new MigrationResource($migration);

        } catch (Exception $exception) {

            return response()->failed($exception);
        }
    }

    /**
     * @lrd:start
     * Update a specified *Migration* resource using id.
     * @lrd:end
     *
     * @param UpdateMigrationRequest $request
     * @param string|int $id
     * @return JsonResponse
     * @throws ModelNotFoundException
     * @throws UpdateOperationException
     */
    public function update(UpdateMigrationRequest $request, string|int $id): JsonResponse
    {
        try {

            $migration = Core::migration()->find($id);

            if (!$migration) {
                throw (new ModelNotFoundException())->setModel(config('fintech.core.migration_model'), $id);
            }

            $inputs = $request->validated();

            if (!Core::migration()->update($id, $inputs)) {

                throw (new UpdateOperationException())->setModel(config('fintech.core.migration_model'), $id);
            }

            return response()->updated(__('core::messages.resource.updated', ['model' => 'Migration Controller']));

        } catch (Exception $exception) {

            return response()->failed($exception);
        }
    }

    /**
     * @lrd:start
     * Soft delete a specified *Migration* resource using id.
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

            $migration = Core::migration()->find($id);

            if (!$migration) {
                throw (new ModelNotFoundException())->setModel(config('fintech.core.migration_model'), $id);
            }

            if (!Core::migration()->destroy($id)) {

                throw (new DeleteOperationException())->setModel(config('fintech.core.migration_model'), $id);
            }

            return response()->deleted(__('core::messages.resource.deleted', ['model' => 'Migration Controller']));

        } catch (Exception $exception) {

            return response()->failed($exception);
        }
    }

    /**
     * @lrd:start
     * Restore the specified *Migration* resource from trash.
     * ** ```Soft Delete``` needs to enabled to use this feature**
     * @lrd:end
     *
     * @param string|int $id
     * @return JsonResponse
     */
    public function restore(string|int $id)
    {
        try {

            $migration = Core::migration()->find($id, true);

            if (!$migration) {
                throw (new ModelNotFoundException())->setModel(config('fintech.core.migration_model'), $id);
            }

            if (!Core::migration()->restore($id)) {

                throw (new RestoreOperationException())->setModel(config('fintech.core.migration_model'), $id);
            }

            return response()->restored(__('core::messages.resource.restored', ['model' => 'Migration Controller']));

        } catch (Exception $exception) {

            return response()->failed($exception);
        }
    }

    /**
     * @lrd:start
     * Create a exportable list of the *Migration* resource as document.
     * After export job is done system will fire  export completed event
     *
     * @lrd:end
     *
     * @param IndexMigrationRequest $request
     * @return JsonResponse
     */
    public function export(IndexMigrationRequest $request): JsonResponse
    {
        try {
            $inputs = $request->validated();

            $migrationPaginate = Core::migration()->export($inputs);

            return response()->exported(__('core::messages.resource.exported', ['model' => 'Migration Controller']));

        } catch (Exception $exception) {

            return response()->failed($exception);
        }
    }

    /**
     * @lrd:start
     * Create a exportable list of the *Migration* resource as document.
     * After export job is done system will fire  export completed event
     *
     * @lrd:end
     *
     * @param ImportMigrationRequest $request
     * @return MigrationCollection|JsonResponse
     */
    public function import(ImportMigrationRequest $request): JsonResponse
    {
        try {
            $inputs = $request->validated();

            $migrationPaginate = Core::migration()->list($inputs);

            return new MigrationCollection($migrationPaginate);

        } catch (Exception $exception) {

            return response()->failed($exception);
        }
    }
}

<?php

namespace Fintech\Core\Http\Controllers;

use Exception;
use Fintech\Core\Exceptions\DeleteOperationException;
use Fintech\Core\Exceptions\RestoreOperationException;
use Fintech\Core\Facades\Core;
use Fintech\Core\Http\Resources\MailResource;
use Fintech\Core\Http\Resources\MailCollection;
use Fintech\Core\Http\Requests\ImportMailRequest;
use Fintech\Core\Http\Requests\IndexMailRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

/**
 * Class Mail
 * @package Fintech\Core\Http\Controllers
 *
 * @lrd:start
 * This class handle create, display, update, delete & restore
 * operation related to Mail
 * @lrd:end
 *
 */

class MailController extends Controller
{
    /**
     * @lrd:start
     * Return a listing of the *Mail* resource as collection.
     *
     * *```paginate=false``` returns all resource as list not pagination*
     * @lrd:end
     *
     * @param IndexMailRequest $request
     * @return MailCollection|JsonResponse
     */
    public function index(IndexMailRequest $request): MailCollection|JsonResponse
    {
        try {
            $inputs = $request->validated();

            $mailPaginate = Core::mail()->list($inputs);

            return new MailCollection($mailPaginate);

        } catch (Exception $exception) {

            return response()->failed($exception);
        }
    }

    /**
     * @lrd:start
     * Return a specified *Mail* resource found by id.
     * @lrd:end
     *
     * @param string|int $id
     * @return MailResource|JsonResponse
     * @throws ModelNotFoundException
     */
    public function show(string|int $id): MailResource|JsonResponse
    {
        try {

            $mail = Core::mail()->find($id);

            if (!$mail) {
                throw (new ModelNotFoundException())->setModel(config('fintech.core.mail_model'), $id);
            }

            return new MailResource($mail);

        } catch (Exception $exception) {

            return response()->failed($exception);
        }
    }

    /**
     * @lrd:start
     * Soft delete a specified *Mail* resource using id.
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

            $mail = Core::mail()->find($id);

            if (!$mail) {
                throw (new ModelNotFoundException())->setModel(config('fintech.core.mail_model'), $id);
            }

            if (!Core::mail()->destroy($id)) {

                throw (new DeleteOperationException())->setModel(config('fintech.core.mail_model'), $id);
            }

            return response()->deleted(__('core::messages.resource.deleted', ['model' => 'Mail']));

        } catch (Exception $exception) {

            return response()->failed($exception);
        }
    }

    /**
     * @lrd:start
     * Restore the specified *Mail* resource from trash.
     * ** ```Soft Delete``` needs to enabled to use this feature**
     * @lrd:end
     *
     * @param string|int $id
     * @return JsonResponse
     */
    public function restore(string|int $id)
    {
        try {

            $mail = Core::mail()->find($id, true);

            if (!$mail) {
                throw (new ModelNotFoundException())->setModel(config('fintech.core.mail_model'), $id);
            }

            if (!Core::mail()->restore($id)) {

                throw (new RestoreOperationException())->setModel(config('fintech.core.mail_model'), $id);
            }

            return response()->restored(__('core::messages.resource.restored', ['model' => 'Mail']));

        } catch (Exception $exception) {

            return response()->failed($exception);
        }
    }

    /**
     * @lrd:start
     * Create a exportable list of the *Mail* resource as document.
     * After export job is done system will fire  export completed event
     *
     * @lrd:end
     *
     * @param IndexMailRequest $request
     * @return JsonResponse
     */
    public function export(IndexMailRequest $request): JsonResponse
    {
        try {
            $inputs = $request->validated();

            $mailPaginate = Core::mail()->export($inputs);

            return response()->exported(__('core::messages.resource.exported', ['model' => 'Mail']));

        } catch (Exception $exception) {

            return response()->failed($exception);
        }
    }

    /**
     * @lrd:start
     * Create a exportable list of the *Mail* resource as document.
     * After export job is done system will fire  export completed event
     *
     * @lrd:end
     *
     * @param ImportMailRequest $request
     * @return MailCollection|JsonResponse
     */
    public function import(ImportMailRequest $request): JsonResponse
    {
        try {
            $inputs = $request->validated();

            $mailPaginate = Core::mail()->list($inputs);

            return new MailCollection($mailPaginate);

        } catch (Exception $exception) {

            return response()->failed($exception);
        }
    }
}

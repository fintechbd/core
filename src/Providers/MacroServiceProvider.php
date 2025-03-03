<?php

namespace Fintech\Core\Providers;

use Exception;
use Fintech\Core\Enums\RequestPlatform;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Response as ResponseFacade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class MacroServiceProvider extends ServiceProvider
{
    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        /**
         * http client request platform
         *
         * @return RequestPlatform|null
         */
        Request::macro('platform', function () {

            $platform = request()->header('Platform');

            return RequestPlatform::tryFrom($platform);

        });

        /**
         * check the request is from Agent panel
         *
         * @return bool
         */
        Request::macro('isAgent', function () {
            return request()->platform()->value === RequestPlatform::WebAgent->value;
        });

        /**
         * http client soap request macro
         *
         * @param string $url
         * @param string $method
         * @param string $payload
         * @return \Illuminate\Http\Client\Response
         */
        Http::macro('soap', function (string $url = '/', string $method = '', string $payload = '') {
            return Http::withoutVerifying()
                ->withHeaders([
                    'Host' => parse_url($url, PHP_URL_HOST),
                    'SOAPAction' => $method,
                    'Content-Length' => strlen($payload),
                    'Content-Type' => 'text/xml;charset=utf-8',
                ])
                ->withBody($payload, 'text/xml;charset=utf-8')
                ->post($url);
        });

        /**
         * return response with http 200 as deleted
         * resource
         *
         * @param $data
         * @param array $headers
         * @return JsonResponse
         */
        ResponseFacade::macro('deleted', function ($data, array $headers = []) {
            return response()->json(response_format($data, Response::HTTP_OK), Response::HTTP_OK, $headers);
        });

        /**
         * return response with http 200 as soft deleted
         * resource restored
         *
         * @param $data
         * @param array $headers
         * @return JsonResponse
         */
        ResponseFacade::macro('restored', function ($data, array $headers = []) {
            return response()->json(response_format($data, Response::HTTP_OK), Response::HTTP_OK, $headers);
        });

        /**
         * return response with http 201 resource
         * created on server
         *
         * @param $data
         * @param array $headers
         * @return JsonResponse
         */
        ResponseFacade::macro('created', function ($data, array $headers = []) {
            return response()->json(response_format($data, Response::HTTP_CREATED), Response::HTTP_CREATED, $headers);
        });

        /**
         * return response with http 200 update
         * request accepted
         *
         * @param $data
         * @param array $headers
         * @return JsonResponse
         */
        ResponseFacade::macro('updated', function ($data, array $headers = []) {
            return response()->json(response_format($data, Response::HTTP_OK), Response::HTTP_OK, $headers);
        });

        /**
         * return response with http 202 export
         * request accepted
         *
         * @param $data
         * @param array $headers
         * @return JsonResponse
         */
        ResponseFacade::macro('exported', function ($data, array $headers = []) {
            return response()->json(response_format($data, Response::HTTP_ACCEPTED), Response::HTTP_ACCEPTED, $headers);
        });

        /**
         * return response with http 400 if business
         * logic exception
         *
         * @param $data
         * @param array $headers
         * @return JsonResponse
         */
        ResponseFacade::macro('failed', function ($data, array $headers = []) {

            $statusCode = Response::HTTP_BAD_REQUEST;

            if ($data instanceof ModelNotFoundException) {
                $model = Str::replace('_', ' ', Str::snake(class_basename($data->getModel())));
                $data = ucfirst("{$model} not found.");
                $statusCode = Response::HTTP_NOT_FOUND;

            } elseif ($data instanceof ConnectionException) {
                $data = __('core::messages.general_exception', ['exception' => class_basename($data)]);
            } elseif ($data instanceof \Throwable) {
                throw_if(config('app.debug', false), $data);
                $data = $data->getMessage();
            }

            return response()->json(response_format($data, $statusCode), $statusCode, $headers);
        });

        /**
         * return response with http 200 for all success status
         *
         * @param $data
         * @param array $headers
         * @return JsonResponse
         */
        ResponseFacade::macro('success', function ($data, array $headers = []) {
            return response()->json(response_format($data, Response::HTTP_OK), Response::HTTP_OK, $headers);
        });

        /**
         * return response with http 401 if request
         * token or ip banned
         *
         * @param $data
         * @param array $headers
         * @return JsonResponse
         */
        ResponseFacade::macro('banned', function ($data, array $headers = []) {
            return response()->json(response_format($data, Response::HTTP_UNAUTHORIZED), Response::HTTP_UNAUTHORIZED, $headers);
        });

        /**
         * return response with http 403 if access forbidden
         * to that request
         *
         * @param $data
         * @param array $headers
         * @return JsonResponse
         */
        ResponseFacade::macro('forbidden', function ($data, array $headers = []) {
            return response()->json(response_format($data, Response::HTTP_FORBIDDEN), Response::HTTP_FORBIDDEN, $headers);
        });

        /**
         * return response with http 404 not found
         *
         * @param $data
         * @param array $headers
         * @return JsonResponse
         */
        ResponseFacade::macro('notfound', function ($data, array $headers = []) {
            return response()->json(response_format($data, Response::HTTP_NOT_FOUND), Response::HTTP_NOT_FOUND, $headers);
        });

        /**
         * return response with http 423 attempt locked
         *
         * @param $data
         * @param array $headers
         * @return JsonResponse
         */
        ResponseFacade::macro('locked', function ($data, array $headers = []) {
            return response()->json(response_format($data, Response::HTTP_LOCKED), Response::HTTP_LOCKED, $headers);
        });

        /**
         * return response with http 429 too many requests code
         *
         * @param $data
         * @param array $headers
         * @return JsonResponse
         */
        ResponseFacade::macro('overflow', function ($data, array $headers = []) {
            return response()->json(response_format($data, Response::HTTP_TOO_MANY_REQUESTS), Response::HTTP_TOO_MANY_REQUESTS, $headers);
        });
    }
}

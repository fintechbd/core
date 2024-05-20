<?php

namespace Fintech\Core\Providers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Response as ResponseFacade;
use Illuminate\Support\ServiceProvider;
use Symfony\Component\HttpFoundation\Response;

class MacroServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {

    }

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        Request::macro('platform', function (string $platform = null) {
            $headerPlatform = request()->header('Platform', null);
            return ($platform != null) ? strtolower($headerPlatform) == strtolower($platform) : $headerPlatform;
        });

        Http::macro('soap', function (string $url = '/', string $method = '', string $payload = '') {
            return Http::withoutVerifying()
                ->withHeaders([
                    'Host' => parse_url($url, PHP_URL_HOST),
                    'SOAPAction' => $method,
                    'Content-Length' => strlen($payload),
                    'Content-Type' => 'text/xml;charset=utf-8',
                ])
                ->withBody($payload)
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
            return response()->json(response_format($data, Response::HTTP_BAD_REQUEST), Response::HTTP_BAD_REQUEST, $headers);
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

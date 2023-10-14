<?php

namespace Fintech\Core\Traits;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * Trait ApiResponseTrait
 */
trait ApiResponseTrait
{
    private function format($data, $statusCode = null)
    {
        if (is_string($data)) {
            $data = ['message' => $data];
            if ($statusCode != null) {
                $data['code'] = $statusCode;
            }
        }

        if (is_array($data) && !isset($data['code'])) {
            if ($statusCode != null) {
                $data['code'] = $statusCode;
            }
        }

        return $data;
    }

    /**
     * return response with http 200 as deleted
     * resource
     *
     * @param $data
     * @return JsonResponse
     */
    protected function deleted($data)
    {
        return response()->json($this->format($data), Response::HTTP_OK);
    }

    /**
     * return response with http 200 as soft deleted
     * resource restored
     *
     * @param $data
     * @return JsonResponse
     */
    protected function restored($data)
    {
        return response()->json($this->format($data), Response::HTTP_OK);
    }

    /**
     * return response with http 201 resource
     * created on server
     *
     * @param $data
     * @return JsonResponse
     */
    protected function created($data)
    {
        return response()->json($this->format($data), Response::HTTP_CREATED);
    }

    /**
     * return response with http 200 update
     * request accepted
     *
     * @param $data
     * @return JsonResponse
     */
    protected function updated($data)
    {
        return response()->json($this->format($data), Response::HTTP_OK);
    }

    /**
     * return response with http 202 export
     * request accepted
     *
     * @param $data
     * @return JsonResponse
     */
    protected function exported($data)
    {
        return response()->json($this->format($data), Response::HTTP_ACCEPTED);
    }

    /**
     * return response with http 400 if business
     * logic exception
     *
     * @param $data
     * @return JsonResponse
     */
    protected function failed($data)
    {
        if (is_string($data)) {
            $data = ['message' => $data];
        }

        return response()->json($this->format($data), Response::HTTP_BAD_REQUEST);
    }

    /**
     * return response with http 401 if request
     * token or ip banned
     *
     * @param $data
     * @return JsonResponse
     */
    protected function banned($data)
    {
        if (is_string($data)) {
            $data = ['message' => $data];
        }

        return response()->json($this->format($data), Response::HTTP_UNAUTHORIZED);
    }

    /**
     * return response with http 403 if access forbidden
     * to that request
     *
     * @param $data
     * @return JsonResponse
     */
    protected function forbidden($data)
    {
        if (is_string($data)) {
            $data = ['message' => $data];
        }

        return response()->json($this->format($data), Response::HTTP_FORBIDDEN);
    }

    /**
     * return response with http 404 not found
     *
     * @param $data
     * @return JsonResponse
     */
    protected function notfound($data)
    {
        return response()->json($this->format($data), Response::HTTP_NOT_FOUND);
    }

    /**
     * return response with http 423 attempt locked
     *
     * @param $data
     * @return JsonResponse
     */
    protected function locked($data)
    {
        return response()->json($this->format($data), Response::HTTP_LOCKED);
    }

    /**
     * return response with http 429 too many requests code
     *
     * @param $data
     * @return JsonResponse
     */
    protected function overflow($data)
    {
        return response()->json($this->format($data), Response::HTTP_TOO_MANY_REQUESTS);
    }
}

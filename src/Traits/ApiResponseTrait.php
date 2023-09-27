<?php

namespace Fintech\Core\Traits;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * Trait ApiResponseTrait
 * @package Fintech\Core\Traits
 */
trait ApiResponseTrait
{
    private function format($data)
    {
        if (is_string($data)) {
            $data = ['message' => $data];
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
     * return response with http 202 update
     * request accepted
     *
     * @param $data
     * @return JsonResponse
     */
    protected function updated($data)
    {
        return response()->json($this->format($data), Response::HTTP_ACCEPTED);
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

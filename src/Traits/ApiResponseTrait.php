<?php


namespace Fintech\Core\Traits;

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

    //200
    protected function deleted($data)
    {
        return response()->json($this->format($data), Response::HTTP_OK);
    }

    //200
    protected function restored($data)
    {
        return response()->json($this->format($data), Response::HTTP_OK);
    }

    //201
    protected function created($data)
    {
        return response()->json($this->format($data), Response::HTTP_CREATED);
    }

    //202
    protected function updated($data)
    {
        return response()->json($this->format($data), Response::HTTP_ACCEPTED);
    }

    //202
    protected function exported($data)
    {
        return response()->json($this->format($data), Response::HTTP_ACCEPTED);
    }

    //400
    protected function failed($data)
    {
        if (is_string($data)) {
            $data = ['message' => $data];
        }

        return response()->json($this->format($data), Response::HTTP_BAD_REQUEST);
    }

    //404
    protected function notfound($data)
    {
        return response()->json($this->format($data), Response::HTTP_NOT_FOUND);
    }
}

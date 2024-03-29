<?php

namespace Fintech\Core\Http\Controllers;

use Exception;
use Fintech\Core\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

/**
 * Class PulseCheckController
 * @package Fintech\Core\Http\Controllers
 *
 * @lrd:start
 * This class handle server pulse checker
 * @lrd:end
 *
 */
class PulseCheckController extends Controller
{
    use ApiResponseTrait;

    private array $hiddenFields = ['repositories', 'root_prefix', 'middleware', '^(.*)_model', '^(.*)_rules', 'packages'];

    /**
     * @lrd:start
     * This api endpoint will check server status and client user agent integrity
     * @lrd:end
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        try {

            if (!$this->validTimezone($request)) {

            }


            return $this->success([]);

        } catch (Exception $exception) {

            return $this->locked($exception->getMessage());
        }
    }

    private function validTimezone(Request $request): bool
    {
        return true;
    }

    private function validHeaders(Request $request): bool
    {
        return true;
    }
}

<?php

namespace Fintech\Core\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class HealthCheckController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): JsonResponse
    {
        return response()->json([
            'version' => App::version(),
            'environment' => config('app.env'),
            'debug' => config('app.debug'),
            'ip' => $request->ip(),
        ]);
    }
}
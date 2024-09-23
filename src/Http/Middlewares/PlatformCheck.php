<?php

namespace Fintech\Core\Http\Middlewares;

use Closure;
use Fintech\Core\Enums\RequestPlatform;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PlatformCheck
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $platform = $request->header('Platform');

        if (!$platform || !RequestPlatform::exists($platform)) {
            abort(Response::HTTP_UNAUTHORIZED, 'Request platform header is invalid or missing.');
        }

        return $next($request);
    }
}

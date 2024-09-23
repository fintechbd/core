<?php

namespace Fintech\Core\Http\Middlewares;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PlatformCheck
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $platform = $request->header('Platform');

        if (!$platform) {
            abort(Response::HTTP_BAD_REQUEST, 'Request header signature is missing.');
        }

        return $next($request);
    }
}

<?php

namespace Fintech\Core\Http\Middlewares;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DetectTimezone
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     * @return JsonResponse|mixed
     */
    public function handle(Request $request, Closure $next)
    {
        //        if ($request->hasHeader('Timestamp')) {
        //            $datetime = $request->header('Timestamp', now()->format('c'));
        //            app()->setLocale($locale);
        //        }

        return $next($request);
    }

}

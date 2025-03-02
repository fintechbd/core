<?php

namespace Fintech\Core\Http\Middlewares;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Localization
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     * @return JsonResponse|mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->hasHeader('Language')) {
            $locale = $request->header('Language', app()->getLocale());
            app()->setLocale($locale);
        }

        return $next($request);
    }

}

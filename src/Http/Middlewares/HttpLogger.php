<?php

namespace Fintech\Core\Http\Middlewares;

use Closure;
use Fintech\Core\Facades\Core;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HttpLogger
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (config('fintech.core.http_logger_enabled', false)) {

            $data = [
                'direction' => \Fintech\Core\Enums\ApiDirectionEnum::InBound->value,
                'user_id' => ($request->user() != null) ? $request->user()->id : null,
                'method' => $request->method(),
                'host' => $request->getHttpHost(),
                'url' => $request->fullUrl(),
                'type' => $request->getContentTypeFormat(),
                'status_code' => null,
                'status_text' => null,
                'request' => [
                    'header' => $request->headers,
                    'body' => $request->all(),
                    'files' => $request->allFiles()
                ],
                'response' => [
                    'header' => null,
                    'body' => [],
                    'files' => []
                ],
                'user_agent' => $request->userAgent()

            ];

            Core::apiLog()->create($data);
        }

        return $next($request);
    }
}

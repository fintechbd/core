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
                'url' => $request->url(),
                'type' => $request->getContentTypeFormat(),
                'status_code' => null,
                'status_text' => null,
                'request' => [
                    'headers' => collect($request->headers->all())->map(fn ($item) => ($item[0] ?? null))->toArray(),
                    'payload' => ($request->method() == 'GET') ? $request->query() : $request->all(),
                    'files' => $request->allFiles()
                ],
                'response' => [
                    'headers' => [],
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

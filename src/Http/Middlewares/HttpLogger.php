<?php

namespace Fintech\Core\Http\Middlewares;

use Closure;
use Fintech\Core\Enums\RequestDirection;
use Fintech\Core\Facades\Core;
use Fintech\Core\Supports\Utility;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;

class HttpLogger
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        return $next($request);
    }

    /**
     * Handle tasks after the response has been sent to the browser.
     */
    public function terminate(Request $request, Response $response): void
    {
        if (config('fintech.core.http_logger_enabled', false)) {

            $data = [
                'direction' => RequestDirection::InBound->value,
                'user_id' => ($request->user() != null) ? $request->user()->id : null,
                'method' => $request->method(),
                'host' => $request->getHttpHost(),
                'url' => $request->url(),
                'status_code' => $response->getStatusCode(),
                'status_text' => Response::$statusTexts[$response->getStatusCode()] ?? null,
                'ip_address' => $request->ip(),
                'request' => [
                    'timestamp' => ($_SERVER['REQUEST_TIME_FLOAT'] ?? $_SERVER['REQUEST_TIME']),
                    'type' => $request->hasHeader('Content-Type') ? $request->header('Content-Type') : 'application/x-www-form-urlencoded',
                    'headers' => collect($request->headers->all())->map(fn ($item) => ($item[0] ?? null))->toArray(),
                    'payload' => $request->except(config('fintech.core.secret_fields', [])),
                ],
                'response' => [
                    'type' => 'application/json',
                    'timestamp' => microtime(true),
                    'duration' => (microtime(true) - ($_SERVER['REQUEST_TIME_FLOAT'] ?? $_SERVER['REQUEST_TIME'])),
                    'headers' => collect($response->headers->all())->map(fn ($item) => ($item[0] ?? null))->toArray(),
                    'body' => $response->getContent()
                ],
                'user_agent' => $request->userAgent()
            ];

            if (Utility::isJson($data['response']['body'])) {
                $data['response']['body'] = json_decode($data['response']['body'], true);
            }

            Core::apiLog()->create($data);
        }
    }
}

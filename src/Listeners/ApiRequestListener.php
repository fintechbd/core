<?php

namespace Fintech\Core\Listeners;

use Fintech\Core\Enums\RequestDirection;
use Fintech\Core\Facades\Core;
use Fintech\Core\Supports\Utility;
use Illuminate\Http\Client\Events\ConnectionFailed;
use Illuminate\Http\Client\Events\ResponseReceived;
use Illuminate\Http\Client\Request;
use Illuminate\Http\Client\Response;

class ApiRequestListener
{
    /**
     * Handle the event.
     *
     * @param object $event
     * @return void
     */
    public function handle(object $event)
    {
        if (!config('fintech.core.api_logger_enabled', false)) {
            return;
        }

        /**
         * @var Request $request
         */
        $request = $event->request;

        /**
         * @var Response $response
         */
        $response = $event->response ?? null;

        $data = [
            'direction' => RequestDirection::OutBound->value,
            'user_id' => request()->user()->id ?? null,
            'method' => $request->method(),
            'host' => $request->toPsrRequest()->getUri()->getHost(),
            'url' => $request->url(),
            'status_code' => 0,
            'status_text' => 'N/A',
            'ip_address' => $_SERVER['SERVER_ADDR'] ?? null,
            'request' => [
                'timestamp' => time(),
                'type' => $request->hasHeader('Content-Type') ? $request->header('Content-Type') : 'application/x-www-form-urlencoded',
                'headers' => collect($request->headers())->map(fn($item) => ($item[0] ?? null))->toArray(),
                'payload' => ($request->isForm() || $request->isJson()) ? $request->data() : [$request->body()],
            ],
            'response' => [
                'type' => 'application/json',
                'timestamp' => time(),
                'duration' => 0,
                'headers' => [],
                'body' => ''
            ],
            'user_agent' => null
        ];

        if ($event instanceof ResponseReceived) {
            $data['status_code'] = $response->status();
            $data['status_text'] = $response->reason();

            $response_time = $response->handlerStats()['total_time_us'] ?? 0;
            if ($response_time > 0) {
                $response_time = $response_time / 1000000.0;
            }

            $data['response']['duration'] = $response_time;
            $data['response']['headers'] = collect($response->headers())->map(fn($item) => ($item[0] ?? null))->toArray();
            $data['response']['body'] = Utility::isJson($response->body()) ? json_decode($response->body(), true) : $response->body();
        }

        if ($event instanceof ConnectionFailed) {
            $data['status_code'] = 503;
            $data['status_text'] = 'Connection Failed';
            $data['response']['timestamp'] = time();
            $data['response']['duration'] = 0;
            $data['response']['headers'] = [];
            $data['response']['body'] = '';
        }

        Core::apiLog()->create($data);
    }
}

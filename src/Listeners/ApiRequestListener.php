<?php

namespace Fintech\Core\Listeners;

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

        $request = $event->request;

        $response = $event->response ?? null;

        $data = [
            'direction' => \Fintech\Core\Enums\ApiDirectionEnum::OutBound->value,
            'user_id' => null,
            'method' => $request->method(),
            'host' => $request->toPsrRequest()->getUri()->getHost(),
            'url' => $request->url(),
            'type' => ($request->isMultipart() || $request->isForm()) ? 'form' : 'json',
            'request' => [
                'headers' => collect($request->headers())->map(fn($item) => ($item[0] ?? null))->toArray(),
                'payload' => $request->data(),
            ],
            'response' => [
                'time' => 0,
                'headers' => [],
                'body' => []
            ],
            'user_agent' => null
        ];

        if ($event instanceof \Illuminate\Http\Client\Events\ResponseReceived) {
            $data['status_code'] = $response->status();
            $data['status_text'] = $response->reason();

            $response_time = $response->handlerStats()['total_time_us'] ?? 0;
            if ($response_time > 0) {
                $response_time = $response_time / 1000000.0;
            }

            $data['response']['time'] = $response_time . ' seconds';
            $data['response']['headers'] = $response->headers();
            $data['response']['body'] = $response->body();
        }

        if ($event instanceof \Illuminate\Http\Client\Events\ConnectionFailed) {
            $data['status_code'] = 503;
            $data['status_text'] = 'Connection Failed';
            $data['response']['time'] = 0;
            $data['response']['headers'] = [];
            $data['response']['body'] = [];
        }

        \Fintech\Core\Facades\Core::apiLog()->create($data);
    }
}

<?php

namespace Fintech\Core\Listeners;

use Illuminate\Http\Client\Events\ConnectionFailed;
use Illuminate\Http\Client\Events\ResponseReceived;
use Illuminate\Http\Client\Request;

class OutBoundRequestListener
{
    protected Request $request;

    protected $response;

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

        $this->request = $event->request;
        $this->response = $event->response ?? null;

        $api_host = $this->request->toPsrRequest()->getUri()->getHost();

        $this->apiLog->group = $this->request->toPsrRequest()->getUri()->getHost();
        $this->apiLog->method = $this->request->method();
        $this->apiLog->url = $this->request->url();
        $this->apiLog->type = $this->request->header('Content-Type')[0] ?? 'application/x-www-form-urlencoded';
        $this->apiLog->request_header = $this->request->headers();
        $this->apiLog->request_body = $this->request->data();

        if ($event instanceof ResponseReceived) {
            $this->apiLog->status_code = $this->response->status();
            $this->apiLog->status_text = $this->response->reason();

            $this->apiLog->response_time = $this->response->handlerStats()['total_time_us'] ?? 0;
            if ($this->apiLog->response_time > 0) {
                $this->apiLog->response_time = $this->apiLog->response_time / 1000000.0;
            }

            $this->apiLog->response_header = $this->response->headers();
            $this->apiLog->response_body = $this->response->body();
        }

        if ($event instanceof ConnectionFailed) {
            $this->apiLog->status_code = 500;
            $this->apiLog->status_text = 'Connection Failed';
            $this->apiLog->response_time = 0;
            $this->apiLog->response_header = [];
            $this->apiLog->response_body = [];
        }

        $this->apiLog->save();
    }


    private function getHostFromUri(string $uri = null)
    {
        return parse_url($uri, PHP_URL_HOST);

    }
}

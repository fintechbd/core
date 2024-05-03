<?php

namespace Fintech\Core\Providers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;

class MacroServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {

    }

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        Request::macro('platform', function (string $platform = null) {
            $headerPlatform = request()->header('Platform', null);
            return ($platform != null) ? strtolower($headerPlatform) == strtolower($platform) : $headerPlatform;
        });

        Http::macro('soap', function (string $url = '/', string $method = '', string $payload = '') {
            return Http::withoutVerifying()
                ->withHeaders([
                    'Host' => parse_url($url, PHP_URL_HOST),
                    'SOAPAction' => $method,
                    'Content-Length' => strlen($payload),
                    'Content-Type' => 'text/xml;charset="utf-8"',
                ])
                ->post($url, $payload);
        });
    }
}

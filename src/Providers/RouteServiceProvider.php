<?php

namespace Fintech\Core\Providers;

use Fintech\Core\Http\Middlewares\EncryptedRequestResponse;
use Fintech\Core\Http\Middlewares\HttpLogger;
use Fintech\Core\Http\Middlewares\ImposterCheck;
use Fintech\Core\Http\Middlewares\PlatformCheck;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(__DIR__ . '/../../routes/api.php');
        });

        $this->pushMiddlewareToGroup('api', HttpLogger::class)
            ->pushMiddlewareToGroup('api', EncryptedRequestResponse::class)
            ->pushMiddlewareToGroup('api', PlatformCheck::class)
            ->pushMiddlewareToGroup('imposter', ImposterCheck::class);
    }
}

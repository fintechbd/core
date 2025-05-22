<?php

namespace Fintech\Core\Providers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class OverwriteServiceProvider extends ServiceProvider
{
    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        Http::beforeSending(function ($request, $options) {
            $request->withHeaders([
                'X-User-Agent' => Str::studly(config('app.name'))." By Fintech Bangladesh/". app()->version(),
                'X-Environment' => Str::title(config('app.env')),
            ]);
        });
    }
}

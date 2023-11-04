<?php

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
if (Config::get('fintech.core.enabled')) {

    Route::prefix('core')->name('core.')
        ->middleware(config('fintech.auth.middleware'))
        ->group(function () {
        Route::apiResource('settings', \Fintech\Core\Http\Controllers\SettingController::class);
        Route::post('settings/{id}/restore', [\Fintech\Core\Http\Controllers\SettingController::class, 'restore'])->name('settings.restore');
        Route::apiResource('configurations', \Fintech\Core\Http\Controllers\ConfigurationController::class)->only(['show', 'update', 'destroy']);

        Route::apiResource('jobs', \Fintech\Core\Http\Controllers\JobController::class);

        //DO NOT REMOVE THIS LINE//
    });
}

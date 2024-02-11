<?php

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

Route::get('core/session-token', \Fintech\Core\Http\Controllers\EncryptedKeyController::class);

if (config('fintech.core.enabled')) {
    Route::prefix('core')->name('core.')
        ->middleware(config('fintech.auth.middleware'))
        ->group(function () {
            Route::apiResource('settings', \Fintech\Core\Http\Controllers\SettingController::class);
            Route::post('settings/{setting}/restore', [\Fintech\Core\Http\Controllers\SettingController::class, 'restore'])->name('settings.restore');

            Route::apiResource('configurations', \Fintech\Core\Http\Controllers\ConfigurationController::class)->only(['show', 'update', 'destroy']);

            Route::apiResource('jobs', \Fintech\Core\Http\Controllers\JobController::class)->only(['index', 'show', 'destroy']);

            Route::apiResource('api-logs', \Fintech\Core\Http\Controllers\ApiLogController::class)->only(['index', 'show', 'destroy']);

            Route::post('failed-jobs/prune', [\Fintech\Core\Http\Controllers\FailedJobController::class, 'prune'])->name('failed-jobs.prune');
            Route::apiResource('failed-jobs', \Fintech\Core\Http\Controllers\FailedJobController::class)->only(['index', 'show', 'destroy']);
            Route::post('failed-jobs/{failed_job}/retry', [\Fintech\Core\Http\Controllers\FailedJobController::class, 'retry'])->name('failed-jobs.retry');

            //DO NOT REMOVE THIS LINE//
        });
}

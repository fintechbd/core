<?php

use Fintech\Core\Http\Controllers\ApiLogController;
use Fintech\Core\Http\Controllers\ConfigurationController;
use Fintech\Core\Http\Controllers\EncryptedKeyController;
use Fintech\Core\Http\Controllers\FailedJobController;
use Fintech\Core\Http\Controllers\JobController;
use Fintech\Core\Http\Controllers\SettingController;
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

Route::get('core/session-token', EncryptedKeyController::class);

if (config('fintech.core.enabled')) {
    Route::prefix('core')->name('core.')
        ->middleware(config('fintech.auth.middleware'))
        ->group(function () {
            Route::apiResource('settings', SettingController::class);
            Route::post('settings/{setting}/restore', [SettingController::class, 'restore'])->name('settings.restore');

            Route::apiResource('configurations', ConfigurationController::class)->only(['show', 'update', 'destroy']);

            Route::apiResource('jobs', JobController::class)->only(['index', 'show', 'destroy']);

            Route::apiResource('api-logs', ApiLogController::class)->only(['index', 'show', 'destroy']);

            Route::post('failed-jobs/prune', [FailedJobController::class, 'prune'])->name('failed-jobs.prune');
            Route::apiResource('failed-jobs', FailedJobController::class)->only(['index', 'show', 'destroy']);
            Route::post('failed-jobs/{failed_job}/retry', [FailedJobController::class, 'retry'])->name('failed-jobs.retry');

            //DO NOT REMOVE THIS LINE//
        });
}

<?php

use Fintech\RestApi\Http\Controllers\Core\ApiLogController;
use Fintech\RestApi\Http\Controllers\Core\ConfigurationController;
use Fintech\RestApi\Http\Controllers\Core\EncryptedKeyController;
use Fintech\RestApi\Http\Controllers\Core\FailedJobController;
use Fintech\RestApi\Http\Controllers\Core\JobController;
use Fintech\RestApi\Http\Controllers\Core\PackageRegisteredController;
use Fintech\RestApi\Http\Controllers\Core\ScheduleController;
use Fintech\RestApi\Http\Controllers\Core\SettingController;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "API" middleware group. Enjoy building your API!
|
*/

if (Config::get('fintech.core.enabled')) {
    Route::prefix('core')->name('core.')->group(function () {
        Route::get('session-token', EncryptedKeyController::class)->name('session-token');
        Route::get('packages', PackageRegisteredController::class)->name('packages');
    });
    Route::prefix('core')->name('core.')
        ->middleware(config('fintech.auth.middleware'))
        ->group(function () {
            Route::apiResource('settings', SettingController::class);
            //             Route::post('settings/{setting}/restore', [SettingController::class, 'restore'])->name('settings.restore');

            Route::apiResource('configurations', ConfigurationController::class)
                ->only(['show', 'update', 'destroy']);

            Route::apiResource('jobs', JobController::class)
                ->only(['index', 'show', 'destroy']);

            Route::apiResource('api-logs', ApiLogController::class)
                ->only(['index', 'show', 'destroy']);

            Route::post('failed-jobs/prune', [FailedJobController::class, 'prune'])
                ->name('failed-jobs.prune');

            Route::apiResource('failed-jobs', FailedJobController::class)
                ->only(['index', 'show', 'destroy']);

            Route::post('failed-jobs/{failed_job}/retry', [FailedJobController::class, 'retry'])
                ->name('failed-jobs.retry');

            Route::get('schedules/{schedule}/health/{status}', [ScheduleController::class, 'health'])->name('schedules.health');
            Route::apiResource('schedules', ScheduleController::class);
            Route::post('schedules/{schedule}/restore', [ScheduleController::class, 'restore'])->name('schedules.restore');

            Route::apiResource('translations', \Fintech\RestApi\Http\Controllers\Core\TranslationController::class);
            Route::post('translations/{translation}/restore', [\Fintech\RestApi\Http\Controllers\Core\TranslationController::class, 'restore'])->name('translations.restore');
            Route::post('translations/{translation}/download', [\Fintech\RestApi\Http\Controllers\Core\TranslationController::class, 'download'])->name('translations.download');

            Route::apiResource('job-batches', \Fintech\RestApi\Http\Controllers\Core\JobBatchController::class);
            Route::post('job-batches/{job_batch}/restore', [\Fintech\RestApi\Http\Controllers\Core\JobBatchController::class, 'restore'])->name('job-batches.restore');

            Route::apiResource('client-errors', \Fintech\RestApi\Http\Controllers\Core\ClientErrorController::class);
            Route::post('client-errors/{client_error}/restore', [\Fintech\RestApi\Http\Controllers\Core\ClientErrorController::class, 'restore'])->name('client-errors.restore');

            //DO NOT REMOVE THIS LINE//
        });
}

<?php

use Fintech\Core\Http\Controllers\ApiLogController;
use Fintech\Core\Http\Controllers\ConfigurationController;
use Fintech\Core\Http\Controllers\EncryptedKeyController;
use Fintech\Core\Http\Controllers\FailedJobController;
use Fintech\Core\Http\Controllers\JobController;
use Fintech\Core\Http\Controllers\PackageRegisteredController;
use Fintech\Core\Http\Controllers\ScheduleController;
use Fintech\Core\Http\Controllers\SettingController;
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
        Route::post('client-errors', [\Fintech\Core\Http\Controllers\ClientErrorController::class, 'store'])
            ->name('client-errors.store');
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

            Route::apiResource('translations', \Fintech\Core\Http\Controllers\TranslationController::class);
            Route::post('translations/{translation}/restore', [\Fintech\Core\Http\Controllers\TranslationController::class, 'restore'])->name('translations.restore');
            Route::post('translations/{translation}/download', [\Fintech\Core\Http\Controllers\TranslationController::class, 'download'])
                ->name('translations.download')
                ->withoutMiddleware(config('fintech.auth.middleware', []));

            Route::apiResource('job-batches', \Fintech\Core\Http\Controllers\JobBatchController::class);
            Route::post('job-batches/{job_batch}/restore', [\Fintech\Core\Http\Controllers\JobBatchController::class, 'restore'])->name('job-batches.restore');

            Route::apiResource('client-errors', \Fintech\Core\Http\Controllers\ClientErrorController::class)
                ->only('index', 'show', 'destroy');
            Route::post('client-errors/{client_error}/restore', [\Fintech\Core\Http\Controllers\ClientErrorController::class, 'restore'])->name('client-errors.restore');

            //DO NOT REMOVE THIS LINE//
        });
}

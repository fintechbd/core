<?php


use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register Web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "Web" middleware group. Enjoy building your Web!
|
*/
Route::prefix('core')->name('core.')->group(function () {
    Route::get('/health-check', \Fintech\Core\Http\Controllers\HealthCheckController::class)->name('health.check');
});

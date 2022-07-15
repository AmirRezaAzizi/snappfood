<?php

use Illuminate\Http\Request;

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

Route::post('customer/delay-report', [\Modules\DelayReport\Http\Controllers\DelayReportController::class, 'store']);

Route::get('agent/delay-report', [\Modules\DelayReport\Http\Controllers\DelayReportController::class, 'index']);

<?php

use Illuminate\Http\Request;
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

Route::post('customer/delay-report', [\App\Http\Controllers\DelayReportController::class, 'store']);

Route::get('agent/delay-report', [\App\Http\Controllers\DelayReportController::class, 'get']);

Route::get('admin/orders', [\App\Http\Controllers\OrderController::class, 'index']);

Route::get('admin/vendors/delay-report', [\App\Http\Controllers\VendorDelayController::class, 'index']);

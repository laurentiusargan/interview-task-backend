<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvoiceController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(
    array('prefix' => '/invoice'), function () {
    Route::get('/{invoiceId}', [InvoiceController::class, 'getInvoice']);
    Route::put('/approve/{invoiceId}', [InvoiceController::class, 'approveInvoice']);
    Route::put('/reject/{invoiceId}', [InvoiceController::class, 'rejectInvoice']);
});
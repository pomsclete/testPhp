<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

 Route::post('orders', [\App\Http\Controllers\OrderController::class, 'store']);
 Route::get('orders/{order}', [\App\Http\Controllers\OrderController::class, 'show'])->name('orders.show');
 Route::put('orders/{order}', [\App\Http\Controllers\OrderController::class, 'update']);
 Route::delete('orders/{order}', [\App\Http\Controllers\OrderController::class, 'delete']);

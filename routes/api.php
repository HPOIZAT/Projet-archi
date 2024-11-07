<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group([], function () {
    Route::group(['prefix' => 'users'], function () {
        Route::get('/', [UserController::class, 'index']);
        Route::get('/{id}', [UserController::class, 'show']);
        Route::post('/', [UserController::class, 'store']);
        Route::delete('/{id}', [UserController::class, 'destroy']);
        Route::delete('/close/{id}', [UserController::class, 'delete']);
    });

    Route::group(['prefix' => 'books'], function () {
        Route::get('/', [BookController::class, 'index']);
        Route::get('/{id}', [BookController::class, 'show']);
        Route::post('/', [BookController::class, 'store']);
        Route::delete('/{id}', [BookController::class, 'destroy']);
    });

    Route::group(['prefix' => 'reservations'], function () {
        Route::get('/', [ReservationController::class, 'index']);
        Route::get('/{id}', [ReservationController::class, 'show']);
        Route::post('/', [ReservationController::class, 'reserve']);
    });
});

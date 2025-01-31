<?php

use App\Http\Controllers\GagarinController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/registration', [UserController::class, 'registration']);
Route::post('/authorization', [UserController::class, 'authorization']);
Route::get('/logout', [UserController::class, 'logout'])->middleware('auth:sanctum');
Route::get('/gagarin-flight', [GagarinController::class, 'gagarinFlight'])->middleware('auth:sanctum');
Route::get('flight', [GagarinController::class, 'flight'])->middleware('auth:sanctum');

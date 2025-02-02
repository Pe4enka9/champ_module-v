<?php

use App\Http\Controllers\GagarinController;
use App\Http\Controllers\LunarMissionsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post('/registration', [UserController::class, 'registration']);
Route::post('/authorization', [UserController::class, 'authorization']);
Route::get('/logout', [UserController::class, 'logout'])->middleware('auth:sanctum');
Route::get('/gagarin-flight', [GagarinController::class, 'gagarinFlight'])->middleware('auth:sanctum');
Route::get('flight', [GagarinController::class, 'flight'])->middleware('auth:sanctum');
Route::get('/lunar-missions', [LunarMissionsController::class, 'lunarMissions'])->middleware('auth:sanctum');
Route::post('/lunar-missions', [LunarMissionsController::class, 'addLunarMissions'])->middleware('auth:sanctum');
Route::delete('/lunar-missions/{id}', [LunarMissionsController::class, 'deleteLunarMission'])->middleware('auth:sanctum');

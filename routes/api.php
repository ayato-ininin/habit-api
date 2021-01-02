<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HabitController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ContainsController;



Route::post('/register',[RegisterController::class,'post']);
Route::post('/login',[LoginController::class,'post']);
Route::post('/logout',[LogoutController::class,'post']);
Route::apiResource('/habits',HabitController::class);
Route::get('/user',[UsersController::class,'get']);
Route::put('/user',[UsersController::class,'put']);
Route::post('/contain',[ContainsController::class,'post']);
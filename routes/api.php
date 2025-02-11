<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']); 

Route::post('/login', [AuthController::class, 'login']); 

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('/questions', 'App\Http\Controllers\QuestionController@index');
    Route::post('/questions', 'App\Http\Controllers\QuestionController@store');

    Route::post('/logout', [AuthController::class, 'logout']);
});
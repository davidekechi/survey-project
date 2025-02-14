<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']); 

Route::post('/login', [AuthController::class, 'login']); 

Route::get('/users/awaiting-survey', 'App\Http\Controllers\UserController@getAwaitingSurveys');

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('/questions', 'App\Http\Controllers\QuestionController@index');
    Route::get('/questions/{param}', 'App\Http\Controllers\QuestionController@index');
    Route::post('/questions', 'App\Http\Controllers\QuestionController@store');

    Route::get('/answers/{question_id}', 'App\Http\Controllers\QuestionController@getAnswers');

    Route::post('/logout', [AuthController::class, 'logout']);
});
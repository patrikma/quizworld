<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

/**
 * Public routes
 */

// Homepage
Route::get('/', function () {
    return view('welcome');
});

// Quiz app (wildcard)
Route::get('/play/{path?}', function ($path = null) {
    return view('quizzes');
})->where('path', '.*');

/**
 * Admin and dashboard routes
 */

// Auth
Auth::routes(['register' => false]);

// Dashboard
Route::get('/home', 'HomeController@index')->name('home');

// Quiz creation
Route::get('/create-new-quiz', 'QuizController@create')->middleware('auth');
Route::post('/store-new-quiz', 'QuizController@store')->middleware('auth');

// Question creation
Route::get('/create-new-question', 'QuestionAnswerController@create')->middleware('auth');
Route::post('/store-new-question', 'QuestionAnswerController@store')->middleware('auth');

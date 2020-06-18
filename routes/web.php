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

// Quiz list
Route::get('/play/{path?}', function ($path = null) {
    return view('quizzes');
})->where('path', '.*');

/**
 * Admin and dashboard routes
 */

// Auth
Auth::routes();

// Dashboard
Route::get('/home', 'HomeController@index')->name('home');

// Quiz creation
Route::get('/create-new-quiz', 'QuizController@create')->middleware('auth');
Route::post('/store-new-quiz', 'QuizController@store')->middleware('auth');

// Question creation
Route::get('/create-new-question', 'QuestionController@create')->middleware('auth');
Route::post('/store-new-question', 'QuestionController@store')->middleware('auth');

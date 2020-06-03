<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

*/
// Returns all available quizzes
Route::get('all-quizzes', 'QuizController@index');

// Returns info about the selected quiz
Route::get('quiz-info/{quizId}', 'QuizController@show');

// Returns questions for the quiz with the given ID
Route::get('all-questions/{quizId}', 'QuestionController@index');

// Returns all options for the question with the given ID (ONLY FOR TYPE 0!)
Route::get('all-options/{quizId}', 'OptionController@index');

Route::get('correct-results/{quizId}', 'QuizController@correctOptionsAnswers');

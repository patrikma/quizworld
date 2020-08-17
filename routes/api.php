<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

/**
 * Returns all available quizzes
 * [{id, name, total (total number of questions)}]
 */
Route::get('all-quizzes', 'QuizController@index');

/**
 * Returns info about the selected quiz
 * {name, total (total number of questions)}
 */
Route::get('quiz-info/{quizId}', 'QuizController@show');

/**
 * Returns questions for the quiz with the given ID
 * [{id, text, type, quiz_id, created_at, updated_at}]
 */
Route::get('all-questions/{quizId}', 'QuestionAnswerController@index');

/**
 * Returns all options for the question with the given ID (ONLY FOR TYPE 0!)
 * [{id, text, question_id}]
 */
Route::get('all-options/{questionId}', 'OptionController@index');

/**
 * Returns url of the image (if is available) for the given question ID.
 */
Route::get('question-image/{questionId}', 'QuestionImageController@get');

/**
 * Returns a collection of questions belonging to the quiz with the given ID  and correct results for all of them
 * [{question_id, text, type, opt_id, answer}]
 */
Route::get('correct-results/{quizId}', 'QuestionAnswerController@correctOptionsAnswers');

/**
 * Returns a random quiz
 * {id, name, created_at, updated_at}
 */
Route::get('random-quiz', 'QuizController@randomQuiz');

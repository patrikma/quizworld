<?php

namespace App\Http\Controllers;

use App\Question;
use App\Quiz;
use App\Http\Resources\Quiz as QuizResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuizController extends Controller
{
    /**
     * Get listing of quizzes with a number of questions belonging to it as a resource
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $quizzes = Quiz::join('questions', 'quizzes.id', '=', 'questions.quiz_id')->groupBy('quizzes.id', 'name')
            ->select('quizzes.id', 'name', DB::raw('count(*) as total'))->get()->sortByDesc('id');
        return QuizResource::collection($quizzes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.quizzes.create');
    }

    /**
     * Store a newly created quiz in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $request->validate(['name' => 'required']);

        $quiz = new Quiz;
        $quiz->name = $request->input('name');
        $quiz->save();

        return redirect('home');
    }

    /**
     * Get info about the current quiz
     *
     * @param  int  $id
     * @return QuizResource
     */
    public function show($id)
    {
        $quiz = Quiz::join('questions', 'quizzes.id', '=', 'questions.quiz_id')->where('quizzes.id', $id)->
        groupBy('name')->select('name', DB::raw('count(*) as total'))->firstOrFail();

        return new QuizResource($quiz);
    }

    public function correctOptionsAnswers($quizId) {
        $correctOptions = Question::where('quiz_id', '=', $quizId)
            ->join('options', 'options.question_id', '=', 'questions.id')
            ->join('correct_options', 'correct_options.option_id', '=', 'options.id')
            ->select('questions.id AS question_id', 'questions.text AS text', 'type', 'options.id AS opt_id',
                'options.text AS answer');
        $correctAnswers = Question::where('quiz_id', '=', $quizId)
            ->join('answers', 'answers.question_id', '=', 'questions.id')
            ->select('questions.id AS question_id', 'questions.text AS text', 'type', 'answers.id AS opt_id',
                'answers.answer AS answer')->union($correctOptions)->get()->sortBy('question_id');
        return QuizResource::collection($correctAnswers);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

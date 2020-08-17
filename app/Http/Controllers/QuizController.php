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
     * Show the form for creating a new quiz.
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
     * Get info about the current quiz - name and total number of questions
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

    /**
     * Gets a random quiz
     * @return QuizResource
     */
    public function randomQuiz() {
        $randomQuiz = Quiz::all()->random(1)->first();
        return new QuizResource($randomQuiz);
    }
}

<?php

namespace App\Http\Controllers;

use App\Answer;
use App\CorrectOption;
use App\Option;
use App\Question;
use App\Http\Resources\Question as QuestionResource;
use App\Quiz;
use Illuminate\Http\Request;

/**
 * Manages questions and their answers
 */
class QuestionAnswerController extends Controller
{
    private $MULTIPLE_OPTIONS_IDENTIFIER = 0;

    /**
     * Get all questions belonging to a quiz as a resource
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index($quizId)
    {
        $questions = Quiz::find($quizId)->questions()->get();
        return QuestionResource::collection($questions);
    }

    /**
     * Show the form for creating a new question.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $quizzes = Quiz::all();
        return view('admin.questions.create', ['quizes' => $quizzes]);
    }

    /**
     * Save correct option belonging to the question
     * @param Question $question - newly created question
     * @param $optionId - id of the correct option
     */
    private function saveCorrectoption(Question $question, $optionId)
    {
        $correctOption = new CorrectOption();
        $correctOption->option_id = $optionId;
        $question->correctOption()->save($correctOption);
    }

    /**
     * Save a collection of options (type 0)
     * @param Question $question - newly created question
     * @param Request $request
     */
    private function storeMultipleOptions(Question $question, Request $request)
    {
        $correctOptionIndex = $request->input('correct_option');
        foreach ($request->input("option") as $index => $optionInput) {
            $option = new Option();
            $option->text = $optionInput;
            $question->options()->save($option);
            if ($index == $correctOptionIndex) {
                $this->saveCorrectoption($question, $option->id);
            }
        }
    }

    /**
     * Saves a correct text answer (type 1)
     * @param Question $question - newly created question
     * @param Request $request
     */
    public function storeAnswer(Question $question, Request $request)
    {
        $answer = new Answer();
        $answer->answer = $request->input('answer');
        $question->answer()->save($answer);
    }

    /**
     * Store a newly created question.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $question = new Question();
        $question->text = $request->input('text');
        $question->type = $request->input('question_type');
        $question->quiz_id = $request->input('quiz_id');
        $question->save();

        //If an answer with multiple options is selected
        if ($request->input('question_type') == $this->MULTIPLE_OPTIONS_IDENTIFIER) {
            $this->storeMultipleOptions($question, $request);
            return redirect('home');
        }

        //If a question with text answer is selected
        $this->storeAnswer($question, $request);
        return redirect('home');
    }

    /**
     * Returns an array of correct answers and options for the given quiz
     * @param $quizId - quiz ID
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function correctOptionsAnswers($quizId)
    {
        $correctOptions = Question::where('quiz_id', '=', $quizId)
            ->join('options', 'options.question_id', '=', 'questions.id')
            ->join('correct_options', 'correct_options.option_id', '=', 'options.id')
            ->select('questions.id AS question_id', 'questions.text AS text', 'type', 'options.id AS opt_id',
                'options.text AS answer');
        $correctAnswers = Question::where('quiz_id', '=', $quizId)
            ->join('answers', 'answers.question_id', '=', 'questions.id')
            ->select('questions.id AS question_id', 'questions.text AS text', 'type', 'answers.id AS opt_id',
                'answers.answer AS answer')->union($correctOptions)->get()->sortBy('question_id');
        return QuestionResource::collection($correctAnswers);
    }
}

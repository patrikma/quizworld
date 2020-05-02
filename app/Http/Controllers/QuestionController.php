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
class QuestionController extends Controller
{
    private $MULTIPLE_OPTIONS_IDENTIFIER = 0;

    /**
     * Get all question belonging to a quiz as a resource
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index($quizId)
    {
        $questions = Quiz::find($quizId)->questions()->get();
        return QuestionResource::collection($questions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $quizes = Quiz::all();
        return view('admin.questions.create', ['quizes' => $quizes]);
    }

    public function storeMultipleOptions(Question $question, Request $request) {
        $correctOptionIndex = $request->input('correct_option');
        foreach ($request->input("option") as $index => $optionInput) {
            $option = new Option();
            $option->text = $optionInput;
            $question->options()->save($option);
            if ($index == $correctOptionIndex) {
                $correctOption = new CorrectOption();
                $correctOption->option_id = $option->id;
                $question->correctOption()->save($correctOption);
            }
        }
    }

    public function storeAnswer(Question $question, Request $request) {
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function get($questionId)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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

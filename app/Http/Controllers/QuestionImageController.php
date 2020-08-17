<?php

namespace App\Http\Controllers;

use App\Question;
use App\QuestionImage;
use App\Http\Resources\QuestionImage as QuestionImageResource;
use Illuminate\Http\Request;

class QuestionImageController extends Controller
{
    /**
     * Get an image for a question with the given ID.
     *
     * @param  int  $id
     * @return QuestionImageResource
     */
    public function get($questionId)
    {
        $image = Question::find($questionId)->image()->first();
        return new QuestionImageResource($image);
    }
}

<?php

namespace App\Http\Controllers;

use App\QuestionImage;
use App\Http\Resources\QuestionImage as QuestionImageResource;
use Illuminate\Http\Request;

class QuestionImageController extends Controller
{
    /**
     * Get an image for question with the given ID.
     *
     * @param  int  $id
     * @return QuestionImageResource
     */
    public function get($questionId)
    {
        $image = QuestionImage::where('question_id', $questionId)->first();
        return new QuestionImageResource($image);
    }
}

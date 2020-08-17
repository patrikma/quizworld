<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;
use App\Http\Resources\Option as OptionResource;

class OptionController extends Controller
{
    /**
     * Gets all options for the given question
     * @param $questionId
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index($questionId)
    {
        $options = Question::findOrFail($questionId)->options()->get();
        return OptionResource::collection($options);
    }
}

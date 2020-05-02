<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $table = "quizzes";
    public $timestamps = true;

    public function questions() {
        return $this->hasMany('App\Question');
    }
}

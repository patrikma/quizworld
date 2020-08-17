<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = "questions";
    public $timestamps = true;

    public function options() {
        return $this->hasMany('App\Option');
    }

    public function correctOption() {
        return $this->hasOne('App\CorrectOption');
    }

    public function answer() {
        return $this->hasOne('App\Answer');
    }

    public function image() {
        return $this->hasOne('App\QuestionImage');
    }
}

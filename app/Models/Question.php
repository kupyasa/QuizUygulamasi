<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = ['quiz_id','question','image','answer1','answer2','answer3','answer4','correct_answer'];

    protected $appends = ['correct_percentage'];
    
    public function my_answer(){
        return $this->hasOne(Answer::class)->where([['user_id','=',auth()->user()->id]]);
    }

    public function quiz(){
        return $this->belongsTo(Quiz::class);
    }

    public function answers(){
        return $this->hasMany(Answer::class);
    }

    public function getCorrectPercentageAttribute() {
        $answer_count = $this->answers()->count();
        $correct_answer_count = $this->answers()->where([['answer','=',$this->correct_answer]])->count();
        
        return round(($correct_answer_count/$answer_count) * 100);
    }
}

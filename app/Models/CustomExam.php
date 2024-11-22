<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomExam extends Model
{
    protected $guarded = [];
    protected $table = 'custom_exams';

    
    public function questions()
    {
        return $this->belongsToMany(Question::class, 'custom_exam_question', 'custom_exam_id', 'question_id');
    }
    public function examTaker(){
        return $this->belongsTo(User::class, 'exam_taker');
    }
}

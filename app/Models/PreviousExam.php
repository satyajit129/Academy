<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PreviousExam extends Model
{
    protected $guarded = [];
    protected $table = 'previous_exams';

    public function year(){
        return $this->belongsTo(Year::class);
    }
    public function questions()
    {
        return $this->belongsToMany(Question::class, 'previous_exam_question', 'exam_id', 'question_id');
    }
    public function category(){
        return $this->belongsTo(PreviousExamCategory::class);
    }
}

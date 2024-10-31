<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $guarded = [];
    protected $table = 'questions';

    public function option(){
        return $this->belongsToMany(Option::class, 'question_id', 'id');
    }
    public function subjectTopic(){
        return $this->belongsTo(SubjectTopic::class, 'topic_id', 'id');
    }
    public function questionType(){
        return $this->belongsTo(QuestionType::class, 'question_type', 'id');
    }
}

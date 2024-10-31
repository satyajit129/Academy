<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubjectTopic extends Model
{
    protected $guarded = [];
    protected $table = 'subject_topics';
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
    public function subjectLessons()
    {
        return $this->belongsTo(SubjectLesson::class , 'lesson_id');
    }
    
}

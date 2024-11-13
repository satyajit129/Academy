<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubjectLesson extends Model
{
    protected $table = 'subject_lessons';
    protected $guarded = [];


    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
    public function questions()
    {
        return $this->hasMany(Question::class, 'lesson_id');
    }
    public function topics()
    {
        return $this->hasMany(SubjectTopic::class, 'lesson_id');
    }
}

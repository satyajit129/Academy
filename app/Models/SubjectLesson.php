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
}

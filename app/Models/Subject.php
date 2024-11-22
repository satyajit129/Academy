<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $guarded = [];
    protected $table = 'subjects';

    public function questions()
    {
        return $this->hasMany(Question::class, 'subject_id');
    }
    public function lessons()
    {
        return $this->hasMany(SubjectLesson::class, 'subject_id');
    }
}

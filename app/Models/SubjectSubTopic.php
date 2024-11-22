<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubjectSubTopic extends Model
{
    protected $table = 'subject_sub_topics';

    protected $guarded = [];

    public function subjectTopic()
    {
        return $this->belongsTo(SubjectTopic::class, 'topic_id', 'id');
    }
    public function subject()
    {
        return $this->hasOneThrough(Subject::class, SubjectTopic::class, 'id', 'id', 'topic_id', 'subject_id');
    }
    public function questions()
    {
        return $this->hasMany(Question::class, 'sub_topic_id');
    }
}

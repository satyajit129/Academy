<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $guarded = [];
    protected $table = 'questions';

    public function options()
    {
        return $this->hasMany(Option::class, 'question_id', 'id');
    }
    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id', 'id');
    }
    public function subjectLesson()
    {
        return $this->belongsTo(SubjectLesson::class, 'lesson_id', 'id');
    }
    public function subjectTopic()
    {
        return $this->belongsTo(SubjectTopic::class, 'topic_id', 'id');
    }
    public function subjectSubTopic()
    {
        return $this->belongsTo(SubjectSubTopic::class, 'sub_topic_id', 'id');
    }

    public static function filterQuestions($filters)
    {
        $query = self::query();

        if (!empty($filters['subject_id'])) {
            $query->where('subject_id', $filters['subject_id']);
        }
        if (!empty($filters['lesson_id'])) {
            $query->where('lesson_id', $filters['lesson_id']);
        }
        if (!empty($filters['topic_id'])) {
            $query->where('topic_id', $filters['topic_id']);
        }
        if (!empty($filters['sub_topic_id'])) {
            $query->where('sub_topic_id', $filters['sub_topic_id']);
        }

        return $query->get();
    }

}

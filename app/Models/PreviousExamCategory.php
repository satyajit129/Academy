<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PreviousExamCategory extends Model
{
    protected $table = 'previous_exam_categories';
    protected $guarded = [];

    public function previousExams()
    {
        return $this->hasMany(PreviousExam::class, 'category_id');
    }
}

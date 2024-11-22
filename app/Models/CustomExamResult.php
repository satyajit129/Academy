<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomExamResult extends Model
{
    protected $guarded = [];
    protected $table = 'custom_exam_results';

    public function userInfo()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function customExamTnfo(){
        return $this->belongsTo(CustomExam::class,'custom_exam_id');
    }

}

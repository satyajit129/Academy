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
}

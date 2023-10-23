<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionGroup extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
     
    public function questions()
    {
        return $this->belongsTo(Question::class,'question_group_id','id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
     
    public function options()
    {
        return $this->hasMany(Option::class,'question_id','id');
    }
    public function questionGroup()
    {
        return $this->hasMany(QuestionGroup::class,'question_id','id');
    }
    public function fillInBlank()
    {
        return $this->hasOne(FillInBlank::class,'question_id','id');
    }
    public function test()
    {
        return $this->belongsTo(Test::class,'test_id','id');
    }
}

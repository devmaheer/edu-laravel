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
    public function test()
    {
        return $this->belongsTo(Test::class,'id','test_id');
    }
}

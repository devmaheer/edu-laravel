<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinishedTest extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function tests()
    {
        return $this->belongsTo(Test::class, 'test_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
}

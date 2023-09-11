<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Investigation extends Model
{
    use HasFactory;

    /**
     * The attraibutes which are not mass assignable
     * 
     */
    protected $guarded = ['id'];
}

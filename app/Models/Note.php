<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    /**
     * The attributes that are not mass assignable
     * 
     */
    protected $guarded = ['id'];

    /**
     * Get the parent notes model.
     */
    public function notable(): MorphTo
    {
        return $this->morphTo();
    }
}

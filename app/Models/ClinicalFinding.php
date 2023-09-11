<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClinicalFinding extends Model
{
    use HasFactory;

    /**
     * The attraibutes which are not mass assignable
     * 
     */
    protected $guarded = ['id'];

    public function type()
    {
        return $this->belongsTo(ComplaintType::class, 'type_id', 'id');
    }

    public function tooth()
    {
        return $this->belongsTo(Tooth::class, 'tooth_id', 'id');
    }
}

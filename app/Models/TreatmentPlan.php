<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TreatmentPlan extends Model
{
    use HasFactory;

    /**
     * The attributes that are not mass assignable
     * 
     */
    protected $guarded = ['id'];

    public function category()
    {
        return $this->belongsTo(TreatmentCategory::class, 'treatmentcategory_id', 'id');
    }

    public function service()
    {
        return $this->belongsTo(TreatmentService::class, 'treatmentservice_id', 'id');
    }
}

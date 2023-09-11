<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Traits\HasUid;

class ClinicalSpecialization extends Model
{
    use HasUid, HasFactory;

    protected $guarded = ['id'];

    public function treatmentServices() {
        return $this->hasMany(TreatmentService::class, 'id', 'specialization_id');
    }
}

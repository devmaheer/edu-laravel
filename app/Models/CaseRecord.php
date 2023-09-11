<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use App\Traits\HasUid;

class CaseRecord extends Model
{
    use HasFactory, HasUid;

    /**
     * The attraibutes which are not mass assignable
     * 
     */
    protected $guarded = ['id'];

    /**
     * Get all of the case attachments.
     */
    public function attachments(): MorphMany
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }

    /**
     * Get all of the case notes.
     */
    public function notes(): MorphMany
    {
        return $this->morphMany(Note::class, 'notable');
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id', 'id');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'id');
    }

    public function dutyDoctor()
    {
        return $this->belongsTo(User::class, 'duty_doctor_id', 'id');
    }

    public function complaints()
    {
        return $this->hasMany(ChiefComplaint::class, 'case_id', 'id');
    }

    public function findings()
    {
        return $this->hasMany(ClinicalFinding::class, 'case_id', 'id');
    }

    public function investigation()
    {
        return $this->hasOne(Investigation::class, 'case_id', 'id');
    }

    public function treatmentPlans()
    {
        return $this->hasMany(TreatmentPlan::class, 'case_id', 'id');
    }
}

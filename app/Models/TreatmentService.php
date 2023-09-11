<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasUid;
use App\Models\TreatmentProcedure;

class TreatmentService extends Model
{
    use HasFactory, HasUid;

    /**
     * The attributes that are not mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = ['id'];

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'id');
    }

    /**
     * Relation to get category
     * 
     */
    public function category()
    {
        return $this->belongsTo(TreatmentCategory::class, 'category_id', 'id');
    }

    /**
     * Relation to get procedures
     * 
     */
    public function procedures()
    {
        return $this->belongsToMany(TreatmentProcedure::class, 'service_procedures', 'service_id', 'procedure_id');
    }
}

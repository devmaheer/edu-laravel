<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasUid;

class TreatmentCategory extends Model
{
    use HasFactory, HasUid;

    /**
     * The attributes which are not mass assignable
     * 
     */
    protected $guarded = ['id'];

    /**
     * Relation to get services
     * 
     */
    public function services()
    {
        return $this->hasMany(TreatmentService::class, 'category_id', 'id');
    }
}

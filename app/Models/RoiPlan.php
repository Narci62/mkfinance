<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class RoiPlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'expectROI',
        'paymentFrequency',
        'paymentSchedule',
        'totalDuration',
        'adjusteSchedule',
        'reference_project',
    ];

    public function project(): BelongsTo
    { 
        return $this->belongsTo(Project::class,'reference_project');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FundingPlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference_project',
        'fundUsage',
        'fundingSchedule',
    ];

    public function project(): BelongsTo
    { 
        return $this->belongsTo(Project::class,'reference_project');
    }
}

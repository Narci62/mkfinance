<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'titled',
        'description',
        'featured_image',
        'imat',
        'totalFundedNeeded',
        'InvestmentAmountfix',
        'amountToStart',
        'makeStudy',
        'project_of'
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'project_of');
    }

    public function investment(): HasMany
    {
        return $this->hasMany(Investment::class, 'reference_project');
    }

    public function roi_plan(): HasOne
    {
        return $this->hasOne(RoiPlan::class, 'reference_project');
    }

    public function fundingplan(): HasOne
    {
        return $this->hasOne(FundingPlan::class, 'reference_project');
    }

    public function risk(): HasMany
    {
        return $this->hasMany(Risk::class, 'reference_project');
    }
}

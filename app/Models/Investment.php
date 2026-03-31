<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Investment extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function project(): BelongsTo
    { 
        return $this->belongsTo(Project::class,'reference_project');
    }

    public function investors() : BelongsTo
    {
        return $this->belongsTo(User::class,'investor');
    }
}

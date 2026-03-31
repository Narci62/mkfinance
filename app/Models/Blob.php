<?php

namespace App\Models;

use App\Models\Company;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Blob extends Model
{
    use HasFactory;

    protected $fillable = [
        'file',
        'reference_company'
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class,'reference_company');
    }
}

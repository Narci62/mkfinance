<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Company extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'sector_id',
        'other_sector',
        'staff_number',
        'main_logo',
        'main_gallery',
        'yearly_income',
        'website',
        'socials_links',
        'overview_description',
        'created_by',
        'status',
        'project_step',
    ];

    /**
     * Company belong to user
     */
    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function Sector() : BelongsTo
    {
        return $this->belongsTo(Sector::class, 'sector');
    }

    public function project(): HasOne
    {
        return $this->hasOne(Project::class,'project_of');
    }

    public function blobs():HasMany
    {
        return $this->hasMany(Blob::class);
    }

    public function avis():HasMany
    {
        return $this->hasMany(Avis::class,'companie_id');
    }

    public function post(): HasMany
    {
        return $this->hasMany(Post::class);
    }
}

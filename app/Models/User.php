<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'phone_number',
        'password',
        'id_type',
        'id_document',
        'id_document_exp',
        'account_type',
        'account_status',
        'wizard_step',
        'avatar',
        'language',
        'account_del',
        'matricule'
    ];

    /**
     * Has company
     */
    public function company(): HasOne
    {
        return $this->hasOne(Company::class, 'created_by');
    }

    public function investment(): HasMany
    {
        return $this->hasMany(Investment::class);
    }

    public function wallet():  HasOne
    {
        return $this->hasOne(Wallet::class,'holder');
    }

    public function operations(): HasMany
    {
        return $this->hasMany(Operation::class);
    }

    public function avis():HasMany
    {
        return $this->hasMany(Avis::class);
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}

<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function TrainingReport(): hasMany
    {
        return $this->hasMany(TrainingReport::class);
    }

    public function PhoneOwner(): hasMany
    {
        return $this->hasMany(PhoneOwner::class);
    }

    public function LaptopOwner(): hasMany
    {
        return $this->hasMany(LaptopOwner::class);
    }

    public function DesktopOwner(): hasMany
    {
        return $this->hasMany(DesktopOwner::class);
    }

    public function DailyWorkingReportSale(): hasMany
    {
        return $this->hasMany(DailyWorkingReportSale::class);
    }

}

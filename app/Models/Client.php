<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'company',
        'designation',
        'name_card',
        'address',
        'city',
        'state',
        'postcode',
        'country',
        'note',
    ];

    public function adsProject(): HasMany
    {
        return $this->hasMany(AdsProject::class);
    }

    public function Domain(): HasMany
    {
        return $this->hasMany(Domain::class);
    }
}

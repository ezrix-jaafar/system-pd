<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PhoneOwner extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'received_date',
        'return_date',
        'acceptance_letter',
        'availability',
        'note',
    ];

    public function Phone(): HasMany
    {
        return $this->hasMany(Phone::class);
    }

    public function User(): HasMany
    {
        return $this->hasMany(User::class);
    }
}

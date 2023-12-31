<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Phone extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand',
        'model',
        'ram',
        'storage',
        'serial_number',
        'purchase_date',
        'purchase_receipt',
        'warranty_expired',
        'condition',
        'notes',
    ];

    public function PhoneOwner(): BelongsToMany
    {
        return $this->belongsToMany(PhoneOwner::class);
    }

    public function PhoneRepair(): BelongsToMany
    {
        return $this->belongsToMany(PhoneRepair::class);
    }

}



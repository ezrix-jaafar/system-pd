<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Asset extends Model
{
    use HasFactory;

    protected $fillable = [
        'asset_type',
        'brand',
        'model',
        'ram',
        'storage',
        'serial_number',
        'purchase_date',
        'purchase_receipt',
        'warranty_expired',
        'availability',
        'condition',
        'notes',
    ];

    protected $casts = [
        'is_available' => 'boolean',
        'is_working' => 'boolean',
    ];

    public function owner(): BelongsToMany
    {
        return $this->belongsToMany(Owner::class);
    }
    public function repair(): BelongsToMany
    {
        return $this->belongsToMany(Repair::class);
    }

}

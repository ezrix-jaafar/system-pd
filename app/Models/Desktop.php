<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Desktop extends Model
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

    public function DesktopOwner(): BelongsToMany
    {
        return $this->belongsToMany(DesktopOwner::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Laptop extends Model
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

    public function LaptopOwner(): BelongsToMany
    {
        return $this->belongsToMany(LaptopOwner::class);
    }

    public function LaptopRepair(): BelongsToMany
    {
        return $this->belongsToMany(LaptopRepair::class);
    }


}

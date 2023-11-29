<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class LaptopOwner extends Model
{
    use HasFactory;

    protected $fillable = [
        'record_type',
        'user_id',
        'record_date',
        'record_letter',
        'note',
    ];

    public function Laptop(): BelongsToMany
    {
        return $this->belongsToMany(Laptop::class);
    }

    public function User(): belongsTo
    {
        return $this->belongsTo(User::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Owner extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'received_date',
        'return_date',
        'acceptance_letter',
        'note',
    ];

    public function asset(): BelongsToMany
    {
        return $this->belongsToMany(Asset::class);
    }

}

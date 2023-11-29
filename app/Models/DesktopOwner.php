<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class DesktopOwner extends Model
{
    use HasFactory;

    protected $fillable = [
        'record_type',
        'user_id',
        'record_date',
        'record_letter',
        'note',
    ];

    Public function Desktop(): BelongsToMany
    {
        return $this->belongsToMany(Desktop::class);
    }

    Public function User(): belongsTo
    {
        return $this->belongsTo(User::class);
    }
}

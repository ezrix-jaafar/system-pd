<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PhoneOwner extends Model
{
    use HasFactory;

    protected $fillable = [
        'record_type',
        'user_id',
        'record_date',
        'record_letter',
        'recorder_id',
        'note',
    ];

    public function Phone(): BelongsToMany
    {
        return $this->belongsToMany(Phone::class);
    }

    public function User(): belongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function Recorder(): BelongsTo
    {
        return $this->belongsTo(User::class, 'recorder_id');
    }

}

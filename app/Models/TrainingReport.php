<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TrainingReport extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'training_report',
        'training_attachment',
    ];

    protected $casts = [
        'training_attachment' => 'json',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function training(): BelongsTo
    {
        return $this->belongsTo(Training::class);
    }

}

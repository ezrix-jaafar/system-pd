<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TrainingReport extends Model
{
    use HasFactory;
    protected $fillable = [
        'staff_id',
        'training_report',
        'training_attachment',
    ];

    public function staff(): BelongsTo
    {
        return $this->belongsTo(Staff::class);
    }

}

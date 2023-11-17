<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    use HasFactory;
    protected $fillable = [
        'training_name',
        'training_type',
        'training_provider',
        'training_location',
        'training_start_date',
        'training_end_date',
        'training_fees',
        'training_remarks',
        'training_attendees',
    ];

    protected $casts = [
        'training_attendees' => 'json',
    ];
}

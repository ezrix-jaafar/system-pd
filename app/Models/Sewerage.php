<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sewerage extends Model
{
    use HasFactory;

    protected $fillable = [
        'month',
        'year',
        'amount',
        'bill_image',
        'payment_status',
        'payment_date',
        'paid_amount',
        'payment_slip',
        'note',
    ];
}

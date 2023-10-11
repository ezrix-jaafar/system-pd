<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\MonthEnum; // Import MonthEnum

class OtherBills extends Model
{
    use HasFactory;

    protected $fillable = [
        'month',
        'amount',
        'bill_image',
        'payment_status',
        'payment_date',
        'paid_amount',
        'payment_slip',
        'note',
    ];

}

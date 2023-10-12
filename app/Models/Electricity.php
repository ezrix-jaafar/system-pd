<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\MonthEnum; // Import MonthEnum
use App\Enums\PaymentStatusEnum; // Import MonthEnum
use App\Enums\YearEnum; //Import YearEnum


class Electricity extends Model
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

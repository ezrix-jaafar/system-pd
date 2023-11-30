<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyWorkingReportSale extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'report_date',
        'report_details',
        'note',
    ];

    protected $casts = [
        'report_details' => 'array',
    ];
}


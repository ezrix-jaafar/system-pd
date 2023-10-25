<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdsProject extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_name',
        'project_type',
        'project_status',
        'project_link',
        'daily_budget',
        'total_spend',
        'start_date',
        'end_date',
        'total_days',
        'project_description',
        'report_image',
    ];
}


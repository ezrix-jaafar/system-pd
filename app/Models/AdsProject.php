<?php

namespace App\Models;

use Chiiya\FilamentAccessControl\Models\FilamentUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        'client_id',
        'person_in_charge_id',
        'sales_person_id',
    ];

    protected $casts = [
        'report_image' => 'array',
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function staff(): BelongsTo
    {
        return $this->belongsTo(Staff::class);
    }

}


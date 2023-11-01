<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AdsCampaign extends Model
{
    use HasFactory;
    protected $fillable = [
        'campaign_name',
        'campaign_platform',
        'campaign_status',
        'campaign_link',
        'daily_budget',
        'total_spend',
        'start_date',
        'end_date',
        'total_days',
        'campaign_description',
        'report_image',
        'staff_id',
        ];

    protected $casts = [
        'report_image' => 'array',
    ];

    public function staff(): BelongsTo
    {
        return $this->belongsTo(Staff::class);
    }
}

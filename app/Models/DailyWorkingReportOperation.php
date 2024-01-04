<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DailyWorkingReportOperation extends Model
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

    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getReportDetailsCountAttribute()
    {
        return count($this->report_details);
    }

}

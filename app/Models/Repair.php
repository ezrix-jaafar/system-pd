<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Repair extends Model
{
    use HasFactory;

    protected $fillable = [
        'company',
        'send_date',
        'pickup_date',
        'repair_cost',
        'send_by',
        'payment_receipt',
        'note',
    ];

    public function asset(): belongsTo
    {
        return $this->belongsTo(Asset::class);
    }
}



<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AssetHolder extends Model
{
    use HasFactory;

    protected $fillable = [
        'staff_id',
        'received_date',
        'return_date',
        'acceptance_letter',
        'note',
    ];

    public function SocialMediaAsset(): belongsTo
    {
        return $this->belongsTo(SocialMediaAsset::class);
    }

    public function staff(): belongsTo
    {
        return $this->belongsTo(Staff::class);
    }

}

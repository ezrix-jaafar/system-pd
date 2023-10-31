<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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

    public function socialMediaAssets(): belongsToMany
    {
        return $this->belongsToMany(SocialMediaAsset::class);
    }


}

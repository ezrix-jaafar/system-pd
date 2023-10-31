<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialMediaAsset extends Model
{
    use HasFactory;

    protected $fillable = [
        'account_name',
        'platform',
        'account_type',
        'account_url',
        'account_username',
        'account_password',
        'account_email',
        'account_phone',
        'account_niche',
        'account_note',
        'secret_question',
    ];

    protected $casts = [
        'secret_question' => 'json'
    ];
}

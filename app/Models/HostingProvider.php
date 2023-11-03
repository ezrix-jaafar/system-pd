<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class HostingProvider extends Model
{
    use HasFactory;
    protected $fillable = [
        'hosting_company',
        'website',
    ];

    public function Hosting(): hasMany
    {
        return $this->hasMany(Hosting::class);
    }
}

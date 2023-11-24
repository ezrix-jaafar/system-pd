<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Staff extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'position',
        'team',
    ];

    public function personInChargeProjects(): HasMany
    {
        return $this->hasMany(AdsProject::class, 'person_in_charge_id');

    }

    public function salespersonProjects(): HasMany
    {
        return $this->hasMany(AdsProject::class, 'salesperson_id');
    }

    public function personInChargeWebProjects(): HasMany
    {
        return $this->hasMany(WebsiteProject::class, 'person_in_charge_id');

    }

    public function salespersonWebProjects(): HasMany
    {
        return $this->hasMany(WebsiteProject::class, 'salesperson_id');
    }

    public function coordinatorWebProjects(): HasMany
    {
        return $this->hasMany(WebsiteProject::class, 'coordinator_id');
    }

    public function AssetHolder(): belongsTo
    {
        return $this->belongsTo(AssetHolder::class);
    }

    public function AdsCampaign(): HasMany
    {
        return $this->hasMany(AdsCampaign::class);
    }

    public function Domain(): HasMany
    {
        return $this->hasMany(Domain::class);
    }

    public function TrainingReport(): HasMany
    {
        return $this->hasMany(TrainingReport::class);
    }

}

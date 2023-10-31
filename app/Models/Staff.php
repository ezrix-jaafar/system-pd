<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Staff extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'position',
        'team',
    ];

    // Define the AdsProjects where the staff member is the person in charge
    public function personInChargeProjects(): HasMany
    {
        return $this->hasMany(AdsProject::class, 'person_in_charge_id');
    }

    // Define the AdsProjects where the staff member is the salesperson
    public function salespersonProjects(): HasMany
    {
        return $this->hasMany(AdsProject::class, 'salesperson_id');
    }

}

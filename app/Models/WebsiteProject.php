<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WebsiteProject extends Model
{
    use HasFactory;

    protected $fillable = [
        'domain_name_id',
        'project_status',
        'client_id',
        'salesperson_id',
        'person_in_charge_id',
        'coordinator_id',
        'date',
        'project_description',
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function personInCharge(): BelongsTo
    {
        return $this->belongsTo(Staff::class, 'person_in_charge_id');
    }

    public function salesperson(): BelongsTo
    {
        return $this->belongsTo(Staff::class, 'salesperson_id');
    }

    public function coordinator(): BelongsTo
    {
        return $this->belongsTo(Staff::class, 'coordinator_id');
    }

    public function domain(): BelongsTo
    {
        return $this->belongsTo(domain::class, 'domain_name_id');
    }
}

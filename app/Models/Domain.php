<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Domain extends Model
{
    use HasFactory;

    protected $fillable = [
        'domain_name',
        'purchase_date',
        'expiry_date',
        'is_active',
        'hosting_id',
        'domain_registrar_id',
        'domain_provider_url',
        'domain_provider_username',
        'domain_provider_password',
        'client_id',
        'staff_id',
    ];

    public function Hosting(): belongsTo
    {
        return $this->belongsTo(Hosting::class);
    }

    public function Client(): belongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function Staff(): belongsTo
    {
        return $this->belongsTo(Staff::class);
    }

    public function DomainRegistrar(): belongsTo
    {
        return $this->belongsTo(DomainRegistrar::class);
    }

}

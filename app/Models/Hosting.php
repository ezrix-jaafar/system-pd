<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Hosting extends Model
{
    use HasFactory;
    protected $fillable = [
        'server_name',
        'domain_name',
        'package_name',
        'server_cost',
        'purchase_date',
        'expiry_date',
        'hosting_provider_id',
        'client_dashboard_url',
        'dashboard_username',
        'dashboard_password',
        'cpanel_url',
        'cpanel_username',
        'cpanel_password',
        'nameserver_1',
        'nameserver_2',
        'ip_address',
    ];

    public function HostingProvider(): belongsTo
    {
        return $this->belongsTo(HostingProvider::class , 'hosting_provider_id');
    }

}


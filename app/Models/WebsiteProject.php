<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebsiteProject extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_name',
        'project_status',
        'client_id',
        'salesperson_id',
        'person_in_charge_id',
        'coordinator_id',
        'date',
        'project_description',
    ];
}

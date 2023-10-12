<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DigitalProducts extends Model
{
    use HasFactory;

    protected $fillable = [

        'product_name',
        'product_description',
        'file_location',
        'sales_page',
        'variations',

    ];

    protected $casts = [
        'variations' => 'json'
    ];
}

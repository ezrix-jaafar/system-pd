<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Merchandise extends Model
{
    use HasFactory;

    protected $fillable = [

        'product_name',
        'product_description',
        'sales_page',
        'product_image',
        'variations',

    ];

    protected $casts = [
        'variations' => 'json'
    ];

}

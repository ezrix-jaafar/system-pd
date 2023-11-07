<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DomainRegistrar extends Model
{
    use HasFactory;
        protected $fillable = [
        'registrar_name',
        'website',
        ];

        public function Domain(): hasMany
        {
            return $this->hasMany(Domain::class);
        }
}

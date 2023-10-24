<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Owner extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'received_date',
        'return_date',
        'acceptance_letter',
        'availability',
        'note',
    ];

    public function asset(): BelongsToMany
    {
        return $this->hasMany(Asset::class);
    }

    public function setReturnDateAttribute($value)
    {
        $this->attributes['return_date'] = $value;

        // Update the availability field based on the return_date value
        if (!empty($value)) {
            $this->attributes['availability'] = 'Available';
        } else {
            $this->attributes['availability'] = 'Not Available';
        }
    }

    public function create(array $attributes = [])
    {
        $latestOwner = $this->latest('created_at')->first();

        if ($latestOwner) {
            // Check the latest owner's "return_date" and set "availability" accordingly
            $attributes['availability'] = empty($latestOwner->return_date) ? 'Not Available' : 'Available';
        }

        return parent::create($attributes);
    }

    public function update(array $attributes = [], array $options = [])
    {
        if (isset($attributes['return_date'])) {
            $latestOwner = $this->latest('created_at')->first();

            if ($latestOwner) {
                // Check the latest owner's "return_date" and set "availability" accordingly
                $attributes['availability'] = empty($latestOwner->return_date) ? 'Not Available' : 'Available';
            }
        }

        return parent::update($attributes, $options);
    }
}

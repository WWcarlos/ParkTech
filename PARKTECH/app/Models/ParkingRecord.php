<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ParkingRecord extends Model
{
    public function spaces(): HasMany
    {
        return $this->hasMany(Space::class);
    }

    public function vehicles(): HasMany
    {
        return $this->hasMany(Vehicle::class);
    }
}

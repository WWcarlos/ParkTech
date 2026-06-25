<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Space extends Model
{
    public function parkingRegisters(): HasMany
    {
        return $this->hasMany(ParkingRegister::class);
    }
}

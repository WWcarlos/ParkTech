<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tariff extends Model
{
    public function parkingRegisters(): HasMany
    {
        return $this->hasMany(ParkingRegister::class, 'id_tarifa', 'id_tarifa');
    }
}

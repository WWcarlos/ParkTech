<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ParkingRegister extends Model
{

    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class, 'id_vehiculo', 'id_vehiculo');
    }

    public function space(): BelongsTo
    {
        return $this->belongsTo(Space::class, 'id_space', 'id_space');
    }

    public function tariff(): BelongsTo
    {
        return $this->belongsTo(Tariff::class, 'id_tarifa', 'id_tarifa');
    }
}

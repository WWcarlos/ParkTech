<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vehicle extends Model
{
    use HasFactory;
    /**
     * Campos que se pueden asignar de forma masiva.
     */
    protected $fillable = [
        'plate',
        'vehicle_type_id',
    ];

    /**
     * Un vehículo pertenece a un tipo de vehículo.
     */
    public function vehicleType(): BelongsTo
    {
        return $this->belongsTo(VehicleType::class);
    }

    /**
     * Un vehículo puede tener muchos registros de parqueo.
     */
    public function parkingRecords(): HasMany
    {
        return $this->hasMany(ParkingRecord::class);
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ParkingRecord extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'vehicle_id',
        'user_id',
        'space_id',
        'entry_time',
        'exit_time',
        'total_amount',
        'status',
    ];

    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function space(): BelongsTo
    {
        return $this->belongsTo(Space::class);
    }
}
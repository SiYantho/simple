<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'plate_number',
        'km_awal',
        'km_akhir',
        'vehicle_types_id',
    ];

    // Define any relationships here
    // For example:
    // public function vehicleType()
    // {
    //     return $this->belongsTo(VehicleType::class);
    // }
}

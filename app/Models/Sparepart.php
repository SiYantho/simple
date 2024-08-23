<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sparepart extends Model
{
    use HasFactory;

    // protected $fillable = ['vehicle_id', 'tanggal_ganti', 'url_gambar_nota'];

    protected $table = 'spareparts';

    protected $fillable = [
        'vehicle_id',
        'tanggal_ganti',
        'url_gambar_nota',
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function details()
    {
        return $this->hasMany(SparepartDetail::class);
    }
}

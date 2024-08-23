<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SparepartDetail extends Model
{
    use HasFactory;

    protected $table = "spareparts_detail";

    protected $fillable = [
        'sparepart_id',
        'nama_barang',
        'harga',
        'jumlah',
    ];

    public function transaksiSparepart()
    {
        return $this->belongsTo(Sparepart::class);
    }
}

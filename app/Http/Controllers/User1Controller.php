<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SparepartDetail;
use App\Models\Sparepart;

class User1Controller extends Controller
{
    public function index(Request $request)
    {
        // Ambil ID mobil dari request
        $vehicleId = $request->input('vehicle_id');

        // Query untuk mendapatkan top 3 nama barang berdasarkan total kuantitas
        $query = SparepartDetail::select('nama_barang')
            ->selectRaw('SUM(jumlah) as total_quantity')
            ->join('spareparts', 'spareparts.id', '=', 'spareparts_detail.sparepart_id')
            ->when($vehicleId, function ($query, $vehicleId) {
                return $query->where('spareparts.vehicle_id', $vehicleId);
            })
            ->groupBy('nama_barang')
            ->orderBy('total_quantity', 'desc')
            ->limit(3)
            ->get();

        // Ambil data mobil untuk dropdown
        $vehicles = Sparepart::select('vehicle_id')
            ->distinct()
            ->get()
            ->map(function ($sparepart) {
                return $sparepart->vehicle; // Assuming `vehicle` relationship is defined
            });

        return view('user1.home', compact('query', 'vehicles', 'vehicleId'));
    }
}

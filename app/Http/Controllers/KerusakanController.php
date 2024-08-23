<?php

namespace App\Http\Controllers;

use App\Models\Sparepart;
use App\Models\SparepartDetail;
use Illuminate\Http\Request;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Storage;

class KerusakanController extends Controller
{
    public function create()
    {
        $vehicles = Vehicle::all();
        return view('user1.kerusakan.create', compact('vehicles'));
    }

    public function topItems(Request $request)
    {
        // Ambil ID mobil dari request
        $vehicleId = $request->input('vehicle_id');

        // Query untuk mendapatkan top 3 nama barang berdasarkan jumlah transaksi, difilter dengan vehicle_id jika ada
        $query = SparepartDetail::select('nama_barang')
            ->selectRaw('COUNT(*) as item_count')
            ->join('spareparts', 'spareparts.id', '=', 'sparepart_details.sparepart_id')
            ->when($vehicleId, function ($query, $vehicleId) {
                return $query->where('spareparts.vehicle_id', $vehicleId);
            })
            ->groupBy('nama_barang')
            ->orderBy('item_count', 'desc')
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

    public function store(Request $request)
    {

        //Validasi input
        $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'tanggal_ganti' => 'required|date',
            'nota_bukti' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'details.*.nama_barang' => 'required|string',
            'details.*.harga' => 'required|numeric',
            'details.*.kuantitas' => 'required|integer',
        ]);

        // Simpan data sparepart
        $sparepart = Sparepart::create([
            'vehicle_id' => $request->vehicle_id,
            'tanggal_ganti' => $request->tanggal_ganti,
        ]);

        // Simpan file gambar bukti transaksi jika ada
        if ($request->hasFile('nota_bukti')) {
            $file = $request->file('nota_bukti');
            $path = $file->store('public/nota_bukti');
            $sparepart->update(['url_gambar_nota' => $path]);
        }

        // Simpan detail sparepart
        foreach ($request->input('details', []) as $detail) {
            SparepartDetail::create([
                'sparepart_id' => $sparepart->id,
                'nama_barang' => $detail['nama_barang'],
                'harga' => $detail['harga'],
                'jumlah' => $detail['kuantitas'],
            ]);
        }

        return redirect()->route('kerusakan.index')->with('success', 'Transaksi sparepart berhasil disimpan.');
    }

    public function index()
    {
        $spareparts = Sparepart::with('details')->get();
        return view('user1.kerusakan.index', compact('spareparts'));
    }

    public function edit($id)
    {
        $sparepart = Sparepart::findOrFail($id);
        $vehicles = Vehicle::all();
        return view('user1.kerusakan.edit', compact('sparepart', 'vehicles'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'tanggal_ganti' => 'required|date',
            'nota_bukti' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'details.*.nama_barang' => 'required|string',
            'details.*.harga' => 'required|numeric',
            'details.*.kuantitas' => 'required|integer',
        ]);

        $sparepart = Sparepart::findOrFail($id);
        $sparepart->update([
            'vehicle_id' => $request->vehicle_id,
            'tanggal_ganti' => $request->tanggal_ganti,
        ]);

        if ($request->hasFile('nota_bukti')) {
            // Delete old file if exists
            if ($sparepart->url_gambar_nota) {
                Storage::delete($sparepart->url_gambar_nota);
            }

            $file = $request->file('nota_bukti');
            $path = $file->store('public/nota_bukti');
            $sparepart->update(['url_gambar_nota' => $path]);
        }

        // Update details
        $sparepart->details()->delete();
        foreach ($request->input('details', []) as $detail) {
            SparepartDetail::create([
                'sparepart_id' => $sparepart->id,
                'nama_barang' => $detail['nama_barang'],
                'harga' => $detail['harga'],
                'jumlah' => $detail['kuantitas'],
            ]);
        }

        return redirect()->route('kerusakan.index')->with('success', 'Transaksi sparepart berhasil diperbarui.');
    }

    // Method untuk menghapus transaksi
    public function destroy($id)
    {
        $sparepart = Sparepart::findOrFail($id);

        // Hapus gambar nota jika ada
        if ($sparepart->url_gambar_nota) {
            Storage::delete($sparepart->url_gambar_nota);
        }

        // Hapus detail terkait
        $sparepart->details()->delete();

        // Hapus transaksi
        $sparepart->delete();

        return redirect()->route('kerusakan.index')->with('success', 'Transaksi sparepart berhasil dihapus.');
    }
}

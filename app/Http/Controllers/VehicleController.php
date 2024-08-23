<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use App\Models\VehicleType;

class VehicleController extends Controller
{
    public function index()
    {
        $vehicles = Vehicle::all();
        return view('admin.vehicle.index', compact('vehicles'));
    }

    public function create()
    {
        $vehicletypes = VehicleType::all();
        return view('admin.vehicle.create', compact('vehicletypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nopol' => 'required|string|max:255',
            'vehicle_types_id' => 'required|exists:vehicle_types,id',
        ]);

        //dd($request->vehicle_types_id);

        Vehicle::create([
            'name' => $request->nama,
            'plate_number' => $request->nopol,
            'km_awal' => 0,
            'km_akhir' => 0,
            'vehicle_types_id' => $request->vehicle_types_id,
        ]);

        return redirect()->route('vehicles.index')->with('success', 'Vehicle created successfully.');
    }

    public function edit(Vehicle $vehicle)
    {
        $vehicletypes = VehicleType::all();
        return view('admin.vehicle.edit', compact('vehicle', 'vehicletypes'));
    }

    public function update(Request $request, Vehicle $vehicle)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'plate_number' => 'required|string|max:255|unique:vehicles,plate_number,' . $vehicle->id,
            'km_awal' => 'required|integer',
            'km_akhir' => 'required|integer',
            'vehicle_types_id' => 'required|exists:vehicle_types,id',
        ]);

        $vehicle->update($request->all());

        return redirect()->route('vehicles.index')->with('success', 'Vehicle updated successfully.');
    }

    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();

        return redirect()->route('vehicles.index')->with('success', 'Vehicle deleted successfully.');
    }
}

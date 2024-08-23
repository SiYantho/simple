@extends('layouts.app')

@section('content')
    <div class="container-fluid mt-xl-15 mt-sm-10 mt-5">
        <!-- Row -->
        <div class="row">
            <div class="col-xl-12">
                <div class="hk-row">
                    <div class="col-lg-122">
                        <div class="card card-refresh">
                            <div class="card-body">
                                <h3>Top 3 Nama Barang Berdasarkan Total Kuantitas</h3>

                                <!-- Form untuk filter mobil -->
                                <form method="GET" action="{{ route('user1.home') }}">
                                    <div class="form-group">
                                        <label for="vehicle_id">Mobil:</label>
                                        <select id="vehicle_id" name="vehicle_id" class="form-control">
                                            <option value="">-- Semua Mobil --</option>
                                            @foreach ($vehicles as $vehicle)
                                                <option value="{{ $vehicle->id }}"
                                                    {{ $vehicleId == $vehicle->id ? 'selected' : '' }}>
                                                    {{ $vehicle->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary"><i class="ion ion-ios-funnel"></i>
                                    </button>
                                </form>

                                <!-- Tabel hasil top 3 nama barang -->
                                <table class="table table-striped mt-3">
                                    <thead>
                                        <tr>
                                            <th>Nama Barang</th>
                                            <th>Total Kuantitas</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($query as $item)
                                            <tr>
                                                <td>{{ $item->nama_barang }}</td>
                                                <td>{{ $item->total_quantity }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Row -->
    </div>
@endsection

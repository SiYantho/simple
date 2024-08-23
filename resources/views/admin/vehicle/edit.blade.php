@extends('layouts.app')

@section('content')
<!-- Breadcrumb -->
<nav class="hk-breadcrumb" aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-light bg-transparent">
        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Unit Kendaraan</li>
    </ol>
</nav>
<!-- /Breadcrumb -->

<!-- Container -->
<div class="container">

    <!-- Title -->
    <div class="hk-pg-header">
        <h4 class="hk-pg-title">Input Kendaraan</h4>
    </div>
    <!-- /Title -->

    <!-- Row -->
    <div class="row">
        <div class="col-xl-12">
            <section class="hk-sec-wrapper">
                <div class="row">
                    <div class="col-sm">
                        <form action="{{ route('vehicles.update', $vehicle->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="nama">Nama Mobil</label>
                                <input class="form-control" id="nama" name="name" placeholder="Nama Mobil" value="{{ $vehicle->name }}" type="text">
                            </div>

                            <div class="form-group">
                                <label for="nama">Nomor Polisi</label>
                                <input class="form-control" id="nama" name="plate_number" value="{{ $vehicle->plate_number }}" placeholder="Nomor Polisi" type="text">
                            </div>

                            <input id="km_awal" name="km_awal" type="hidden" value="{{ $vehicle->km_awal }}">
                            <input id="km_akhir" name="km_akhir" type="hidden" value="{{ $vehicle->km_akhir }}" >

                            <div class="form-group">
                                <label for="nama">Jenis Kendaraan</label>
                                <select id="type" class="form-control" name="vehicle_types_id">
                                    @foreach ( $vehicletypes as $vehicletype )
                                        <option value="{{ $vehicletype->id }}">
                                            {{ $vehicletype->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <button class="btn btn-primary" type="submit">Update</button>
                        </form>
                    </div>
                </div>
            </section>
            </section>
        </div>
    </div>
    <!-- /Row -->

</div>
@endsection

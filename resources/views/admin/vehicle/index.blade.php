@extends('layouts.app')

@section('content')
<!-- Breadcrumb -->
<nav class="hk-breadcrumb" aria-label="breadcrumb">
    <ol class="breadcrumb breadcrumb-light bg-transparent">
        {{-- <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Unit Kendaraan</li> --}}
    </ol>
</nav>
<!-- /Breadcrumb -->

<!-- Container -->
<div class="container">

    <!-- Title -->
    <div class="hk-pg-header">
        <h4 class="hk-pg-title">Unit Kendaraan</h4>
    </div>
    <!-- /Title -->

    <!-- Row -->
    <div class="row">
        <div class="col-xl-12">
            <section class="hk-sec-wrapper">
                @if(Auth::user()->role->name == 'admin')
                    <a href="{{ route('vehicles.create') }}" class="btn btn-primary">Tambah <i class="ion ion-ios-add-circle-outline"></i></a>
                @endif

                <div class="row">
                    <div class="col-sm">
                        <div class="table-wrap">
                            <table id="datable_1" class="table table-hover w-100 display pb-30">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Nomor Polisi</th>
                                        @if(Auth::user()->role->name == 'admin')
                                            <th>Actions</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($vehicles as $vehicle)
                                        <tr>
                                            <td>{{ $vehicle->name }}</td>
                                            <td>{{ $vehicle->plate_number }}</td>
                                            @if(Auth::user()->role->name == 'admin')
                                            <td>
                                                <a href="{{ route('vehicles.edit', $vehicle) }}"
                                                    class="btn btn-primary btn-sm">Edit
                                                    <i class="ion ion-ios-color-wand"></i></a>

                                                <form action="{{ route('vehicles.destroy', $vehicle) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Yakin ingin menghapus Data ini?')">Hapus
                                                    <i class="ion ion-ios-close-circle-outline"></i></button></button>
                                                </form>
                                            </td>
                                            @endif

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <!-- /Row -->

</div>
@endsection

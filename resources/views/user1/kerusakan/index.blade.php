@extends('layouts.app')

@section('content')
    <div class="container-fluid mt-xl-20 mt-sm-30 mt-15">
        <h4>Daftar Transaksi Sparepart</h4>
        <div class="row">
            <div class="col-lg-12">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="card card-refresh">
                    <div class="card-body">
                        <a href="{{ route('kerusakan.create') }}" class="btn btn-primary mb-3">Tambah Data
                            <i class="ion ion-ios-add-circle-outline"></i></button>
                            <ion-icon name="add-circle-outline"></ion-icon></a>
                        <table class="table table-striped border">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Mobil</th>
                                    <th>Tanggal Ganti</th>
                                    <th>Nota</th>
                                    <th>Detail</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($spareparts as $sparepart)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $sparepart->vehicle->name }}</td>
                                        <td>{{ $sparepart->tanggal_ganti }}</td>
                                        <td>
                                            @if ($sparepart->url_gambar_nota)
                                                <a href="{{ Storage::url($sparepart->url_gambar_nota) }}" target="_blank">
                                                    Lihat Nota
                                                </a>
                                            @else
                                                Tidak Ada Nota
                                            @endif
                                        </td>
                                        <td>
                                            <ul>
                                                @foreach ($sparepart->details as $detail)
                                                    <li>{{ $detail->nama_barang }} - {{ $detail->harga }} -
                                                        {{ $detail->jumlah }}</li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td>
                                            <a href="{{ route('kerusakan.edit', $sparepart->id) }}"
                                                class="btn btn-primary btn-sm">Edit
                                                <i class="ion ion-ios-color-wand"></i></a>
                                            <form action="{{ route('kerusakan.destroy', $sparepart->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Yakin ingin menghapus transaksi ini?')">Hapus
                                                    <i class="ion ion-ios-close-circle-outline"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

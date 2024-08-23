@extends('layouts.app')

@section('content')
    <div class="container-fluid mt-xl-50 mt-sm-30 mt-15">
        <!-- Row -->
        <div class="row">
            <div class="col-xl-12">
                <div class="hk-row">
                    <div class="col-lg-12">
                        <div class="card card-refresh">
                            <div class="card-body">
                                <form action="{{ route('kerusakan.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf

                                    <div class="form-group">
                                        <label for="car_id">Mobil:</label>
                                        <select id="vehicle_id" name="vehicle_id" class="form-control" required>
                                            @foreach ($vehicles as $vehicle)
                                                <option value="{{ $vehicle->id }}">{{ $vehicle->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="tanggal">Tanggal:</label>
                                        <input type="date" id="tanggal" name="tanggal_ganti" class="form-control"
                                            value="{{ now()->format('Y-m-d') }}" readonly>
                                    </div>

                                    <h3>Detail Sparepart</h3>
                                    <div id="details">
                                        <!-- Initial detail input -->
                                        <div class="detail">
                                            <div class="form-group">
                                                <label>Nama Barang:</label>
                                                <input type="text" class="form-control" name="details[0][nama_barang]"
                                                    required>
                                            </div>
                                            <div class="form-group">
                                                <label>Harga:</label>
                                                <input type="number" class="form-control" name="details[0][harga]"
                                                    step="0.01" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Kuantitas:</label>
                                                <input type="number" class="form-control" name="details[0][kuantitas]"
                                                    required>
                                            </div>
                                            <hr>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-primary" onclick="addDetail()">Tambah
                                        Detail <i class="ion ion-ios-add"></i></button>

                                    <div class="form-group mt-3">
                                        <label for="bukti_transaksi">Bukti Transaksi:</label>
                                        <input type="file" id="bukti_transaksi" name="nota_bukti"
                                            class="form-control-file" accept=".jpg,.jpeg,.png,.pdf">
                                    </div>

                                    <button type="submit" class="btn btn-success">Simpan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Row -->
    </div>
@endsection

@section('script')
    <script>
        let detailCount = 1;

        function addDetail() {
            detailCount++;
            const detailsDiv = document.getElementById('details');
            const newDetailDiv = document.createElement('div');
            newDetailDiv.classList.add('detail');
            newDetailDiv.innerHTML = `
        <div class="form-group">
            <label>Nama Barang:</label>
            <input type="text" class="form-control" name="details[${detailCount}][nama_barang]" required>
        </div>
        <div class="form-group">
            <label>Harga:</label>
            <input type="number" class="form-control" name="details[${detailCount}][harga]" step="0.01" required>
        </div>
        <div class="form-group">
            <label>Kuantitas:</label>
            <input type="number" class="form-control" name="details[${detailCount}][kuantitas]" required>
        </div>
        <button type="button" class="btn btn-danger" onclick="removeDetail(this)">Hapus</button>
        <hr>
    `;
            detailsDiv.appendChild(newDetailDiv);
        }

        function removeDetail(button) {
            const detailsDiv = document.getElementById('details');
            detailsDiv.removeChild(button.parentElement);
        }
    </script>
    </script>
@endsection

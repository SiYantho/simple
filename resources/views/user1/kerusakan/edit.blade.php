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
                                <form action="{{ route('kerusakan.update', $sparepart->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-group">
                                        <label for="vehicle_id">Mobil:</label>
                                        <select id="vehicle_id" name="vehicle_id" class="form-control" required>
                                            @foreach ($vehicles as $vehicle)
                                                <option value="{{ $vehicle->id }}"
                                                    {{ $vehicle->id == $sparepart->vehicle_id ? 'selected' : '' }}>
                                                    {{ $vehicle->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="tanggal">Tanggal:</label>
                                        <input type="date" id="tanggal" name="tanggal_ganti" class="form-control"
                                            value="{{ $sparepart->tanggal_ganti }}" readonly>
                                    </div>

                                    <h3>Detail Sparepart</h3>
                                    <div id="details">
                                        @foreach ($sparepart->details as $index => $detail)
                                            <div class="detail">
                                                <div class="form-group">
                                                    <label>Nama Barang:</label>
                                                    <input type="text" class="form-control"
                                                        name="details[{{ $index }}][nama_barang]"
                                                        value="{{ $detail->nama_barang }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Harga:</label>
                                                    <input type="number" class="form-control"
                                                        name="details[{{ $index }}][harga]"
                                                        value="{{ $detail->harga }}" step="0.01" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Kuantitas:</label>
                                                    <input type="number" class="form-control"
                                                        name="details[{{ $index }}][kuantitas]"
                                                        value="{{ $detail->jumlah }}" required>
                                                </div>
                                                <button type="button" class="btn btn-danger"
                                                    onclick="removeDetail(this)">Hapus</button>
                                                <hr>
                                            </div>
                                        @endforeach
                                    </div>
                                    <button type="button" class="btn btn-primary" onclick="addDetail()">Tambah
                                        Detail</button>

                                    <div class="form-group mt-3">
                                        <label for="bukti_transaksi">Bukti Transaksi:</label>
                                        <input type="file" id="bukti_transaksi" name="nota_bukti"
                                            class="form-control-file" accept=".jpg,.jpeg,.png,.pdf">
                                        @if ($sparepart->url_gambar_nota)
                                            <a href="{{ Storage::url($sparepart->url_gambar_nota) }}" target="_blank">Lihat
                                                Bukti Transaksi</a>
                                        @endif
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
        let detailCount = {{ $sparepart->details->count() }};

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
@endsection

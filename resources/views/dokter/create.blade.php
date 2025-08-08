@extends('kerangka.master')
@section('title', 'Tambah Data Dokter')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-primary">Tambah Data Dokter</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('dokter.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="nama">Nama Dokter</label>
                        <input type="text" name="nama" id="nama" class="form-control" value="{{ old('nama') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="poli">Poli</label>
                        <select name="poli" id="poli" class="form-control" required>
                            <option value="">-- Pilih Poli --</option>
                            <option value="Umum" {{ old('poli')=='Umum'?'selected':'' }}>Umum</option>
                            <option value="Gigi" {{ old('poli')=='Gigi'?'selected':'' }}>Gigi</option>
                            <option value="Anak" {{ old('poli')=='Anak'?'selected':'' }}>Anak</option>
                            <option value="Bedah" {{ old('poli')=='Bedah'?'selected':'' }}>Bedah</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="spesialis">Spesialis</label>
                        <select name="spesialis" id="spesialis" class="form-control" required>
                            <option value="">-- Pilih Spesialis --</option>
                            <option value="Dokter Umum" {{ old('spesialis')=='Dokter Umum'?'selected':'' }}>Dokter Umum</option>
                            <option value="Dokter Gigi" {{ old('spesialis')=='Dokter Gigi'?'selected':'' }}>Dokter Gigi</option>
                            <option value="Dokter Anak" {{ old('spesialis')=='Dokter Anak'?'selected':'' }}>Dokter Anak</option>
                            <option value="Dokter Bedah" {{ old('spesialis')=='Dokter Bedah'?'selected':'' }}>Dokter Bedah</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="jam_layanan">Jam Layanan</label>
                        <select name="jam_layanan" id="jam_layanan" class="form-control" required>
                            <option value="">-- Pilih Jam Layanan --</option>
                            <option value="07:00 - 09:00" {{ old('jam_layanan')=='07:00 - 09:00'?'selected':'' }}>07:00 - 09:00</option>
                            <option value="15:00 - 17:00" {{ old('jam_layanan')=='15:00 - 17:00'?'selected':'' }}>15:00 - 17:00</option>
                        </select>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('dokter.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

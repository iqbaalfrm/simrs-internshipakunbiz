@extends('kerangka.master')
@section('title','Pendaftaran Pasien')

@section('content')
<div class="row">
  <div class="col-lg-12 ">
    <div class="card shadow">
      <div class="card-header"><h3 class="m-0">Form Pendaftaran Pasien</h3></div>
      <div class="card-body">
        <form action="{{ route('pendaftaran.store') }}" method="POST">
          @csrf

          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">Nama Lengkap</label>
              <input type="text" name="nama" class="form-control" value="{{ old('nama') }}" required>
              @error('nama')<small class="text-danger">{{ $message }}</small>@enderror
            </div>
            <div class="col-md-3">
              <label class="form-label">Jenis Kelamin</label>
              <select name="jenis_kelamin" class="form-control" required>
                <option value="">-- Pilih --</option>
                <option value="L" {{ old('jenis_kelamin')=='L'?'selected':'' }}>Laki-laki</option>
                <option value="P" {{ old('jenis_kelamin')=='P'?'selected':'' }}>Perempuan</option>
              </select>
            </div>
            <div class="col-md-3">
              <label class="form-label">Tanggal Lahir</label>
              <input type="date" name="tanggal_lahir" class="form-control" value="{{ old('tanggal_lahir') }}">
            </div>

            <div class="col-md-6">
              <label class="form-label">NIK</label>
              <input type="text" name="nik" class="form-control" value="{{ old('nik') }}">
            </div>
            <div class="col-md-6">
              <label class="form-label">No. HP</label>
              <input type="text" name="no_hp" class="form-control" value="{{ old('no_hp') }}">
            </div>

            <div class="col-12">
              <label class="form-label">Alamat</label>
              <textarea name="alamat" class="form-control" rows="2">{{ old('alamat') }}</textarea>
            </div>

            <div class="col-md-4">
              <label class="form-label">Jenis Kunjungan</label>
              <select name="jenis_kunjungan" class="form-control" required>
                <option value="Rawat Jalan" {{ old('jenis_kunjungan')=='Rawat Jalan'?'selected':'' }}>Rawat Jalan</option>
                <option value="Rawat Inap"  {{ old('jenis_kunjungan')=='Rawat Inap'?'selected':'' }}>Rawat Inap</option>
              </select>
            </div>
            <div class="col-md-4">
              <label class="form-label">Poli</label>
              <select name="poli" class="form-control">
                <option value="">-- Pilih Poli --</option>
                @foreach($poliList as $p)
                  <option value="{{ $p }}" {{ old('poli')==$p?'selected':'' }}>{{ $p }}</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-4">
              <label class="form-label">Dokter</label>
              <select name="dokter" class="form-control">
                <option value="">-- Pilih Dokter --</option>
                @foreach($dokterList as $d)
                  <option value="{{ $d }}" {{ old('dokter')==$d?'selected':'' }}>{{ $d }}</option>
                @endforeach
              </select>
            </div>

            <div class="col-md-4">
              <label class="form-label">Pembiayaan</label>
              <select name="pembiayaan" class="form-control" required>
                <option value="Umum" {{ old('pembiayaan')=='Umum'?'selected':'' }}>Umum</option>
                <option value="BPJS" {{ old('pembiayaan')=='BPJS'?'selected':'' }}>BPJS</option>
                <option value="Asuransi" {{ old('pembiayaan')=='Asuransi'?'selected':'' }}>Asuransi</option>
              </select>
            </div>
            <div class="col-md-8">
              <label class="form-label">No. BPJS (opsional)</label>
              <input type="text" name="no_bpjs" class="form-control" value="{{ old('no_bpjs') }}">
            </div>
          </div>

          <div class="mt-4 d-flex gap-2">
            <button class="btn btn-primary" type="submit">Daftarkan</button>
            <a href="{{ route('pasien.index') }}" class="btn btn-secondary">Batal</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

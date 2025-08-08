@extends('kerangka.master')
@section('title','Pendaftaran Pasien')

@section('content')
<div class="row">
  <div class="col-lg-12">
    <div class="card shadow">
      <div class="card-header"><h3 class="m-0">Form Pendaftaran Pasien</h3></div>

      <div class="card-body">
        <form action="{{ route('pendaftaran.store') }}" method="POST">
          @csrf

          <div class="row g-3">
            {{-- Identitas --}}
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
              @error('jenis_kelamin')<small class="text-danger">{{ $message }}</small>@enderror
            </div>
            <div class="col-md-3">
              <label class="form-label">Tanggal Lahir</label>
              <input type="date" name="tanggal_lahir" class="form-control" value="{{ old('tanggal_lahir') }}">
              @error('tanggal_lahir')<small class="text-danger">{{ $message }}</small>@enderror
            </div>

            <div class="col-md-6">
              <label class="form-label">NIK</label>
              <input type="text" name="nik" class="form-control" value="{{ old('nik') }}">
              @error('nik')<small class="text-danger">{{ $message }}</small>@enderror
            </div>
            <div class="col-md-6">
              <label class="form-label">No. HP</label>
              <input type="text" name="no_hp" class="form-control" value="{{ old('no_hp') }}">
              @error('no_hp')<small class="text-danger">{{ $message }}</small>@enderror
            </div>

            <div class="col-12">
              <label class="form-label">Alamat</label>
              <textarea name="alamat" class="form-control" rows="2">{{ old('alamat') }}</textarea>
              @error('alamat')<small class="text-danger">{{ $message }}</small>@enderror
            </div>

            {{-- Kunjungan --}}
            <div class="col-md-4">
              <label class="form-label">Jenis Kunjungan</label>
              <select name="jenis_kunjungan" class="form-control" required>
                <option value="Rawat Jalan" {{ old('jenis_kunjungan')=='Rawat Jalan'?'selected':'' }}>Rawat Jalan</option>
                <option value="Rawat Inap"  {{ old('jenis_kunjungan')=='Rawat Inap'?'selected':'' }}>Rawat Inap</option>
              </select>
              @error('jenis_kunjungan')<small class="text-danger">{{ $message }}</small>@enderror
            </div>

            <div class="col-md-4">
              <label class="form-label">Poli</label>
              <select id="poliSelect" name="poli_id" class="form-control" required>
                <option value="">-- Pilih Poli --</option>
                @foreach($polis as $p)
                  <option value="{{ $p->id }}" {{ old('poli_id')==$p->id?'selected':'' }}>
                    {{ $p->nama }}
                  </option>
                @endforeach
              </select>
              @error('poli_id')<small class="text-danger">{{ $message }}</small>@enderror
            </div>

            <div class="col-md-4">
              <label class="form-label">Dokter</label>
              <select id="dokterSelect" name="dokter_id" class="form-control" required>
                <option value="">-- Pilih Dokter --</option>
                @foreach($dokters as $d)
                  <option value="{{ $d->id }}"
                          data-poli-id="{{ $d->poli_id }}"
                          {{ old('dokter_id')==$d->id?'selected':'' }}>
                    {{ $d->nama }}
                  </option>
                @endforeach
              </select>
              @error('dokter_id')<small class="text-danger">{{ $message }}</small>@enderror
            </div>

            {{-- Pembiayaan --}}
            <div class="col-md-4">
              <label class="form-label">Pembiayaan</label>
              <select name="pembiayaan" class="form-control" required>
                <option value="Umum"    {{ old('pembiayaan')=='Umum'?'selected':'' }}>Umum</option>
                <option value="BPJS"    {{ old('pembiayaan')=='BPJS'?'selected':'' }}>BPJS</option>
                <option value="Asuransi"{{ old('pembiayaan')=='Asuransi'?'selected':'' }}>Asuransi</option>
              </select>
              @error('pembiayaan')<small class="text-danger">{{ $message }}</small>@enderror
            </div>
            <div class="col-md-8">
              <label class="form-label">No. BPJS (opsional)</label>
              <input type="text" name="no_bpjs" class="form-control" value="{{ old('no_bpjs') }}">
              @error('no_bpjs')<small class="text-danger">{{ $message }}</small>@enderror
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

@section('js')
<script>
document.addEventListener('DOMContentLoaded', function () {
  const poliSelect   = document.getElementById('poliSelect');
  const dokterSelect = document.getElementById('dokterSelect');

  // Simpan semua option dokter (node aslinya)
  const allDoctorOptions = Array.from(dokterSelect.options);

  function rebuildDoctorOptions(poliId) {
    // kosongkan & buat option default
    dokterSelect.innerHTML = '<option value="">-- Pilih Dokter --</option>';

    // tampilkan semua / filter per poli
    allDoctorOptions.forEach(opt => {
      if (!opt.value) return;                           // skip opsi kosong lama
      if (!poliId || String(opt.dataset.poliId) === String(poliId)) {
        dokterSelect.appendChild(opt);
      }
    });
  }

  // PILIH POLI -> filter dokter sesuai poli
  poliSelect.addEventListener('change', () => {
    rebuildDoctorOptions(poliSelect.value);
    // reset dokter setelah filter
    dokterSelect.value = '';
  });

  // PILIH DOKTER -> set poli otomatis + filter list dokter sesuai poli
  dokterSelect.addEventListener('change', () => {
    const sel = dokterSelect.selectedOptions[0];
    const pid = sel ? sel.dataset.poliId : '';
    if (pid) {
      poliSelect.value = pid;                      // set poli
      poliSelect.dispatchEvent(new Event('change'));// trigger filter ulang
      dokterSelect.value = sel.value;              // reselect dokter yang dipilih
    }
  });

  // INIT: sinkronkan kalau ada old('dokter_id') / old('poli_id')
  const selectedDoctor = dokterSelect.selectedOptions[0];
  const initialPid = selectedDoctor?.dataset.poliId || poliSelect.value || '';
  rebuildDoctorOptions(initialPid);
  if (initialPid) poliSelect.value = initialPid;
});
</script>
@endsection

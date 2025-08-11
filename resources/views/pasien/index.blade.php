@extends('kerangka.master')
@section('title','Data Pasien')

@section('content')
<div class="card">
  <div class="card-header d-flex align-items-center justify-content-between">
    <h4 class="m-0">Data Pasien</h4>
    @role('admin')
        <a href="{{ route('pendaftaran.create') }}" class="btn btn-primary">+ Daftar Pasien</a>
    @endrole
  </div>

  <div class="card-body">

    {{-- SweetAlert session --}}
    @if (session('success') || session('error'))
      <script>
        document.addEventListener('DOMContentLoaded', function () {
          if (!window.Swal) { alert(@json(session('success') ?? session('error'))); return; }
          Swal.fire(
            @json(session('success') ? 'Berhasil' : 'Gagal'),
            @json(session('success') ?? session('error')),
            @json(session('success') ? 'success' : 'error')
          );
        });
      </script>
    @endif

    {{-- Filter --}}
    <form class="row g-2 mb-3" method="get">
      <div class="col-md-4">
        <input name="q" value="{{ $q }}" class="form-control" placeholder="Cari nama / NIK / No RM">
      </div>
      <div class="col-md-3">
        <select name="poli_id" class="form-control">
          <option value="">-- Semua Poli --</option>
          @foreach($polis as $p)
            <option value="{{ $p->id }}" {{ (string)$p->id === (string)$poli_id ? 'selected' : '' }}>
              {{ $p->nama }}
            </option>
          @endforeach
        </select>
      </div>
      <div class="col-md-2">
        <button class="btn btn-outline-secondary w-100">Filter</button>
      </div>
    </form>

    {{-- Tabel --}}
    <div class="table-responsive">
      <table class="table table-striped align-middle">
        <thead>
          <tr>
            <th>No RM</th>
            <th>Nama</th>
            <th>JK</th>
            <th>Poli</th>
            <th>Dokter</th>
            <th>Pembiayaan</th>
            <th>Antrian</th>
            <th>Daftar</th>
          </tr>
        </thead>
        <tbody>
          @forelse($pasiens as $ps)
            <tr>
              <td class="text-nowrap">{{ $ps->no_rm }}</td>
              <td class="text-nowrap">{{ $ps->nama }}</td>
              <td>{{ $ps->jenis_kelamin }}</td>
              <td>{{ $ps->poli->nama ?? '-' }}</td>
              <td class="text-nowrap">{{ $ps->dokter->nama ?? '-' }}</td>
              <td>
                <span class="badge {{ $ps->pembiayaan === 'Umum' ? 'bg-secondary' : ($ps->pembiayaan === 'BPJS' ? 'bg-success' : 'bg-info') }}">
                  {{ $ps->pembiayaan }}
                </span>
              </td>
              <td>{{ $ps->no_antrian }}</td>
              <td class="text-nowrap">{{ $ps->created_at?->format('d/m/Y H:i') }}</td>
            </tr>
          @empty
            <tr>
              <td colspan="8" class="text-center text-muted py-4">Belum ada data.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <div class="mt-3">
      {{ $pasiens->links() }}
    </div>
  </div>
</div>
@endsection

@section('js')
  {{-- SweetAlert CDN (kalau belum ada di master layout) --}}
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection

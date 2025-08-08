@extends('kerangka.master')
@section('title','Data Pasien')

@section('content')
<div class="row">
  <div class="col-12">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h4 class="m-0">Data Pasien</h4>
      <a href="{{ route('pendaftaran.create') }}" class="btn btn-primary">+ Daftarkan Pasien</a>
    </div>

    {{-- Filter --}}
    <form method="GET" class="card mb-3">
      <div class="card-body row g-2 align-items-end">
        <div class="col-md-5">
          <label class="form-label">Cari (Nama / NIK / No RM)</label>
          <input type="text" name="q" class="form-control" value="{{ $q }}">
        </div>
        <div class="col-md-4">
          <label class="form-label">Poli</label>
          <select name="poli_id" class="form-control">
            <option value="">-- Semua Poli --</option>
            @foreach($polis as $p)
              <option value="{{ $p->id }}" @selected($poli_id==$p->id)>{{ $p->nama }}</option>
            @endforeach
          </select>
        </div>
        <div class="col-md-3 d-grid">
          <button class="btn btn-outline-primary">Terapkan</button>
        </div>
      </div>
    </form>

    <div class="card">
      <div class="card-body table-responsive">
        <table class="table table-striped table-hover m-0">
          <thead>
            <tr>
              <th>No RM</th>
              <th>Nama</th>
              <th>JK</th>
              <th>Poli</th>
              <th>Dokter</th>
              <th>Pembiayaan</th>
              <th>Tgl Daftar</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse($pasien as $row)
              <tr>
                <td>{{ $row->no_rm }}</td>
                <td>{{ $row->nama }}</td>
                <td>{{ $row->jenis_kelamin }}</td>
                <td>{{ $row->poli->nama ?? '-' }}</td>
                <td>{{ $row->dokter->nama ?? '-' }}</td>
                <td>{{ $row->pembiayaan }}</td>
                <td>{{ $row->created_at->format('d/m/Y H:i') }}</td>
                <td class="d-flex gap-1">
                  {{-- (opsional) detail dan print kartu dari modul pendaftaran --}}
                  {{-- <a href="#" class="btn btn-sm btn-info">Detail</a> --}}
                  <a href="#" class="btn btn-sm btn-secondary">Print Kartu</a>
                </td>
              </tr>
            @empty
              <tr><td colspan="8" class="text-center">Belum ada data pasien.</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>
      @if(method_exists($pasien,'links'))
        <div class="card-footer">{{ $pasien->links() }}</div>
      @endif
    </div>
  </div>
</div>
@endsection

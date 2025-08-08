@extends('kerangka.master')
@section('title','Pendaftaran Pasien')

@section('content')
<div class="row">
  <div class="col-12">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h4 class="m-0">Pendaftaran Pasien</h4>
      <a href="{{ route('pendaftaran.create') }}" class="btn btn-primary">+ Daftar Pasien</a>
    </div>

    <div class="card">
      <div class="card-body table-responsive">
        <table class="table table-striped table-hover m-0">
          <thead>
            <tr>
              <th>No RM</th>
              <th>Antrian</th>
              <th>Nama</th>
              <th>JK</th>
              <th>Poli</th>
              <th>Dokter</th>
              <th>Pembiayaan</th>
              <th>Tgl Daftar</th>
            </tr>
          </thead>
          <tbody>
            @forelse($list as $p)
            <tr>
              <td>{{ $p->no_rm }}</td>
              <td>{{ $p->no_antrian }}</td>
              <td>{{ $p->nama }}</td>
              <td>{{ $p->jenis_kelamin }}</td>
              <td>{{ $p->poli }}</td>
              <td>{{ $p->dokter }}</td>
              <td>{{ $p->pembiayaan }}</td>
              <td>{{ $p->created_at->format('d/m/Y H:i') }}</td>
            </tr>
            @empty
            <tr><td colspan="8" class="text-center">Belum ada pendaftaran.</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>
      @if(method_exists($list,'links'))
        <div class="card-footer">{{ $list->links() }}</div>
      @endif
    </div>
  </div>
</div>
@endsection

@section('js')
{{-- SweetAlert2 untuk notifikasi sukses --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
@if(session('success'))
  Swal.fire({ icon:'success', title:'Pendaftaran Berhasil', text:'{{ session('success') }}', timer:2500, showConfirmButton:false });
@endif
@if(session('error'))
  Swal.fire({ icon:'error', title:'Gagal', text:'{{ session('error') }}' });
@endif
</script>
@endsection

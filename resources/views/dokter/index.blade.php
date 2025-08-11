@extends('kerangka.master')
@section('title', 'Daftar Dokter')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card shadow mb-4">
            <a href="#listdokter" class="d-block card-header py-3" data-toggle="collapse" role="button"
               aria-expanded="true" aria-controls="listdokter">
                <h3 class="m-0 font-weight-bold text-primary">Daftar Dokter</h3>
            </a>

            <div class="collapse show" id="listdokter">
                <div class="card-body">
                    {{-- Tombol tambah data --}}
                    <a href="{{ route('dokter.create') }}" class="btn btn-primary float-right mb-3">
                        Tambah Data Dokter
                    </a>

                    {{-- Tabel --}}
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped m-0" id="DataTable">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Poli</th>
                                    <th>Spesialis</th>
                                    <th>Jam Layanan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($dokters as $dokter)
                                    <tr>
                                        <td>{{ $dokter->nama }}</td>
                                        <td>{{ $dokter->poli->nama }}</td>
                                        <td>{{ $dokter->spesialis }}</td>
                                        <td>{{ $dokter->jam_layanan }}</td>
                                        <td>
                                            <a href="{{ route('dokter.show', $dokter->id) }}" class="btn btn-sm btn-info">Detail</a>
                                            <a href="{{ route('dokter.edit', $dokter->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                            <form action="{{ route('dokter.destroy', $dokter->id) }}" method="POST" class="d-inline form-delete">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Belum ada data dokter.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    @if(method_exists($dokters, 'links'))
                        <div class="mt-3">
                            {{ $dokters->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#DataTable').DataTable();

        // Konfirmasi hapus pakai SweetAlert
        $('.form-delete').on('submit', function(e) {
            e.preventDefault();
            let form = this;
            Swal.fire({
                title: 'Yakin?',
                text: "Data dokter ini akan dihapus!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });

        // Notifikasi sukses / error dari session
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{{ session('success') }}',
                timer: 2000,
                showConfirmButton: false
            });
        @endif

        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: '{{ session('error') }}',
                timer: 2000,
                showConfirmButton: false
            });
        @endif
    });
</script>
@endsection

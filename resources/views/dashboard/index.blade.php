@extends('kerangka.master')
@section('title', 'Dashboard')

@section('content')
<div class="page-content">
    <section class="row">
        <div class="col-12">
            <div class="row g-3"> {{-- jarak antar-kartu rapih --}}
                {{-- Jumlah Kriteria --}}
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="card h-100">
                        <div class="card-body px-4 py-3">
                            <div class="d-flex align-items-center">
                                <div class="stats-icon purple me-3">
                                    <i class="iconly-boldShow"></i>
                                </div>
                                <div>
                                    <h6 class="text-muted m-0">Jumlah Kriteria</h6>
                                    <h4 class="fw-bold m-0">{{ $jumlahKriteria ?? 0 }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Jumlah Alternatif --}}
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="card h-100">
                        <div class="card-body px-4 py-3">
                            <div class="d-flex align-items-center">
                                <div class="stats-icon blue me-3">
                                    <i class="iconly-boldProfile"></i>
                                </div>
                                <div>
                                    <h6 class="text-muted m-0">Jumlah Alternatif</h6>
                                    <h4 class="fw-bold m-0">{{ $jumlahAlternatif ?? 0 }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Jumlah Dokter --}}
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="card h-100">
                        <div class="card-body px-4 py-3">
                            <div class="d-flex align-items-center">
                                <div class="stats-icon red me-3">
                                    <i class="iconly-boldBookmark"></i>
                                </div>
                                <div>
                                    <h6 class="text-muted m-0">Jumlah Dokter</h6>
                                    <h4 class="fw-bold m-0">{{ $jumlahDokter ?? 0 }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Jumlah User --}}
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="card h-100">
                        <div class="card-body px-4 py-3">
                            <div class="d-flex align-items-center">
                                <div class="stats-icon green me-3">
                                    <i class="iconly-boldAdd-User"></i>
                                </div>
                                <div>
                                    <h6 class="text-muted m-0">Jumlah User</h6>
                                    <h4 class="fw-bold m-0">{{ $jumlahUser ?? 0 }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Deskripsi Website --}}
                <div class="col-12">
                    <div class="card mt-2">
                        <div class="card-body">
                            <h5 class="card-title mb-2">Deskripsi Website</h5>
                            <p class="card-text mb-0">
                                Website ini merupakan platform yang didedikasikan untuk mendukung keputusan dalam pemilihan guru di SMK Asy Syamsuriyyah menggunakan Metode Simple Additive Weighting (SAW).
                                Metode SAW memungkinkan evaluasi terstruktur terhadap calon guru berdasarkan kriteria-kriteria yang telah ditentukan sebelumnya.
                            </p>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    </section>
</div>
@endsection

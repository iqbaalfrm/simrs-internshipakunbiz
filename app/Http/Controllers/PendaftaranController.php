<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use Illuminate\Http\Request;
use App\Models\Poli;
use App\Models\Dokter;

class PendaftaranController extends Controller
{


public function create()
{
    return view('pendaftaran.create', [
        'polis'   => Poli::orderBy('nama')->get(),
        'dokters' => Dokter::orderBy('nama')->get(),
    ]);
}

public function store(Request $req)
{
    $validated = $req->validate([
        'nama'            => ['required','string','max:150'],
        'jenis_kelamin'   => ['required','in:L,P'],
        'tanggal_lahir'   => ['nullable','date'],
        'no_hp'           => ['nullable','max:30'],
        'alamat'          => ['nullable','max:1000'],
        'nik'             => ['nullable','max:20'],
        'jenis_kunjungan' => ['required','in:Rawat Jalan,Rawat Inap'],
        'poli_id'         => ['required','exists:polis,id'],
        'dokter_id'       => ['required','exists:dokters,id'],
        'pembiayaan'      => ['required','in:Umum,BPJS,Asuransi'],
        'no_bpjs'         => ['nullable','max:30'],
    ]);

    // No RM (RM + YYYYMM + 4 digit)
    $prefix  = 'RM' . now()->format('Ym');
    $maxNoRm = Pasien::where('no_rm','like',"$prefix%")->max('no_rm');
    $base    = $maxNoRm ?: ($prefix.'0000');
    $running = (int)substr($base, -4);
    $no_rm   = $prefix . str_pad($running + 1, 4, '0', STR_PAD_LEFT);

    // No antrian per hari (global atau per poli — pilih salah satu; ini global)
    $maxToday   = Pasien::whereDate('created_at', now()->toDateString())->count();
    $no_antrian = 'A-' . str_pad($maxToday + 1, 3, '0', STR_PAD_LEFT);

    Pasien::create([
        ...$validated,
        'no_rm'      => $no_rm,
        'no_antrian' => $no_antrian,
    ]);

    return redirect()->route('pasien.index')->with('success', 'Pendaftaran pasien berhasil.');
}
}
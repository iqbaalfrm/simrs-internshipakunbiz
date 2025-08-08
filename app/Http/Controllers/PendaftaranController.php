<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class PendaftaranController extends Controller
{
    public function index()
    {
        $list = Pasien::latest()->paginate(10);
        return view('pendaftaran.index', compact('list'));
    }

    public function create()
    {
        // contoh opsi statis; bisa kamu ambil dari tabel master jika ada
        $poliList   = ['Umum','Gigi','Anak','Bedah','Kandungan'];
        $dokterList = ['Dr. Budi','Dr. Siti','Dr. Rina','Dr. Andi'];
        return view('pendaftaran.create', compact('poliList','dokterList'));
    }

    public function store(Request $req)
    {
        $validated = $req->validate([
            'nama'           => ['required','string','max:150'],
            'jenis_kelamin'  => ['required','in:L,P'],
            'tanggal_lahir'  => ['nullable','date'],
            'no_hp'          => ['nullable','max:30'],
            'alamat'         => ['nullable','max:1000'],
            'nik'            => ['nullable','max:20'],
            'jenis_kunjungan'=> ['required','in:Rawat Jalan,Rawat Inap'],
            'poli'           => ['nullable','string','max:100'],
            'dokter'         => ['nullable','string','max:150'],
            'pembiayaan'     => ['required','in:Umum,BPJS,Asuransi'],
            'no_bpjs'        => ['nullable','max:30'],
        ]);

        // Generate No RM (format: RMYYYYMM####)
        $prefix   = 'RM' . now()->format('Ym');
        $maxNoRm  = Pasien::where('no_rm', 'like', "$prefix%")->max('no_rm'); // contoh: RM2025080007
        $base     = $maxNoRm ?: ($prefix . '0000');                           // fallback kalau belum ada
        $running  = (int) substr($base, -4);                                  // ambil 4 digit terakhir (string -> int OK)
        $no_rm    = $prefix . str_pad($running + 1, 4, '0', STR_PAD_LEFT);

        // No Antrian harian (A-001)
        $maxToday   = Pasien::whereDate('created_at', now()->toDateString())->count();
        $no_antrian = 'A-' . str_pad($maxToday + 1, 3, '0', STR_PAD_LEFT);

        $pasien = Pasien::create(array_merge($validated, [
            'no_rm' => $no_rm,
            'no_antrian' => $no_antrian,
        ]));

        return redirect()->route('pasien.index')
            ->with('success', "Pendaftaran berhasil. No RM: {$pasien->no_rm}, Antrian: {$pasien->no_antrian}");
    }
}

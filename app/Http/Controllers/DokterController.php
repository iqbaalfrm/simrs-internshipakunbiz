<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\Poli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; // <-- Tambahkan ini untuk logging
use Exception; // <-- Tambahkan ini untuk menangkap semua jenis error

class DokterController extends Controller
{
    /**
     * Tampilkan daftar dokter.
     */
    public function index()
    {
        // Mengambil data dokter dengan relasi poli untuk ditampilkan di tabel
        $dokters = Dokter::with('poli')->latest()->paginate(10);
        $jumlahDokter = Dokter::count();

        return view('dokter.index', compact('dokters', 'jumlahDokter'));
    }

    /**
     * Tampilkan form tambah dokter.
     */
    public function create()
    {
        // Mengambil semua data poli untuk ditampilkan di dropdown
        $polis = Poli::orderBy('nama')->get();
        return view('dokter.create', compact('polis'));
    }

    /**
     * Simpan data dokter baru.
     */
    public function store(Request $request)
    {
        Log::info('Memulai proses store dokter.'); // Log #1: Memulai proses

        try {
            // Log #2: Melihat semua data yang dikirim dari form
            Log::info('Data dari form:', $request->all());

            // Validasi data
            $validated = $request->validate([
                'nama'        => ['required', 'string', 'max:150'],
                'poli'        => ['required', 'string', 'max:100'],
                'spesialis'   => ['required', 'string', 'max:150'],
                'jam_layanan' => ['required', 'string', 'max:100'],
            ]);

            Log::info('Validasi berhasil.'); // Log #3: Validasi berhasil

            // Cari atau buat Poli baru
            $poli = Poli::firstOrCreate(['nama' => $validated['poli']]);
            Log::info('Poli ditemukan atau dibuat:', ['id' => $poli->id, 'nama' => $poli->nama]); // Log #4

            // Buat data dokter baru
            $dokter = Dokter::create([
                'nama'        => $validated['nama'],
                'spesialis'   => $validated['spesialis'],
                'jam_layanan' => $validated['jam_layanan'],
                'poli_id'     => $poli->id,
            ]);
            Log::info('Dokter berhasil dibuat:', $dokter->toArray()); // Log #5

            Log::info('Akan redirect ke halaman index dengan pesan sukses.'); // Log #6
            return redirect()
                ->route('dokter.index')
                ->with('success', 'Data dokter berhasil ditambahkan.');
        } catch (Exception $e) {
            // Log #7: Menangkap APAPUN error yang terjadi
            Log::error('Terjadi error saat menyimpan dokter: ' . $e->getMessage());
            Log::error('Trace:', ['trace' => $e->getTraceAsString()]); // Log detail error

            // Redirect kembali dengan pesan error umum
            return back()->with('error', 'Terjadi kesalahan saat menyimpan data. Silakan cek log.');
        }
    }

    /**
     * Detail dokter (opsional dipakai).
     */
    public function show(Dokter $dokter)
    {
        return view('dokter.show', compact('dokter'));
    }

    /**
     * Tampilkan form edit dokter.
     */
    public function edit(Dokter $dokter)
    {
        // Sama seperti method create, kita butuh data semua poli untuk dropdown
        $polis = Poli::orderBy('nama')->get();

        // Kirim data dokter yang akan diedit DAN data semua poli ke view
        return view('dokter.edit', compact('dokter', 'polis'));
    }

    /**
     * Update data dokter.
     */
    public function update(Request $request, Dokter $dokter)
    {
        // Validasi diubah untuk menerima 'poli_id' bukan 'poli'
        $validated = $request->validate([
            'nama'        => ['required', 'string', 'max:150'],
            'poli_id'     => ['required', 'integer', 'exists:polis,id'], // Memastikan poli_id ada di tabel polis
            'spesialis'   => ['required', 'string', 'max:150'],
            'jam_layanan' => ['required', 'string', 'max:100'],
        ]);

        // Update data dokter dengan data yang sudah divalidasi
        $dokter->update($validated);

        return redirect()
            ->route('dokter.index')
            ->with('success', 'Data dokter berhasil diperbarui.');
    }

    /**
     * Hapus data dokter.
     */
    public function destroy(Dokter $dokter)
    {
        $dokter->delete();

        return redirect()
            ->route('dokter.index')
            ->with('success', 'Data dokter berhasil dihapus.');
    }

    /**
     * Mengambil dokter berdasarkan Poli untuk dependent dropdown.
     */
    public function getByPoli($poli_id)
    {
        // Langsung cari dokter berdasarkan foreign key 'poli_id'.
        $dokters = Dokter::where('poli_id', $poli_id)->orderBy('nama')->get(['id', 'nama']);

        return response()->json($dokters);
    }
}

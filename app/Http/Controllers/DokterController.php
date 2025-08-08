<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use Illuminate\Http\Request;

class DokterController extends Controller
{
    /**
     * Tampilkan daftar dokter.
     */
    public function index()
    {
        // Jika pakai DataTables client-side, boleh pakai ->get()
        // Kalau mau paginate di Blade, pakai ->paginate(10)

    $dokters = Dokter::latest()->paginate(10);
    $jumlahDokter = Dokter::count();

    return view('dokter.index', compact('dokters', 'jumlahDokter'));

    }

    /**
     * Tampilkan form tambah dokter.
     */
    public function create()
    {
        return view('dokter.create');
    }

    /**
     * Simpan data dokter baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'        => ['required', 'string', 'max:150'],
            'poli'        => ['required', 'string', 'max:100'],
            'spesialis'   => ['required', 'string', 'max:150'],
            'jam_layanan' => ['required', 'string', 'max:100'], // contoh: "08:00 - 12:00"
        ]);

        Dokter::create($validated);

        return redirect()
            ->route('dokter.index')
            ->with('success', 'Data dokter berhasil ditambahkan.');
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
        return view('dokter.edit', compact('dokter'));
    }

    /**
     * Update data dokter.
     */
    public function update(Request $request, Dokter $dokter)
    {
        $validated = $request->validate([
            'nama'        => ['required', 'string', 'max:150'],
            'poli'        => ['required', 'string', 'max:100'],
            'spesialis'   => ['required', 'string', 'max:150'],
            'jam_layanan' => ['required', 'string', 'max:100'],
        ]);

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
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dokter extends Model
{
    use HasFactory;
    
    // Properti ini bagus untuk kejelasan, tapi tidak wajib
    protected $table = 'dokters';

    /**
     * Atribut yang dapat diisi secara massal.
     * INI BAGIAN YANG DIPERBAIKI.
     */
    protected $fillable = [
        'nama',
        'poli_id', // Diubah dari 'poli' menjadi 'poli_id'
        'spesialis',
        'jam_layanan',
    ];

    /**
     * Mendefinisikan relasi ke model Poli.
     * Ini akan memungkinkan Anda untuk mengambil data poli dari dokter,
     * contoh: $dokter->poli->nama
     */
    public function poli()
    {
        return $this->belongsTo(Poli::class);
    }
}

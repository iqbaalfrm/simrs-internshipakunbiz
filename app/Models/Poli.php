<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poli extends Model
{
    use HasFactory;

    /**
     * Atribut yang dapat diisi secara massal.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama',
        // Tambahkan nama kolom lain di sini jika ada
    ];

    /**
     * Mendefinisikan relasi "satu ke banyak" dengan model Dokter.
     * Satu poli bisa memiliki banyak dokter.
     */
    public function dokters()
    {
        return $this->hasMany(Dokter::class);
    }
}

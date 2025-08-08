<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;

    protected $table = 'pasien';

    protected $fillable = [
        'no_rm','no_antrian','nik','nama','jenis_kelamin','tanggal_lahir',
        'no_hp','alamat','jenis_kunjungan','poli_id','dokter_id',
        'pembiayaan','no_bpjs',
    ];

    public function poli()   { return $this->belongsTo(Poli::class, 'poli_id'); }
    public function dokter() { return $this->belongsTo(Dokter::class, 'dokter_id'); }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // 1) Tambah kolom FK (nullable dulu biar aman buat backfill)
        Schema::table('pasien', function (Blueprint $t) {
            $t->foreignId('poli_id')->nullable()->after('jenis_kunjungan')->constrained('polis');
            $t->foreignId('dokter_id')->nullable()->after('poli_id')->constrained('dokters');
        });

        // 2) Backfill: copy dari string "poli" & "dokter" ke *_id (based on name match)
        //    -> diasumsikan kamu sudah punya tabel 'polis' (kolom 'id','nama') & 'dokters' (id,nama)
        //    -> mapping by name; kalau nggak ketemu, biarkan null.
        DB::statement("
            UPDATE pasien p
            LEFT JOIN polis pl ON pl.nama = p.poli
            LEFT JOIN dokters d ON d.nama = p.dokter
            SET p.poli_id = pl.id,
                p.dokter_id = d.id
        ");

        // 3) (Opsional kuat) Ubah jadi NOT NULL kalau kamu butuh wajib FK
        //    Pastikan dulu semua baris sudah terisi. Kalau masih ada null, skip bagian ini.
        // Schema::table('pasien', function (Blueprint $t) {
        //     $t->foreignId('poli_id')->nullable(false)->change();
        //     $t->foreignId('dokter_id')->nullable(false)->change();
        // });

        // 4) Drop kolom string lama
        Schema::table('pasien', function (Blueprint $t) {
            $t->dropColumn(['poli', 'dokter']);
        });
    }

    public function down(): void
    {
        // 1) Balikin kolom string
        Schema::table('pasien', function (Blueprint $t) {
            $t->string('poli')->nullable()->after('jenis_kunjungan');
            $t->string('dokter')->nullable()->after('poli');
        });

        // 2) Copy balik nama dari master (join ke polis & dokters)
        DB::statement("
            UPDATE pasien p
            LEFT JOIN polis pl ON pl.id = p.poli_id
            LEFT JOIN dokters d ON d.id = p.dokter_id
            SET p.poli   = pl.nama,
                p.dokter = d.nama
        ");

        // 3) Hapus FK kolom *_id
        Schema::table('pasien', function (Blueprint $t) {
            $t->dropConstrainedForeignId('poli_id');
            $t->dropConstrainedForeignId('dokter_id');
        });
    }
};

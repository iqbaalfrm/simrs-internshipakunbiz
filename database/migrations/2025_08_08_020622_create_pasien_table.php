<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pasien', function (Blueprint $table) {
            $table->id();
            $table->string('no_rm')->unique();              // No. Rekam Medis
            $table->string('no_antrian')->nullable();       // antrian harian
            $table->string('nik', 20)->nullable();
            $table->string('nama');
            $table->enum('jenis_kelamin', ['L','P']);
            $table->date('tanggal_lahir')->nullable();
            $table->string('no_hp', 30)->nullable();
            $table->text('alamat')->nullable();

            $table->enum('jenis_kunjungan', ['Rawat Jalan','Rawat Inap'])->default('Rawat Jalan');
            $table->string('poli')->nullable();             // contoh: Umum/Gigi/Anak
            $table->string('dokter')->nullable();           // nama/ID dokter (boleh null)

            $table->enum('pembiayaan', ['Umum','BPJS','Asuransi'])->default('Umum');
            $table->string('no_bpjs', 30)->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pasien');
    }
};


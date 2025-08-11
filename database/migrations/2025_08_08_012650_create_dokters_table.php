<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('dokters', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            
            // --- INI BAGIAN YANG BENAR ---
            // Membuat kolom 'poli_id' dan menghubungkannya ke tabel 'polis'
            $table->foreignId('poli_id')->constrained('polis')->onDelete('cascade');
            
            $table->string('spesialis');
            $table->string('jam_layanan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokters');
    }
};
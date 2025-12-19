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
        Schema::create('petugas_fasilitas', function (Blueprint $table) {
            $table->id('petugas_id'); // INI YANG PENTING: pakai id('petugas_id')
            $table->unsignedBigInteger('fasilitas_id');
            $table->unsignedInteger('petugas_warga_id');
            $table->string('peran');
            $table->timestamps();

            // Foreign key ke tabel fasilitas_umum
            $table->foreign('fasilitas_id')
                  ->references('fasilitas_id')
                  ->on('fasilitas_umum')
                  ->onDelete('cascade');

            // Foreign key ke tabel warga
            $table->foreign('petugas_warga_id')
                  ->references('warga_id')
                  ->on('warga')
                  ->onDelete('cascade');

            // Unique constraint
            $table->unique(['fasilitas_id', 'petugas_warga_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('petugas_fasilitas');
    }
};

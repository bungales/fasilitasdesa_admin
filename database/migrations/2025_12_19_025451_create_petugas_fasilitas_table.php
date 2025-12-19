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
            $table->id(); // Primary key auto increment
            $table->unsignedBigInteger('fasilitas_id'); // FK ke fasilitas_umum
            $table->unsignedInteger('petugas_warga_id'); // FK ke warga
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

            // Unique constraint agar satu warga tidak jadi petugas dua kali di fasilitas yang sama
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

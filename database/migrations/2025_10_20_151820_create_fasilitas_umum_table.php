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
        Schema::create('fasilitas_umum', function (Blueprint $table) {
            $table->id('fasilitas_id');
            $table->string('nama');
            $table->string('jenis');
            $table->string('alamat');
            $table->string('rt', 5);
            $table->string('rw', 2);
            $table->integer('kapasitas')->nullable();
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fasilitas_umum');
    }
};

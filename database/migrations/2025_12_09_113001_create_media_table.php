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
        Schema::create('media', function (Blueprint $table) {
            $table->id('media_id');
            $table->string('ref_table', 100); // contoh: 'fasilitas_umum', 
            $table->unsignedBigInteger('ref_id'); // ID dari tabel referensi (fasilitas_id, berita_id, dll)
            $table->string('file_name'); // nama file yang disimpan di server
            $table->string('caption')->nullable(); // keterangan/kaption file
            $table->string('mime_type', 100); // tipe file: image/jpeg, application/pdf, dll
            $table->integer('sort_order')->default(0); // urutan tampilan
            $table->timestamps();

            // Index untuk mempercepat query
            $table->index(['ref_table', 'ref_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media');
    }
};

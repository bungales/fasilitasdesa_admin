<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('peminjaman_fasilitas', function (Blueprint $table) {
            $table->id('pinjam_id');

            // FK ke fasilitas_umum (PK = fasilitas_id)
            $table->unsignedBigInteger('fasilitas_id');
            $table->foreign('fasilitas_id')
                ->references('fasilitas_id')
                ->on('fasilitas_umum')
                ->onDelete('cascade');

            // FK ke warga (PK = warga_id)
            $table->unsignedInteger('warga_id');
            $table->foreign('warga_id')
                ->references('warga_id')
                ->on('warga')
                ->onDelete('cascade');

            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->string('tujuan');
            $table->string('status');
            $table->decimal('total_biaya', 12, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('peminjaman_fasilitas');
    }
};

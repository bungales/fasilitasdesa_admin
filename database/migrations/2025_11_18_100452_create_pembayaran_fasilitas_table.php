<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pembayaran_fasilitas', function (Blueprint $table) {
            $table->increments('bayar_id');

            // HARUS bigInteger supaya kompatibel
            $table->unsignedBigInteger('pinjam_id');
            $table->foreign('pinjam_id')
                ->references('pinjam_id')
                ->on('peminjaman_fasilitas')
                ->onDelete('cascade');

            $table->date('tanggal');
            $table->decimal('jumlah', 12, 2);
            $table->string('metode');
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pembayaran_fasilitas');
    }
};

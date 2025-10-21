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
        Schema::create('warga', function (Blueprint $table) {
            $table->increments('warga_id');
            $table->string('nama', 100);   // panjang nama maksimal 100 karakter
            $table->string('alamat', 255); // panjang alamat maksimal 255 karakter
            $table->string('rt', 5);
            $table->string('rw', 5);
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->string('no_hp', 15); // maksimal 15 digit nomor HP
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('warga');
    }
};




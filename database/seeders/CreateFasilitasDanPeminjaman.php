<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CreateFasilitasDanPeminjaman extends Seeder
{
    public function run()
    {
        // 1. Warga
        $wargaId = DB::table('warga')->insertGetId([
            'nama' => 'Bunga',
            'alamat' => 'Jl. Mawar No. 10',
            'rt' => '02',
            'rw' => '05',
            'jenis_kelamin' => 'Perempuan',
            'no_hp' => '081234567890',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 2. Fasilitas Umum
        $fasilitasId = DB::table('fasilitas_umum')->insertGetId([
            'nama' => 'Aula Serbaguna',
            'jenis' => 'aula',
            'alamat' => 'Jl. Melati No. 5',
            'rt' => '02',
            'rw' => '05',
            'kapasitas' => 200,
            'deskripsi' => 'Aula untuk kegiatan warga',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 3. Peminjaman Fasilitas (terhubung ke warga dan fasilitas)
        DB::table('peminjaman_fasilitas')->insert([
            'fasilitas_id'   => $fasilitasId,
            'warga_id'       => $wargaId,
            'tanggal_mulai'  => '2025-01-20',
            'tanggal_selesai'=> '2025-01-20',
            'tujuan'         => 'Rapat RT',
            'status'         => 'disetujui',
            'total_biaya'    => 100000,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}

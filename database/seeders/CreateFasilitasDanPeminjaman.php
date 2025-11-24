<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CreateFasilitasDanPeminjaman extends Seeder
{
    public function run()
    {
        // Daftar nama Indonesia
        $namaLaki = [
            'Budi Santoso', 'Andi Wijaya', 'Joko Pratama', 'Rudi Hartono', 'Agus Setiawan',
            'Dedi Kurniawan', 'Rangga Saputra', 'Fajar Kurnia', 'Rizki Ramadhan', 'Hendra Gunawan',
            'Yoga Prasetyo', 'Bayu Saputra', 'Gilang Aji', 'Eko Susanto', 'Imam Maulana',
            'Dimas Febrianto', 'Restu Firmansyah', 'Yudi Pratama', 'Arif Wibowo', 'Syahrul Anwar'
        ];

        $namaPerempuan = [
            'Bunga Lestari', 'Dewi Lestari', 'Ayu Wulandari', 'Rina Apriani', 'Melati Sari',
            'Putri Ramadhani', 'Ayuni Maharani', 'Nadia Puspita', 'Lia Rahmawati', 'Citra Anggraini',
            'Fitri Yuliana', 'Intan Safitri', 'Yuliana Putri', 'Salsa Amelia', 'Nurul Hidayah',
            'Anisa Kartika', 'Bella Fitriana', 'Dina Maharani', 'Ranti Azizah', 'Rosa Deviana'
        ];

        // Daftar fasilitas
        $namaFasilitas = [
            'Aula Serbaguna', 'Balai Pertemuan', 'Lapangan Olahraga',
            'Gedung Serbaguna', 'Ruang Rapat Desa', 'GOR Mini', 'Pendopo Desa'
        ];

        for ($i = 1; $i <= 100; $i++) {

            // Tentukan jenis kelamin acak
            $isFemale = rand(0,1);

            // Ambil nama sesuai gender
            $nama = $isFemale
                ? $namaPerempuan[array_rand($namaPerempuan)]
                : $namaLaki[array_rand($namaLaki)];

            // 1. Insert ke warga
            $wargaId = DB::table('warga')->insertGetId([
                'nama' => $nama,
                'alamat' => 'Jalan Mawar No. ' . rand(1, 200),
                'rt' => str_pad(rand(1, 10), 2, '0', STR_PAD_LEFT),
                'rw' => str_pad(rand(1, 10), 2, '0', STR_PAD_LEFT),
                'jenis_kelamin' => $isFemale ? 'Perempuan' : 'Laki-laki',
                'no_hp' => '08' . rand(1000000000, 9999999999),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // 2. Insert ke fasilitas umum (TANPA TANDA PAGAR)
            $fasilitasNama = $namaFasilitas[array_rand($namaFasilitas)];

            $fasilitasId = DB::table('fasilitas_umum')->insertGetId([
                'nama' => $fasilitasNama . " " . rand(1, 50),  // ← sudah diperbaiki
                'jenis' => Str::slug($fasilitasNama),
                'alamat' => 'Jl. Fasilitas No. ' . rand(1, 100),
                'rt' => str_pad(rand(1, 10), 2, '0', STR_PAD_LEFT),
                'rw' => str_pad(rand(1, 10), 2, '0', STR_PAD_LEFT),
                'kapasitas' => rand(50, 500),
                'deskripsi' => 'Fasilitas untuk kegiatan warga desa.',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // 3. Insert ke peminjaman fasilitas
            DB::table('peminjaman_fasilitas')->insert([
                'fasilitas_id' => $fasilitasId,
                'warga_id' => $wargaId,
                'tanggal_mulai' => now()->subDays(rand(1, 60)),
                'tanggal_selesai' => now()->subDays(rand(0, 59)),
                'tujuan' => 'Kegiatan warga ' . $nama,
                'status' => ['menunggu', 'disetujui', 'ditolak'][rand(0, 2)],
                'total_biaya' => rand(50000, 500000),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

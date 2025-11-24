<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CreatePembayaranFasilitas extends Seeder
{
    public function run(): void
    {
        // Ambil semua pinjam_id yang valid dari tabel peminjaman
        $pinjamIds = DB::table('peminjaman_fasilitas')->pluck('pinjam_id');

        if ($pinjamIds->count() == 0) {
            dd("Tabel peminjaman_fasilitas masih kosong!");
        }

        $data = [];

        for ($i = 0; $i < 100; $i++) {
            $data[] = [
                'pinjam_id'  => $pinjamIds->random(),   // ← SUDAH SESUAI MIGRATION
                'tanggal'    => now()->subDays(rand(1, 365)),
                'jumlah'     => rand(50000, 500000),
                'metode'     => ['Cash', 'Transfer', 'QRIS'][rand(0, 2)],
                'keterangan' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('pembayaran_fasilitas')->insert($data);
    }
}

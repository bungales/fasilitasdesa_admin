<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FasilitasController extends Controller
{
    public function index()
    {
        // Data dummy sesuai tabel fasilitas_umum
        $fasilitas = [
            [
                'fasilitas_id' => 1,
                'nama'        => 'Balai Desa',
                'jenis'       => 'Aula',
                'alamat'      => 'Jl. Merdeka No. 10',
                'rt'          => '01',
                'rw'          => '02',
                'kapasitas'   => 200,
                'deskripsi'   => 'Balai desa untuk acara resmi atau rapat umum',
            ],
            [
                'fasilitas_id' => 2,
                'nama'        => 'Lapangan Desa',
                'jenis'       => 'Lapangan',
                'alamat'      => 'Jl. Sudirman No. 5',
                'rt'          => '03',
                'rw'          => '01',
                'kapasitas'   => 500,
                'deskripsi'   => 'Lapangan serbaguna untuk olahraga dan acara desa',
            ],
        ];

        // Passing data ke view
        return view('fasilitas.index', compact('fasilitas'));
    }
}


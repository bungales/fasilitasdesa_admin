<?php

namespace App\Http\Controllers;

use App\Models\PeminjamanFasilitas;
use App\Models\FasilitasUmum;
use App\Models\Warga;
use Illuminate\Http\Request;

class PeminjamanFasilitasController extends Controller
{
    public function index()
    {
        $peminjaman = PeminjamanFasilitas::with(['fasilitas', 'warga'])->get();
        return view('pages.peminjamanfasilitas.index', compact('peminjaman'));
    }

    public function create()
    {
        $fasilitas = FasilitasUmum::all();
        $warga = Warga::all();

        return view('pages.peminjamanfasilitas.create', compact('fasilitas', 'warga'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'fasilitas_id' => 'required',
            'warga_id' => 'required',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date',
            'tujuan' => 'required',
            'status' => 'required',
            'total_biaya' => 'required|numeric',
        ]);

        PeminjamanFasilitas::create($request->all());

        return redirect()->route('peminjaman.index')
            ->with('success', 'Peminjaman berhasil ditambahkan!');
    }

    public function show(PeminjamanFasilitas $peminjaman)
    {
        return view('pages.peminjamanfasilitas.show', compact('peminjaman'));
    }

    public function edit(PeminjamanFasilitas $peminjaman)
    {
        $fasilitas = FasilitasUmum::all();
        $warga = Warga::all();

        return view('pages.peminjamanfasilitas.edit', compact('peminjaman', 'fasilitas', 'warga'));
    }

    public function update(Request $request, PeminjamanFasilitas $peminjaman)
    {
        $request->validate([
            'fasilitas_id' => 'required',
            'warga_id' => 'required',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date',
            'tujuan' => 'required',
            'status' => 'required',
            'total_biaya' => 'required|numeric',
        ]);

        $peminjaman->update($request->all());

        return redirect()->route('peminjaman.index')
            ->with('success', 'Peminjaman berhasil diperbarui!');
    }

    public function destroy(PeminjamanFasilitas $peminjaman)
    {
        $peminjaman->delete();

        return redirect()->route('peminjaman.index')
            ->with('success', 'Peminjaman berhasil dihapus!');
    }
}

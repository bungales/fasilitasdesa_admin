<?php

namespace App\Http\Controllers;

use App\Models\PembayaranFasilitas;
use App\Models\PeminjamanFasilitas;
use Illuminate\Http\Request;

class PembayaranFasilitasController extends Controller
{
    public function index()
    {
        // Ambil semua pembayaran dengan relasi ke peminjaman, warga, dan fasilitas
        $pembayaran = PembayaranFasilitas::with('peminjaman.warga', 'peminjaman.fasilitas')->get();
        return view('pages.pembayaranfasilitas.index', compact('pembayaran'));
    }

    public function create()
    {
        $peminjaman = PeminjamanFasilitas::with('warga', 'fasilitas')->get();
        return view('pages.pembayaranfasilitas.create', compact('peminjaman'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pinjam_id' => 'required',
            'tanggal' => 'required|date',
            'jumlah' => 'required|numeric',
            'metode' => 'required',
            'keterangan' => 'nullable',
        ]);

        PembayaranFasilitas::create($request->all());

        return redirect()->route('pembayaran.index')
            ->with('success', 'Pembayaran berhasil ditambahkan!');
    }

    public function edit(PembayaranFasilitas $pembayaran)
    {
        $peminjaman = PeminjamanFasilitas::with('warga', 'fasilitas')->get();
        return view('pages.pembayaranfasilitas.edit', compact('pembayaran', 'peminjaman'));
    }

    public function update(Request $request, PembayaranFasilitas $pembayaran)
    {
        $request->validate([
            'pinjam_id' => 'required',
            'tanggal' => 'required|date',
            'jumlah' => 'required|numeric',
            'metode' => 'required',
            'keterangan' => 'nullable',
        ]);

        $pembayaran->update($request->all());

        return redirect()->route('pembayaran.index')
            ->with('success', 'Pembayaran berhasil diperbarui!');
    }

    public function destroy(PembayaranFasilitas $pembayaran)
    {
        $pembayaran->delete();

        return redirect()->route('pembayaran.index')
            ->with('success', 'Pembayaran berhasil dihapus!');
    }
}

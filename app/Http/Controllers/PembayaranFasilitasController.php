<?php

namespace App\Http\Controllers;

use App\Models\PembayaranFasilitas;
use App\Models\PeminjamanFasilitas;
use Illuminate\Http\Request;

class PembayaranFasilitasController extends Controller
{
    public function index(Request $request)
    {

        //  SEARCH

        $search = $request->search;


        //  FILTER METODE (opsional)

        $filterMetode = $request->metode;

        // Query dasar
        $query = PembayaranFasilitas::with('peminjaman.warga', 'peminjaman.fasilitas');

        // SEARCH
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->whereHas('peminjaman.warga', function ($w) use ($search) {
                    $w->where('nama', 'like', "%$search%");
                })
                ->orWhereHas('peminjaman.fasilitas', function ($f) use ($search) {
                    $f->where('nama', 'like', "%$search%");
                })
                ->orWhere('keterangan', 'like', "%$search%")
                ->orWhere('metode', 'like', "%$search%");
            });
        }

        // FILTER METODE
        if ($filterMetode) {
            $query->where('metode', $filterMetode);
        }

        // PAGINATION 
        $pembayaran = $query->orderBy('bayar_id', 'DESC')->paginate(10);

        return view('pages.pembayaranfasilitas.index', compact(
            'pembayaran',
            'search',
            'filterMetode'
        ));
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
            'tanggal'   => 'required|date',
            'jumlah'    => 'required|numeric',
            'metode'    => 'required',
            'keterangan'=> 'nullable',
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
            'tanggal'   => 'required|date',
            'jumlah'    => 'required|numeric',
            'metode'    => 'required',
            'keterangan'=> 'nullable',
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

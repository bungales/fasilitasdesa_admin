<?php

namespace App\Http\Controllers;

use App\Models\PeminjamanFasilitas;
use App\Models\FasilitasUmum;
use App\Models\Warga;
use Illuminate\Http\Request;

class PeminjamanFasilitasController extends Controller
{
    public function index(Request $request)
    {
        // SEARCH + FILTER
        $search = $request->search;
        $filterStatus = $request->status;

        // Query dasar
        $query = PeminjamanFasilitas::with(['fasilitas', 'warga']);

        //SEARCH
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->whereHas('warga', function ($w) use ($search) {
                    $w->where('nama', 'like', "%$search%");
                })
                ->orWhereHas('fasilitas', function ($f) use ($search) {
                    $f->where('nama', 'like', "%$search%");
                })
                ->orWhere('tujuan', 'like', "%$search%")
                ->orWhere('status', 'like', "%$search%");
            });
        }

        //  FILTER STATUS
        if ($filterStatus) {
            $query->where('status', $filterStatus);
        }

        // PAGINATION
        $peminjaman = $query->orderBy('pinjam_id', 'DESC')->paginate(10);

        return view('pages.peminjamanfasilitas.index', compact(
            'peminjaman',
            'search',
            'filterStatus'
        ));
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

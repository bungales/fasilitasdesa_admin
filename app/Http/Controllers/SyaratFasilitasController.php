<?php

namespace App\Http\Controllers;

use App\Models\PetugasFasilitas;
use App\Models\FasilitasUmum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class PetugasFasilitasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = PetugasFasilitas::query();

        // Filter berdasarkan fasilitas
        if ($request->filled('fasilitas_id')) {
            $query->where('fasilitas_id', $request->fasilitas_id);
        }

        // Search
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('nama_petugas', 'like', '%' . $request->search . '%')
                  ->orWhere('jabatan', 'like', '%' . $request->search . '%')
                  ->orWhereHas('fasilitas', function($w) use ($request) {
                      $w->where('nama', 'like', '%' . $request->search . '%');
                  });
            });
        }

        // PERBAIKAN: Gunakan 'id' bukan 'petugas_id'
        // Cek dulu kolom mana yang ada di database
        $orderColumn = 'created_at'; // default

        if (Schema::hasColumn('petugas_fasilitas', 'id')) {
            $orderColumn = 'id';
        } elseif (Schema::hasColumn('petugas_fasilitas', 'petugas_id')) {
            $orderColumn = 'petugas_id';
        }

        $petugasFasilitas = $query->orderBy($orderColumn, 'desc')->paginate(10);

        // Ambil semua fasilitas untuk dropdown
        $fasilitasList = FasilitasUmum::orderBy('nama')->get();

        return view(
            'pages.petugasfasilitas.index',
            compact('petugasFasilitas', 'fasilitasList')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $fasilitasList = FasilitasUmum::orderBy('nama')->get();
        return view('pages.petugasfasilitas.create', compact('fasilitasList'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'fasilitas_id'   => 'required|exists:fasilitas_umum,id',
            'nama_petugas'   => 'required|string|max:255',
            'jabatan'        => 'required|string|max:100',
            'no_telepon'     => 'nullable|string|max:20',
            'alamat'         => 'nullable|string',
            'tanggal_mulai'  => 'nullable|date',
            'status'         => 'nullable|in:active,inactive',
        ]);

        PetugasFasilitas::create([
            'fasilitas_id'   => $request->fasilitas_id,
            'nama_petugas'   => $request->nama_petugas,
            'jabatan'        => $request->jabatan,
            'no_telepon'     => $request->no_telepon,
            'alamat'         => $request->alamat,
            'tanggal_mulai'  => $request->tanggal_mulai,
            'status'         => $request->status ?? 'active',
        ]);

        return redirect()
            ->route('petugas-fasilitas.index')
            ->with('success', 'Petugas fasilitas berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $petugas = PetugasFasilitas::with('fasilitas')->findOrFail($id);
        return view('pages.petugasfasilitas.show', compact('petugas'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $petugas = PetugasFasilitas::findOrFail($id);
        $fasilitasList = FasilitasUmum::orderBy('nama')->get();

        return view('pages.petugasfasilitas.edit', compact('petugas', 'fasilitasList'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $petugas = PetugasFasilitas::findOrFail($id);

        $request->validate([
            'fasilitas_id'   => 'required|exists:fasilitas_umum,id',
            'nama_petugas'   => 'required|string|max:255',
            'jabatan'        => 'required|string|max:100',
            'no_telepon'     => 'nullable|string|max:20',
            'alamat'         => 'nullable|string',
            'tanggal_mulai'  => 'nullable|date',
            'status'         => 'nullable|in:active,inactive',
        ]);

        $petugas->update([
            'fasilitas_id'   => $request->fasilitas_id,
            'nama_petugas'   => $request->nama_petugas,
            'jabatan'        => $request->jabatan,
            'no_telepon'     => $request->no_telepon,
            'alamat'         => $request->alamat,
            'tanggal_mulai'  => $request->tanggal_mulai,
            'status'         => $request->status ?? 'active',
        ]);

        return redirect()
            ->route('petugas-fasilitas.index')
            ->with('success', 'Petugas fasilitas berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $petugas = PetugasFasilitas::findOrFail($id);
        $petugas->delete();

        return redirect()
            ->route('petugas-fasilitas.index')
            ->with('success', 'Petugas fasilitas berhasil dihapus.');
    }

    /**
     * Get petugas by fasilitas
     */
    public function byFasilitas($fasilitas_id)
    {
        $petugas = PetugasFasilitas::where('fasilitas_id', $fasilitas_id)
            ->orderBy('nama_petugas')
            ->get();

        return response()->json($petugas);
    }

    /**
     * Get petugas by warga (jika ada relasi)
     */
    public function byWarga($warga_id)
    {
        // Jika ada relasi dengan warga, sesuaikan
        $petugas = PetugasFasilitas::where('warga_id', $warga_id)
            ->orderBy('nama_petugas')
            ->get();

        return response()->json($petugas);
    }
}

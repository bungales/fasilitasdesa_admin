<?php

namespace App\Http\Controllers;

use App\Models\PetugasFasilitas;
use App\Models\FasilitasUmum;
use App\Models\Warga;
use Illuminate\Http\Request;

class PetugasFasilitasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $petugasFasilitas = PetugasFasilitas::with(['warga', 'fasilitas'])->get();
        return response()->json($petugasFasilitas);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'fasilitas_id' => 'required|integer|exists:fasilitas_umum,fasilitas_id',
            'petugas_warga_id' => 'required|integer|exists:warga,warga_id',
            'peran' => 'required|string|max:100',
        ]);

        // Cek apakah warga sudah menjadi petugas di fasilitas ini
        $existing = PetugasFasilitas::where('fasilitas_id', $request->fasilitas_id)
            ->where('petugas_warga_id', $request->petugas_warga_id)
            ->exists();

        if ($existing) {
            return response()->json([
                'message' => 'Warga ini sudah menjadi petugas di fasilitas ini'
            ], 422);
        }

        $petugasFasilitas = PetugasFasilitas::create($request->all());
        return response()->json($petugasFasilitas, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $petugasFasilitas = PetugasFasilitas::with(['warga', 'fasilitas'])->findOrFail($id);
        return response()->json($petugasFasilitas);
    }

    /**
     * Display petugas by fasilitas_id
     */
    public function byFasilitas($fasilitas_id)
    {
        $petugas = PetugasFasilitas::with('warga')
            ->where('fasilitas_id', $fasilitas_id)
            ->get();
        return response()->json($petugas);
    }

    /**
     * Display fasilitas by warga_id
     */
    public function byWarga($warga_id)
    {
        $fasilitas = PetugasFasilitas::with('fasilitas')
            ->where('petugas_warga_id', $warga_id)
            ->get();
        return response()->json($fasilitas);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $petugasFasilitas = PetugasFasilitas::findOrFail($id);

        $request->validate([
            'fasilitas_id' => 'integer|exists:fasilitas_umum,fasilitas_id',
            'petugas_warga_id' => 'integer|exists:warga,warga_id',
            'peran' => 'string|max:100',
        ]);

        // Cek duplikasi jika ada perubahan fasilitas atau warga
        if ($request->has('fasilitas_id') || $request->has('petugas_warga_id')) {
            $fasilitas_id = $request->fasilitas_id ?? $petugasFasilitas->fasilitas_id;
            $warga_id = $request->petugas_warga_id ?? $petugasFasilitas->petugas_warga_id;

            $existing = PetugasFasilitas::where('fasilitas_id', $fasilitas_id)
                ->where('petugas_warga_id', $warga_id)
                ->where('id', '!=', $id)
                ->exists();

            if ($existing) {
                return response()->json([
                    'message' => 'Warga ini sudah menjadi petugas di fasilitas ini'
                ], 422);
            }
        }

        $petugasFasilitas->update($request->all());
        return response()->json($petugasFasilitas);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $petugasFasilitas = PetugasFasilitas::findOrFail($id);
        $petugasFasilitas->delete();
        return response()->json(['message' => 'Petugas berhasil dihapus'], 200);
    }
}

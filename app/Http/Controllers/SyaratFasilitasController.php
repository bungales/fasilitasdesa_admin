<?php

namespace App\Http\Controllers;

use App\Models\PetugasFasilitas;
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
            'petugas_id' => 'required|integer|unique:petugas_fasilitas',
            'fasilitas_id' => 'required|integer|exists:fasilitas,fasilitas_id',
            'petugas_warga_id' => 'required|integer|exists:warga,warga_id',
            'peran' => 'required|string|max:100',
        ]);

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
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $petugasFasilitas = PetugasFasilitas::findOrFail($id);

        $request->validate([
            'fasilitas_id' => 'integer|exists:fasilitas,fasilitas_id',
            'petugas_warga_id' => 'integer|exists:warga,warga_id',
            'peran' => 'string|max:100',
        ]);

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
        return response()->json(null, 204);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\FasilitasUmum;
use Illuminate\Http\Request;

class FasilitasUmumController extends Controller
{
    public function index()
    {

    $fasilitas = FasilitasUmum::all();
    return view('pages.fasilitasumum.index', compact('fasilitas'));


    }

    public function create()
    {
        return view('pages.fasilitasumum.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'jenis' => 'required',
            'alamat' => 'required',
            'rt' => 'required',
            'rw' => 'required',
            'kapasitas' => 'required|numeric',
        ]);

        FasilitasUmum::create($request->all());

        return redirect()->route('fasilitasumum.index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit(FasilitasUmum $fasilitasumum)
    {

        return view('pages.fasilitasumum.edit', compact('fasilitasumum'));
    }

    public function update(Request $request, FasilitasUmum $fasilitasumum)
    {
        $request->validate([
            'nama' => 'required',
            'jenis' => 'required',
            'alamat' => 'required',
            'rt' => 'required',
            'rw' => 'required',
            'kapasitas' => 'required|numeric',
        ]);

        $fasilitasumum->update($request->all());
        return redirect()->route('fasilitasumum.index')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy(FasilitasUmum $fasilitasumum)
    {
        $fasilitasumum->delete();
        return redirect()->route('fasilitasumum.index')->with('success', 'Data berhasil dihapus!');
    }
}

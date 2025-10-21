<?php
namespace App\Http\Controllers;


use App\Models\Warga;
use Illuminate\Http\Request;


class WargaController extends Controller
{
    // Menampilkan daftar warga
    public function index()
    {
        $warga = Warga::all();
        return view('admin.warga.index', compact('warga'));
    }


    public function create()
    {
        return view('admin.warga.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'nama'          => 'required|max:100',
            'alamat'        => 'required|max:255',
            'rt'            => 'required|max:5',
            'rw'            => 'required|max:5',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'no_hp'         => 'required|max:15',
        ]);


        Warga::create([
            'nama'          => $request->nama,
            'alamat'        => $request->alamat,
            'rt'            => $request->rt,
            'rw'            => $request->rw,
            'jenis_kelamin' => $request->jenis_kelamin,
            'no_hp'         => $request->no_hp,
        ]);


        return redirect()->route('warga.create')->with('success', 'Data warga berhasil ditambahkan!');


    }
    public function edit($id)
    {
        $warga = Warga::findOrFail($id);
        return view('admin.warga.edit', compact('warga'));
    }


    // Update data
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|max:100',
            'alamat' => 'required|max:255',
            'rt' => 'required|max:5',
            'rw' => 'required|max:5',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'no_hp' => 'required|max:15',
        ]);


        $warga = Warga::findOrFail($id);
        $warga->update($request->all());


        return redirect()->route('warga.index')
                         ->with('success', 'Data warga berhasil diperbarui!');
    }


    // Hapus data
    public function destroy($id)
    {
        $warga = Warga::findOrFail($id);
        $warga->delete();


        return redirect()->route('warga.index')
                         ->with('success', 'Data warga berhasil dihapus!');
    }
}




<?php
namespace App\Http\Controllers;

use App\Models\Warga;
use Illuminate\Http\Request;

class WargaController extends Controller
{
    // Menampilkan daftar warga dengan search + filter + pagination
    public function index(Request $request)
    {
        $search   = $request->search;
        $filterRT = $request->rt;
        $filterRW = $request->rw;

        $query = Warga::query();

        // SEARCH
        if($search) {
            $query->where('nama','like',"%{$search}%")
                  ->orWhere('alamat','like',"%{$search}%");
        }

        // FILTER RT
        if($filterRT) {
            $query->where('rt',$filterRT);
        }

        // FILTER RW
        if($filterRW) {
            $query->where('rw',$filterRW);
        }

        // Pagination
        $warga = $query->orderBy('warga_id', 'DESC')->paginate(10);

        // Ambil semua RT & RW unik untuk dropdown filter
        $rtList = Warga::select('rt')->distinct()->orderBy('rt')->pluck('rt');
        $rwList = Warga::select('rw')->distinct()->orderBy('rw')->pluck('rw');

        return view('pages.warga.index', compact('warga', 'search', 'filterRT', 'filterRW', 'rtList', 'rwList'));
    }

    public function create()
    {
        return view('pages.warga.create');
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

        Warga::create($request->all());

        return redirect()->route('warga.index')->with('success', 'Data warga berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $warga = Warga::findOrFail($id);
        return view('pages.warga.edit', compact('warga'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama'          => 'required|max:100',
            'alamat'        => 'required|max:255',
            'rt'            => 'required|max:5',
            'rw'            => 'required|max:5',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'no_hp'         => 'required|max:15',
        ]);

        $warga = Warga::findOrFail($id);
        $warga->update($request->all());

        return redirect()->route('warga.index')->with('success', 'Data warga berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $warga = Warga::findOrFail($id);
        $warga->delete();

        return redirect()->route('warga.index')->with('success', 'Data warga berhasil dihapus!');
    }
}

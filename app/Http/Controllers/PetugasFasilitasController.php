<?php

namespace App\Http\Controllers;

use App\Models\PetugasFasilitas;
use App\Models\FasilitasUmum;
use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class PetugasFasilitasController extends Controller
{
    public function index(Request $request)
    {
        $query = PetugasFasilitas::with(['warga', 'fasilitas']);

        // Search hanya berdasarkan nama warga
        if ($request->filled('search')) {
            $query->whereHas('warga', function ($w) use ($request) {
                $w->where('nama', 'like', '%' . $request->search . '%');
            });
        }

        // ORDER BY dengan cara yang aman untuk Alwaysdata
        try {
            // Cek apakah kolom petugas_id ada di tabel
            if (Schema::hasColumn('petugas_fasilitas', 'petugas_id')) {
                $petugasFasilitas = $query->orderBy('petugas_id', 'desc')->paginate(10);
            }
            // Cek apakah kolom id ada
            elseif (Schema::hasColumn('petugas_fasilitas', 'id')) {
                $petugasFasilitas = $query->orderBy('id', 'desc')->paginate(10);
            }
            // Default ke created_at
            else {
                $petugasFasilitas = $query->orderBy('created_at', 'desc')->paginate(10);
            }
        } catch (\Exception $e) {
            // Fallback jika semua gagal
            $petugasFasilitas = $query->latest()->paginate(10);
        }

        // Ambil semua fasilitas untuk dropdown
        $fasilitasList = FasilitasUmum::orderBy('nama')->get();

        return view(
            'pages.petugasfasilitas.index',
            compact('petugasFasilitas', 'fasilitasList')
        );
    }

    public function create()
    {
        $fasilitasList = FasilitasUmum::orderBy('nama')->get();
        $wargaList = Warga::orderBy('nama')->get();

        return view(
            'pages.petugasfasilitas.create',
            compact('fasilitasList', 'wargaList')
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'fasilitas_id' => 'required|exists:fasilitas_umum,fasilitas_id',
            'petugas_warga_id' => 'required|exists:warga,warga_id',
            'peran' => 'required|string|max:100',
        ]);

        // Cek apakah warga sudah menjadi petugas di fasilitas ini
        $existing = PetugasFasilitas::where('fasilitas_id', $request->fasilitas_id)
            ->where('petugas_warga_id', $request->petugas_warga_id)
            ->exists();

        if ($existing) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Warga ini sudah menjadi petugas di fasilitas ini');
        }

        // Cek jika peran Penanggung jawab
        if (strtolower($request->peran) == 'penanggung jawab') {
            $isPenanggungJawabLain = PetugasFasilitas::where('petugas_warga_id', $request->petugas_warga_id)
                ->whereRaw('LOWER(peran) = ?', ['penanggung jawab'])
                ->exists();

            if ($isPenanggungJawabLain) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->with('warning', 'Warga ini sudah menjadi Penanggung jawab di fasilitas lain');
            }
        }

        try {
            $petugasData = [
                'fasilitas_id' => $request->fasilitas_id,
                'petugas_warga_id' => $request->petugas_warga_id,
                'peran' => $request->peran,
            ];

            // Cek apakah tabel memiliki kolom petugas_id atau id
            if (Schema::hasColumn('petugas_fasilitas', 'petugas_id')) {
                $petugas = PetugasFasilitas::create($petugasData);
            } else {
                // Gunakan DB langsung untuk menghindari masalah auto-increment
                $id = DB::table('petugas_fasilitas')->insertGetId([
                    'fasilitas_id' => $request->fasilitas_id,
                    'petugas_warga_id' => $request->petugas_warga_id,
                    'peran' => $request->peran,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            return redirect()
                ->route('petugas-fasilitas.index')
                ->with('success', 'Petugas fasilitas berhasil ditambahkan');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Gagal menyimpan: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        // Cari berdasarkan primary key yang ada
        try {
            $petugasFasilitas = PetugasFasilitas::with(['warga', 'fasilitas'])->findOrFail($id);
        } catch (\Exception $e) {
            // Fallback: cari dengan cara lain
            $petugasFasilitas = PetugasFasilitas::with(['warga', 'fasilitas'])
                ->where(function($query) use ($id) {
                    if (Schema::hasColumn('petugas_fasilitas', 'petugas_id')) {
                        $query->orWhere('petugas_id', $id);
                    }
                    if (Schema::hasColumn('petugas_fasilitas', 'id')) {
                        $query->orWhere('id', $id);
                    }
                })
                ->firstOrFail();
        }

        return view('pages.petugasfasilitas.show', compact('petugasFasilitas'));
    }

    public function edit($id)
    {
        // Cari berdasarkan primary key yang ada
        try {
            $petugasFasilitas = PetugasFasilitas::findOrFail($id);
        } catch (\Exception $e) {
            // Fallback: cari dengan cara lain
            $petugasFasilitas = PetugasFasilitas::where(function($query) use ($id) {
                    if (Schema::hasColumn('petugas_fasilitas', 'petugas_id')) {
                        $query->orWhere('petugas_id', $id);
                    }
                    if (Schema::hasColumn('petugas_fasilitas', 'id')) {
                        $query->orWhere('id', $id);
                    }
                })
                ->firstOrFail();
        }

        $fasilitasList = FasilitasUmum::orderBy('nama')->get();
        $wargaList = Warga::orderBy('nama')->get();

        return view(
            'pages.petugasfasilitas.edit',
            compact('petugasFasilitas', 'fasilitasList', 'wargaList')
        );
    }

    public function update(Request $request, $id)
    {
        // Cari data dengan cara yang aman
        try {
            $petugasFasilitas = PetugasFasilitas::findOrFail($id);
        } catch (\Exception $e) {
            // Fallback: cari dengan cara lain
            $petugasFasilitas = PetugasFasilitas::where(function($query) use ($id) {
                    if (Schema::hasColumn('petugas_fasilitas', 'petugas_id')) {
                        $query->orWhere('petugas_id', $id);
                    }
                    if (Schema::hasColumn('petugas_fasilitas', 'id')) {
                        $query->orWhere('id', $id);
                    }
                })
                ->firstOrFail();
        }

        $request->validate([
            'fasilitas_id' => 'required|exists:fasilitas_umum,fasilitas_id',
            'petugas_warga_id' => 'required|exists:warga,warga_id',
            'peran' => 'required|string|max:100',
        ]);

        // Tentukan primary key untuk where clause
        $primaryKey = 'id';
        if (Schema::hasColumn('petugas_fasilitas', 'petugas_id')) {
            $primaryKey = 'petugas_id';
        }

        // Cek duplikasi (kecuali data saat ini)
        if ($request->fasilitas_id != $petugasFasilitas->fasilitas_id ||
            $request->petugas_warga_id != $petugasFasilitas->petugas_warga_id) {

            $existing = PetugasFasilitas::where('fasilitas_id', $request->fasilitas_id)
                ->where('petugas_warga_id', $request->petugas_warga_id)
                ->where($primaryKey, '!=', $id)
                ->exists();

            if ($existing) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->with('error', 'Warga ini sudah menjadi petugas di fasilitas ini');
            }
        }

        // Cek jika peran diubah menjadi Penanggung jawab
        if (strtolower($request->peran) == 'penanggung jawab' &&
            strtolower($petugasFasilitas->peran) != 'penanggung jawab') {

            $isPenanggungJawabLain = PetugasFasilitas::where('petugas_warga_id', $request->petugas_warga_id)
                ->whereRaw('LOWER(peran) = ?', ['penanggung jawab'])
                ->where($primaryKey, '!=', $id)
                ->exists();

            if ($isPenanggungJawabLain) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->with('warning', 'Warga ini sudah menjadi Penanggung jawab di fasilitas lain');
            }
        }

        // Update data
        $petugasFasilitas->update([
            'fasilitas_id' => $request->fasilitas_id,
            'petugas_warga_id' => $request->petugas_warga_id,
            'peran' => $request->peran,
        ]);

        return redirect()
            ->route('petugas-fasilitas.index')
            ->with('success', 'Petugas fasilitas berhasil diperbarui');
    }

    public function destroy($id)
    {
        // Cari data dengan cara yang aman
        try {
            $petugasFasilitas = PetugasFasilitas::findOrFail($id);
        } catch (\Exception $e) {
            // Fallback: cari dengan cara lain
            $petugasFasilitas = PetugasFasilitas::where(function($query) use ($id) {
                    if (Schema::hasColumn('petugas_fasilitas', 'petugas_id')) {
                        $query->orWhere('petugas_id', $id);
                    }
                    if (Schema::hasColumn('petugas_fasilitas', 'id')) {
                        $query->orWhere('id', $id);
                    }
                })
                ->firstOrFail();
        }

        $petugasFasilitas->delete();

        return redirect()
            ->route('petugas-fasilitas.index')
            ->with('success', 'Petugas fasilitas berhasil dihapus');
    }
}

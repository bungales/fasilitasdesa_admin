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

        if ($request->filled('search')) {
            $query->whereHas('warga', function ($w) use ($request) {
                $w->where('nama', 'like', '%' . $request->search . '%');
            });
        }

        // ORDER BY yang UNIVERSAL - cek kolom apa yang ada
        try {
            if (Schema::hasColumn('petugas_fasilitas', 'id')) {
                // Jika ada kolom 'id' (Alwaysdata)
                $petugasFasilitas = $query->orderBy('id', 'desc')->paginate(10);
            } elseif (Schema::hasColumn('petugas_fasilitas', 'petugas_id')) {
                // Jika ada kolom 'petugas_id' (mungkin di local)
                $petugasFasilitas = $query->orderBy('petugas_id', 'desc')->paginate(10);
            } else {
                // Default ke created_at jika ada
                $petugasFasilitas = $query->latest()->paginate(10);
            }
        } catch (\Exception $e) {
            // Fallback tanpa orderBy
            $petugasFasilitas = $query->paginate(10);
        }

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

        $existing = PetugasFasilitas::where('fasilitas_id', $request->fasilitas_id)
            ->where('petugas_warga_id', $request->petugas_warga_id)
            ->exists();

        if ($existing) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Warga ini sudah menjadi petugas di fasilitas ini');
        }

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

        PetugasFasilitas::create([
            'fasilitas_id' => $request->fasilitas_id,
            'petugas_warga_id' => $request->petugas_warga_id,
            'peran' => $request->peran,
        ]);

        return redirect()
            ->route('petugas-fasilitas.index')
            ->with('success', 'Petugas fasilitas berhasil ditambahkan');
    }

    // PARAMETER: $petugas_fasilita (sesuai Route::resource())
    public function show($petugas_fasilita)
    {
        $petugasFasilitas = PetugasFasilitas::with(['warga', 'fasilitas'])
            ->findOrFail($petugas_fasilita);

        return view('pages.petugasfasilitas.show', compact('petugasFasilitas'));
    }

    public function edit($petugas_fasilita)
    {
        $petugasFasilitas = PetugasFasilitas::findOrFail($petugas_fasilita);
        $fasilitasList = FasilitasUmum::orderBy('nama')->get();
        $wargaList = Warga::orderBy('nama')->get();

        return view(
            'pages.petugasfasilitas.edit',
            compact('petugasFasilitas', 'fasilitasList', 'wargaList')
        );
    }

    public function update(Request $request, $petugas_fasilita)
    {
        $petugasFasilitas = PetugasFasilitas::findOrFail($petugas_fasilita);

        $request->validate([
            'fasilitas_id' => 'required|exists:fasilitas_umum,fasilitas_id',
            'petugas_warga_id' => 'required|exists:warga,warga_id',
            'peran' => 'required|string|max:100',
        ]);

        // Tentukan primary key untuk where clause
        $primaryKey = $this->getPrimaryKeyColumn();

        if ($request->fasilitas_id != $petugasFasilitas->fasilitas_id ||
            $request->petugas_warga_id != $petugasFasilitas->petugas_warga_id) {

            $existing = PetugasFasilitas::where('fasilitas_id', $request->fasilitas_id)
                ->where('petugas_warga_id', $request->petugas_warga_id)
                ->where($primaryKey, '!=', $petugas_fasilita)
                ->exists();

            if ($existing) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->with('error', 'Warga ini sudah menjadi petugas di fasilitas ini');
            }
        }

        if (strtolower($request->peran) == 'penanggung jawab' &&
            strtolower($petugasFasilitas->peran) != 'penanggung jawab') {

            $isPenanggungJawabLain = PetugasFasilitas::where('petugas_warga_id', $request->petugas_warga_id)
                ->whereRaw('LOWER(peran) = ?', ['penanggung jawab'])
                ->where($primaryKey, '!=', $petugas_fasilita)
                ->exists();

            if ($isPenanggungJawabLain) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->with('warning', 'Warga ini sudah menjadi Penanggung jawab di fasilitas lain');
            }
        }

        $petugasFasilitas->update([
            'fasilitas_id' => $request->fasilitas_id,
            'petugas_warga_id' => $request->petugas_warga_id,
            'peran' => $request->peran,
        ]);

        return redirect()
            ->route('petugas-fasilitas.index')
            ->with('success', 'Petugas fasilitas berhasil diperbarui');
    }

    public function destroy($petugas_fasilita)
    {
        $petugasFasilitas = PetugasFasilitas::findOrFail($petugas_fasilita);
        $petugasFasilitas->delete();

        return redirect()
            ->route('petugas-fasilitas.index')
            ->with('success', 'Petugas fasilitas berhasil dihapus');
    }

    // Helper method untuk menentukan primary key
    private function getPrimaryKeyColumn()
    {
        if (Schema::hasColumn('petugas_fasilitas', 'id')) {
            return 'id';
        } elseif (Schema::hasColumn('petugas_fasilitas', 'petugas_id')) {
            return 'petugas_id';
        } else {
            return 'id'; // default
        }
    }

    public function byFasilitas($fasilitas_id)
    {
        // Implementasi jika perlu
        return redirect()->route('petugas-fasilitas.index');
    }

    public function byWarga($warga_id)
    {
        // Implementasi jika perlu
        return redirect()->route('petugas-fasilitas.index');
    }
}

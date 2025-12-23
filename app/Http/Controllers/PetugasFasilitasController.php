<?php

namespace App\Http\Controllers;

use App\Models\PetugasFasilitas;
use App\Models\FasilitasUmum;
use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        // ORDER BY petugas_id sesuai struktur
        $petugasFasilitas = $query->orderBy('petugas_id', 'desc')->paginate(10);

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

        // SOLUSI: Gunakan DB::table untuk menghindari auto increment error
        try {
            // Coba dengan Eloquent dulu
            $petugasData = [
                'fasilitas_id' => $request->fasilitas_id,
                'petugas_warga_id' => $request->petugas_warga_id,
                'peran' => $request->peran,
            ];

            $petugas = PetugasFasilitas::create($petugasData);

            return redirect()
                ->route('petugas-fasilitas.index')
                ->with('success', 'Petugas fasilitas berhasil ditambahkan');

        } catch (\Exception $e) {
            // Jika error karena auto increment, gunakan DB::table
            if (strpos($e->getMessage(), "doesn't have a default value") !== false) {
                try {
                    $id = DB::table('petugas_fasilitas')->insertGetId([
                        'fasilitas_id' => $request->fasilitas_id,
                        'petugas_warga_id' => $request->petugas_warga_id,
                        'peran' => $request->peran,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);

                    return redirect()
                        ->route('petugas-fasilitas.index')
                        ->with('success', 'Petugas fasilitas berhasil ditambahkan');

                } catch (\Exception $e2) {
                    return redirect()
                        ->back()
                        ->withInput()
                        ->with('error', 'Gagal menyimpan: ' . $e2->getMessage());
                }
            }

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Gagal menyimpan: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $petugasFasilitas = PetugasFasilitas::with(['warga', 'fasilitas'])->findOrFail($id);

        return view('pages.petugasfasilitas.show', compact('petugasFasilitas'));
    }

    public function edit($id)
    {
        $petugasFasilitas = PetugasFasilitas::findOrFail($id);
        $fasilitasList = FasilitasUmum::orderBy('nama')->get();
        $wargaList = Warga::orderBy('nama')->get();

        return view(
            'pages.petugasfasilitas.edit',
            compact('petugasFasilitas', 'fasilitasList', 'wargaList')
        );
    }

    public function update(Request $request, $id)
    {
        $petugasFasilitas = PetugasFasilitas::findOrFail($id);

        $request->validate([
            'fasilitas_id' => 'required|exists:fasilitas_umum,fasilitas_id',
            'petugas_warga_id' => 'required|exists:warga,warga_id',
            'peran' => 'required|string|max:100',
        ]);

        // Cek duplikasi (kecuali data saat ini)
        if ($request->fasilitas_id != $petugasFasilitas->fasilitas_id ||
            $request->petugas_warga_id != $petugasFasilitas->petugas_warga_id) {

            $existing = PetugasFasilitas::where('fasilitas_id', $request->fasilitas_id)
                ->where('petugas_warga_id', $request->petugas_warga_id)
                ->where('petugas_id', '!=', $id)
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
                ->where('petugas_id', '!=', $id)
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
        $petugasFasilitas = PetugasFasilitas::findOrFail($id);
        $petugasFasilitas->delete();

        return redirect()
            ->route('petugas-fasilitas.index')
            ->with('success', 'Petugas fasilitas berhasil dihapus');
    }
}

<?php
namespace App\Http\Controllers;

use App\Models\FasilitasUmum;
use App\Models\SyaratFasilitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SyaratFasilitasController extends Controller
{
    public function index(Request $request)
    {
        $query = SyaratFasilitas::with('fasilitas');

        // filter fasilitas
        if ($request->filled('fasilitas_id')) {
            $query->where('fasilitas_id', $request->fasilitas_id);
        }

        // search
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('nama_syarat', 'like', '%' . $request->search . '%')
                    ->orWhere('deskripsi', 'like', '%' . $request->search . '%')
                    ->orWhereHas('fasilitas', function ($f) use ($request) {
                        $f->where('nama', 'like', '%' . $request->search . '%');
                    });
            });
        }

        $syaratFasilitas = $query->paginate(10);

        // 🔥 ambil fasilitas untuk dropdown filter
        $fasilitasList = FasilitasUmum::orderBy('nama')->get();

        return view(
            'pages.syaratfasilitas.index',
            compact('syaratFasilitas', 'fasilitasList')
        );
    }

    public function create()
    {
        $fasilitasList = FasilitasUmum::orderBy('nama')->get();

        return view(
            'pages.syaratfasilitas.create',
            compact('fasilitasList')
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'fasilitas_id'   => 'required|exists:fasilitas_umum,fasilitas_id',
            'nama_syarat'    => 'required|string|max:255',
            'deskripsi'      => 'nullable|string',
            'dokumen_syarat' => 'nullable|file|mimes:pdf,jpg,jpeg,png,doc,docx|max:2048',
        ]);

        $data = $request->only([
            'fasilitas_id',
            'nama_syarat',
            'deskripsi',
        ]);

        if ($request->hasFile('dokumen_syarat')) {
            $data['dokumen_syarat'] = $request
                ->file('dokumen_syarat')
                ->store('syarat_fasilitas', 'public');
        }

        SyaratFasilitas::create($data);

        return redirect()
            ->route('syarat-fasilitas.index')
            ->with('success', 'Syarat fasilitas berhasil ditambahkan');
    }

    public function edit($id)
    {
        $syaratFasilitas = SyaratFasilitas::findOrFail($id);

        $fasilitasList = FasilitasUmum::orderBy('nama')->get();

        return view(
            'pages.syaratfasilitas.edit',
            compact('syaratFasilitas', 'fasilitasList')
        );
    }

    public function update(Request $request, $id)
    {
        $syaratFasilitas = SyaratFasilitas::findOrFail($id);

        $request->validate([
            'fasilitas_id'   => 'required|exists:fasilitas_umum,fasilitas_id',
            'nama_syarat'    => 'required|string|max:255',
            'deskripsi'      => 'nullable|string',
            'dokumen_syarat' => 'nullable|file|mimes:pdf,jpg,jpeg,png,doc,docx|max:2048',
        ]);

        $data = $request->only([
            'fasilitas_id',
            'nama_syarat',
            'deskripsi',
        ]);

        if ($request->hasFile('dokumen_syarat')) {

            if (
                $syaratFasilitas->dokumen_syarat &&
                Storage::disk('public')->exists($syaratFasilitas->dokumen_syarat)
            ) {
                Storage::disk('public')->delete($syaratFasilitas->dokumen_syarat);
            }

            $data['dokumen_syarat'] = $request
                ->file('dokumen_syarat')
                ->store('syarat_fasilitas', 'public');
        }

        $syaratFasilitas->update($data);

        return redirect()
            ->route('syarat-fasilitas.index')
            ->with('success', 'Syarat fasilitas berhasil diperbarui');
    }

    public function destroy($id)
    {
        $syaratFasilitas = SyaratFasilitas::findOrFail($id);

        if (
            $syaratFasilitas->dokumen_syarat &&
            Storage::disk('public')->exists($syaratFasilitas->dokumen_syarat)
        ) {
            Storage::disk('public')->delete($syaratFasilitas->dokumen_syarat);
        }

        $syaratFasilitas->delete();

        return redirect()
            ->route('syarat-fasilitas.index')
            ->with('success', 'Syarat fasilitas berhasil dihapus');
    }

    public function downloadDokumen($id)
    {
        $syaratFasilitas = SyaratFasilitas::findOrFail($id);

        if (! $syaratFasilitas->dokumen_syarat) {
            return redirect()->back()->with('error', 'Dokumen tidak tersedia');
        }

        return Storage::disk('public')->download($syaratFasilitas->dokumen_syarat);
    }
}

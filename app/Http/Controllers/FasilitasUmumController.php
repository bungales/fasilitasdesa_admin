<?php

namespace App\Http\Controllers;

use App\Models\FasilitasUmum;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class FasilitasUmumController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $filterJenis = $request->jenis;

        $query = FasilitasUmum::query();

        if ($search) {
            $query->where('nama', 'like', "%$search%")
                  ->orWhere('alamat', 'like', "%$search%");
        }

        if ($filterJenis) {
            $query->where('jenis', $filterJenis);
        }

        $fasilitas = $query->orderBy('fasilitas_id', 'DESC')->paginate(10);

        return view('pages.fasilitasumum.index', compact('fasilitas', 'search', 'filterJenis'));
    }

    public function create()
    {
        return view('pages.fasilitasumum.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jenis' => 'required|string|max:100',
            'alamat' => 'required|string',
            'rt' => 'required|string|max:10',
            'rw' => 'required|string|max:10',
            'kapasitas' => 'required|integer|min:1',
            'files.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048',
            'captions.*' => 'nullable|string|max:255',
        ]);

        $fasilitas = FasilitasUmum::create($request->all());

        if ($request->hasFile('files')) {
            $this->uploadFiles($request, $fasilitas->fasilitas_id);
        }

        return redirect()
            ->route('fasilitasumum.index')
            ->with('success', 'Data fasilitas umum berhasil ditambahkan!');
    }

    public function show(FasilitasUmum $fasilitasumum)
    {
        $media = Media::where('ref_table', 'fasilitas_umum')
            ->where('ref_id', $fasilitasumum->fasilitas_id)
            ->orderBy('sort_order')
            ->get();

        return view('pages.fasilitasumum.show', compact('fasilitasumum', 'media'));
    }

    public function edit(FasilitasUmum $fasilitasumum)
    {
        $media = Media::where('ref_table', 'fasilitas_umum')
            ->where('ref_id', $fasilitasumum->fasilitas_id)
            ->orderBy('sort_order')
            ->get();

        return view('pages.fasilitasumum.edit', compact('fasilitasumum', 'media'));
    }

    public function update(Request $request, FasilitasUmum $fasilitasumum)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jenis' => 'required|string|max:100',
            'alamat' => 'required|string',
            'rt' => 'required|string|max:10',
            'rw' => 'required|string|max:10',
            'kapasitas' => 'required|integer|min:1',
            'files.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048',
            'captions.*' => 'nullable|string|max:255',
            'existing_captions.*' => 'nullable|string|max:255',
        ]);

        $fasilitasumum->update($request->all());

        if ($request->has('existing_captions')) {
            foreach ($request->existing_captions as $mediaId => $caption) {
                Media::where('media_id', $mediaId)
                    ->update(['caption' => $caption]);
            }
        }

        if ($request->hasFile('files')) {
            $this->uploadFiles($request, $fasilitasumum->fasilitas_id);
        }

        return redirect()
            ->route('fasilitasumum.index')
            ->with('success', 'Data fasilitas umum berhasil diperbarui!');
    }

    public function destroy(FasilitasUmum $fasilitasumum)
    {
        $this->deleteMediaFiles($fasilitasumum->fasilitas_id);
        $fasilitasumum->delete();

        return redirect()
            ->route('fasilitasumum.index')
            ->with('success', 'Data fasilitas umum berhasil dihapus!');
    }

    public function deleteMedia($fasilitasId, $mediaId)
    {
        $media = Media::where('media_id', $mediaId)
            ->where('ref_id', $fasilitasId)
            ->firstOrFail();

        Storage::disk('public')->delete('uploads/fasilitas_umum/' . $media->file_name);

        $media->delete();

        return response()->json([
            'success' => true,
            'message' => 'File berhasil dihapus',
        ]);
    }

    /* ==========================================================
       ========== HELPER METHOD (STORAGE PUBLIC) =================
       ========================================================== */

    private function uploadFiles(Request $request, $fasilitasId)
    {
        $sortOrder = Media::where('ref_table', 'fasilitas_umum')
            ->where('ref_id', $fasilitasId)
            ->max('sort_order') ?? 0;

        foreach ($request->file('files') as $index => $file) {
            if ($file->isValid()) {

                $originalName = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();

                $fileName =
                    time() . '_' .
                    Str::random(10) . '_' .
                    Str::slug(pathinfo($originalName, PATHINFO_FILENAME)) .
                    '.' . $extension;

                // SIMPAN KE storage/app/public/uploads/fasilitas_umum
                Storage::disk('public')->putFileAs(
                    'uploads/fasilitas_umum',
                    $file,
                    $fileName
                );

                Media::create([
                    'ref_table'     => 'fasilitas_umum',
                    'ref_id'        => $fasilitasId,
                    'file_name'     => $fileName,
                    'original_name' => $originalName,
                    'caption'       => $request->captions[$index] ?? null,
                    'mime_type'     => $file->getMimeType(),
                    'file_size'     => $file->getSize(),
                    'sort_order'    => ++$sortOrder,
                ]);
            }
        }
    }

    private function deleteMediaFiles($fasilitasId)
    {
        $mediaFiles = Media::where('ref_table', 'fasilitas_umum')
            ->where('ref_id', $fasilitasId)
            ->get();

        foreach ($mediaFiles as $media) {
            Storage::disk('public')->delete('uploads/fasilitas_umum/' . $media->file_name);
            $media->delete();
        }
    }
}

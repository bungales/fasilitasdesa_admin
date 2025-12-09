<?php

namespace App\Http\Controllers;

use App\Models\FasilitasUmum;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FasilitasUmumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // SEARCH
        $search = $request->search;

        // FILTER JENIS
        $filterJenis = $request->jenis;

        // Query dasar
        $query = FasilitasUmum::query();

        // Jika search
        if ($search) {
            $query->where('nama', 'like', "%$search%")
                  ->orWhere('alamat', 'like', "%$search%");
        }

        // Jika filter jenis
        if ($filterJenis) {
            $query->where('jenis', $filterJenis);
        }

        // Pagination
        $fasilitas = $query->orderBy('fasilitas_id', 'DESC')->paginate(10);

        return view('pages.fasilitasumum.index', compact('fasilitas', 'search', 'filterJenis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.fasilitasumum.create');
    }

    /**
     * Store a newly created resource in storage.
     */
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
            'captions.*' => 'nullable|string|max:255'
        ]);

        // Simpan data fasilitas
        $fasilitas = FasilitasUmum::create($request->all());

        // Upload multiple files
        if ($request->hasFile('files')) {
            $this->uploadFiles($request, $fasilitas->fasilitas_id);
        }

        return redirect()->route('fasilitasumum.index')->with('success', 'Data fasilitas umum berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(FasilitasUmum $fasilitasumum)
    {
        $media = Media::where('ref_table', 'fasilitas_umum')
                     ->where('ref_id', $fasilitasumum->fasilitas_id)
                     ->orderBy('sort_order')
                     ->get();

        return view('pages.fasilitasumum.show', compact('fasilitasumum', 'media'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FasilitasUmum $fasilitasumum)
    {
        // Ambil semua media yang terkait dengan fasilitas ini
        $media = Media::where('ref_table', 'fasilitas_umum')
                     ->where('ref_id', $fasilitasumum->fasilitas_id)
                     ->orderBy('sort_order')
                     ->get();

        return view('pages.fasilitasumum.edit', compact('fasilitasumum', 'media'));
    }

    /**
     * Update the specified resource in storage.
     */
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
            'existing_captions.*' => 'nullable|string|max:255'
        ]);

        // Update data fasilitas
        $fasilitasumum->update($request->all());

        // Update captions untuk file yang sudah ada
        if ($request->has('existing_captions')) {
            foreach ($request->existing_captions as $mediaId => $caption) {
                Media::where('media_id', $mediaId)
                    ->where('ref_table', 'fasilitas_umum')
                    ->where('ref_id', $fasilitasumum->fasilitas_id)
                    ->update(['caption' => $caption]);
            }
        }

        // Upload file baru
        if ($request->hasFile('files')) {
            $this->uploadFiles($request, $fasilitasumum->fasilitas_id);
        }

        return redirect()->route('fasilitasumum.index')->with('success', 'Data fasilitas umum berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FasilitasUmum $fasilitasumum)
    {
        // Hapus semua file media terkait
        $this->deleteMediaFiles('fasilitas_umum', $fasilitasumum->fasilitas_id);

        // Hapus data fasilitas
        $fasilitasumum->delete();

        return redirect()->route('fasilitasumum.index')->with('success', 'Data fasilitas umum berhasil dihapus!');
    }

    /**
     * Hapus file media individual.
     */
    public function deleteMedia($fasilitasId, $mediaId)
    {
        $media = Media::where('media_id', $mediaId)
                     ->where('ref_table', 'fasilitas_umum')
                     ->where('ref_id', $fasilitasId)
                     ->firstOrFail();

        // Hapus file dari storage
        Storage::delete('public/uploads/fasilitas_umum/' . $media->file_name);

        // Hapus record dari database
        $media->delete();

        return response()->json(['success' => true, 'message' => 'File berhasil dihapus']);
    }

    /**
     * Helper function untuk upload multiple files
     */
    private function uploadFiles(Request $request, $fasilitasId)
    {
        $uploadPath = 'public/uploads/fasilitas_umum';

        // Buat folder jika belum ada
        if (!Storage::exists($uploadPath)) {
            Storage::makeDirectory($uploadPath);
        }

        // Ambil sort_order tertinggi untuk melanjutkan numbering
        $sortOrder = Media::where('ref_table', 'fasilitas_umum')
                         ->where('ref_id', $fasilitasId)
                         ->max('sort_order') ?? 0;

        foreach ($request->file('files') as $index => $file) {
            if ($file->isValid()) {
                // Generate nama file unik
                $originalName = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $fileName = time() . '_' . Str::random(10) . '_' . Str::slug(pathinfo($originalName, PATHINFO_FILENAME)) . '.' . $extension;

                // Simpan file ke storage
                $file->storeAs($uploadPath, $fileName);

                // Simpan data ke tabel media
                Media::create([
                    'ref_table' => 'fasilitas_umum',
                    'ref_id' => $fasilitasId,
                    'file_name' => $fileName,
                    'original_name' => $originalName,
                    'caption' => $request->captions[$index] ?? null,
                    'mime_type' => $file->getMimeType(),
                    'file_size' => $file->getSize(),
                    'sort_order' => ++$sortOrder,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }
    }

    /**
     * Helper function untuk menghapus semua file media
     */
    private function deleteMediaFiles($refTable, $refId)
    {
        $mediaFiles = Media::where('ref_table', $refTable)
                          ->where('ref_id', $refId)
                          ->get();

        foreach ($mediaFiles as $media) {
            // Hapus file dari storage
            Storage::delete('public/uploads/fasilitas_umum/' . $media->file_name);

            // Hapus record dari database
            $media->delete();
        }
    }

    /**
     * Reorder media files
     */
    public function reorderMedia(Request $request)
    {
        $request->validate([
            'media_ids' => 'required|array',
            'media_ids.*' => 'integer|exists:media,media_id'
        ]);

        foreach ($request->media_ids as $index => $mediaId) {
            Media::where('media_id', $mediaId)
                ->where('ref_table', 'fasilitas_umum')
                ->update(['sort_order' => $index + 1]);
        }

        return response()->json(['success' => true, 'message' => 'Urutan file berhasil diperbarui']);
    }
}

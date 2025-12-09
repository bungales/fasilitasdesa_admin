<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Filter berdasarkan tabel referensi
        $refTable = $request->ref_table;
        $refId = $request->ref_id;

        $query = Media::query();

        if ($refTable) {
            $query->where('ref_table', $refTable);
        }

        if ($refId) {
            $query->where('ref_id', $refId);
        }

        $media = $query->orderBy('created_at', 'DESC')->paginate(20);

        return view('pages.media.index', compact('media', 'refTable', 'refId'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Form upload langsung dari halaman terkait (fasilitas, berita, dll)
        // Tidak perlu view khusus create
        return back()->with('error', 'Gunakan form upload di halaman masing-masing');
    }

    /**
     * Store a newly created resource.
     */
    public function store(Request $request)
    {
        $request->validate([
            'ref_table' => 'required|string|max:100',
            'ref_id' => 'required|integer',
            'files' => 'required|array',
            'files.*' => 'file|mimes:jpg,jpeg,png,gif,pdf,doc,docx,xls,xlsx|max:5120',
            'captions' => 'nullable|array',
            'captions.*' => 'nullable|string|max:255'
        ]);

        $uploadedFiles = [];
        $refTable = $request->ref_table;
        $refId = $request->ref_id;

        // Buat folder berdasarkan ref_table
        $uploadPath = 'public/uploads/' . $refTable;

        if (!Storage::exists($uploadPath)) {
            Storage::makeDirectory($uploadPath);
        }

        // Get current sort order
        $sortOrder = Media::where('ref_table', $refTable)
                         ->where('ref_id', $refId)
                         ->max('sort_order') ?? 0;

        foreach ($request->file('files') as $index => $file) {
            if ($file->isValid()) {
                // Generate nama file unik
                $originalName = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $fileName = time() . '_' . Str::random(10) . '.' . $extension;

                // Simpan file
                $file->storeAs($uploadPath, $fileName);

                // Simpan ke database
                $media = Media::create([
                    'ref_table' => $refTable,
                    'ref_id' => $refId,
                    'file_name' => $fileName,
                    'caption' => $request->captions[$index] ?? null,
                    'mime_type' => $file->getMimeType(),
                    'sort_order' => ++$sortOrder
                ]);

                $uploadedFiles[] = $media;
            }
        }

        if (empty($uploadedFiles)) {
            return back()->with('error', 'Tidak ada file yang berhasil diupload');
        }

        return back()->with('success', count($uploadedFiles) . ' file berhasil diupload');
    }

    /**
     * Display the specified resource.
     */
    public function show(Media $media)
    {
        // Tampilkan detail media
        $fileUrl = asset('storage/uploads/' . $media->ref_table . '/' . $media->file_name);

        return view('pages.media.show', compact('media', 'fileUrl'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Media $media)
    {
        return view('pages.media.edit', compact('media'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Media $media)
    {
        $request->validate([
            'caption' => 'nullable|string|max:255',
            'sort_order' => 'integer|min:0'
        ]);

        $media->update($request->only(['caption', 'sort_order']));

        return back()->with('success', 'Data media berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Media $media)
    {
        // Hapus file dari storage
        $filePath = 'public/uploads/' . $media->ref_table . '/' . $media->file_name;

        if (Storage::exists($filePath)) {
            Storage::delete($filePath);
        }

        // Hapus dari database
        $media->delete();

        return back()->with('success', 'File berhasil dihapus');
    }

    /**
     * Upload multiple files via AJAX
     */
    public function uploadAjax(Request $request)
    {
        $request->validate([
            'ref_table' => 'required|string|max:100',
            'ref_id' => 'required|integer',
            'file' => 'required|file|mimes:jpg,jpeg,png,gif,pdf,doc,docx|max:5120',
            'caption' => 'nullable|string|max:255'
        ]);

        $file = $request->file('file');
        $refTable = $request->ref_table;
        $refId = $request->ref_id;

        // Buat folder jika belum ada
        $uploadPath = 'public/uploads/' . $refTable;
        if (!Storage::exists($uploadPath)) {
            Storage::makeDirectory($uploadPath);
        }

        // Generate nama file
        $originalName = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $fileName = time() . '_' . Str::random(10) . '.' . $extension;

        // Simpan file
        $file->storeAs($uploadPath, $fileName);

        // Get sort order
        $sortOrder = Media::where('ref_table', $refTable)
                         ->where('ref_id', $refId)
                         ->max('sort_order') ?? 0;

        // Simpan ke database
        $media = Media::create([
            'ref_table' => $refTable,
            'ref_id' => $refId,
            'file_name' => $fileName,
            'caption' => $request->caption,
            'mime_type' => $file->getMimeType(),
            'sort_order' => $sortOrder + 1
        ]);

        return response()->json([
            'success' => true,
            'media' => $media,
            'file_url' => asset('storage/uploads/' . $refTable . '/' . $fileName)
        ]);
    }

    /**
     * Reorder media files
     */
    public function reorder(Request $request)
    {
        $request->validate([
            'media_ids' => 'required|array',
            'media_ids.*' => 'integer|exists:media,media_id'
        ]);

        foreach ($request->media_ids as $index => $mediaId) {
            Media::where('media_id', $mediaId)->update(['sort_order' => $index + 1]);
        }

        return response()->json(['success' => true]);
    }

    /**
     * Get media by reference
     */
    public function getByReference($refTable, $refId)
    {
        $media = Media::where('ref_table', $refTable)
                     ->where('ref_id', $refId)
                     ->orderBy('sort_order')
                     ->get();

        return response()->json($media);
    }
}

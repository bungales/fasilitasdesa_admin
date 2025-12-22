<?php

namespace App\Http\Controllers;

use App\Models\PembayaranFasilitas;
use App\Models\PeminjamanFasilitas;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PembayaranFasilitasController extends Controller
{
    public function index(Request $request)
    {
        // SEARCH
        $search = $request->search;

        // FILTER METODE (opsional)
        $filterMetode = $request->metode;

        // Query dasar
        $query = PembayaranFasilitas::with(['peminjaman.warga', 'peminjaman.fasilitas', 'media']);

        // SEARCH
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->whereHas('peminjaman.warga', function ($w) use ($search) {
                    $w->where('nama', 'like', "%$search%");
                })
                ->orWhereHas('peminjaman.fasilitas', function ($f) use ($search) {
                    $f->where('nama', 'like', "%$search%");
                })
                ->orWhere('keterangan', 'like', "%$search%")
                ->orWhere('metode', 'like', "%$search%");
            });
        }

        // FILTER METODE
        if ($filterMetode) {
            $query->where('metode', $filterMetode);
        }

        // PAGINATION
        $pembayaran = $query->orderBy('bayar_id', 'DESC')->paginate(10);

        return view('pages.pembayaranfasilitas.index', compact(
            'pembayaran',
            'search',
            'filterMetode'
        ));
    }

    public function create()
    {
        $peminjaman = PeminjamanFasilitas::with('warga', 'fasilitas')->get();
        return view('pages.pembayaranfasilitas.create', compact('peminjaman'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pinjam_id' => 'required',
            'tanggal'   => 'required|date',
            'jumlah'    => 'required|numeric',
            'metode'    => 'required',
            'keterangan' => 'nullable',
            'files' => 'nullable|array',
            'files.*' => 'file|mimes:jpg,jpeg,png,pdf',
            'captions' => 'nullable|array',
            'captions.*' => 'nullable|string|max:255'
        ]);

        // Simpan pembayaran
        $pembayaran = PembayaranFasilitas::create($request->only([
            'pinjam_id', 'tanggal', 'jumlah', 'metode', 'keterangan'
        ]));

        // Upload media jika ada
        if ($request->hasFile('files')) {
            $uploadPath = 'pembayaran_fasilitas';

            // Buat folder jika belum ada
            if (!Storage::disk('public')->exists($uploadPath)) {
                Storage::disk('public')->makeDirectory($uploadPath);
            }

            $sortOrder = Media::where('ref_table', 'pembayaran_fasilitas')
                             ->where('ref_id', $pembayaran->bayar_id)
                             ->max('sort_order') ?? 0;

            foreach ($request->file('files') as $index => $file) {
                if ($file->isValid()) {
                    $originalName = $file->getClientOriginalName();
                    $extension = $file->getClientOriginalExtension();
                    $fileName = time() . '_' . Str::random(10) . '.' . $extension;

                    // Simpan file ke storage public
                    $file->storeAs($uploadPath, $fileName, 'public');

                    // Simpan ke database
                    Media::create([
                        'ref_table' => 'pembayaran_fasilitas',
                        'ref_id' => $pembayaran->bayar_id,
                        'file_name' => $fileName,
                        'caption' => $request->captions[$index] ?? null,
                        'mime_type' => $file->getMimeType(),
                        'sort_order' => ++$sortOrder
                    ]);
                }
            }
        }

        return redirect()->route('pembayaran.index')
            ->with('success', 'Pembayaran berhasil ditambahkan!');
    }

    public function show($id)
    {
        $pembayaran = PembayaranFasilitas::with([
            'peminjaman.warga',
            'peminjaman.fasilitas',
            'media'
        ])->findOrFail($id);

        return view('pages.pembayaranfasilitas.show', compact('pembayaran'));
    }

    public function edit(PembayaranFasilitas $pembayaran)
    {
        $peminjaman = PeminjamanFasilitas::with('warga', 'fasilitas')->get();
        $media = $pembayaran->media;

        return view('pages.pembayaranfasilitas.edit', compact('pembayaran', 'peminjaman', 'media'));
    }

    public function update(Request $request, $id)
    {
        $pembayaran = PembayaranFasilitas::findOrFail($id);

        $request->validate([
            'pinjam_id' => 'required',
            'tanggal'   => 'required|date',
            'jumlah'    => 'required|numeric',
            'metode'    => 'required',
            'keterangan' => 'nullable',
            'files' => 'nullable|array',
            'files.*' => 'file|mimes:jpg,jpeg,png,pdf',
            'captions' => 'nullable|array',
            'captions.*' => 'nullable|string|max:255'
        ]);

        // Update data pembayaran
        $pembayaran->update($request->only([
            'pinjam_id', 'tanggal', 'jumlah', 'metode', 'keterangan'
        ]));

        // Upload media baru jika ada
        if ($request->hasFile('files')) {
            $uploadPath = 'pembayaran_fasilitas';

            // Buat folder jika belum ada
            if (!Storage::disk('public')->exists($uploadPath)) {
                Storage::disk('public')->makeDirectory($uploadPath);
            }

            $sortOrder = Media::where('ref_table', 'pembayaran_fasilitas')
                             ->where('ref_id', $pembayaran->bayar_id)
                             ->max('sort_order') ?? 0;

            foreach ($request->file('files') as $index => $file) {
                if ($file->isValid()) {
                    $originalName = $file->getClientOriginalName();
                    $extension = $file->getClientOriginalExtension();
                    $fileName = time() . '_' . Str::random(10) . '.' . $extension;

                    // Simpan file ke storage public
                    $file->storeAs($uploadPath, $fileName, 'public');

                    // Simpan ke database
                    Media::create([
                        'ref_table' => 'pembayaran_fasilitas',
                        'ref_id' => $pembayaran->bayar_id,
                        'file_name' => $fileName,
                        'caption' => $request->captions[$index] ?? null,
                        'mime_type' => $file->getMimeType(),
                        'sort_order' => ++$sortOrder
                    ]);
                }
            }
        }

        return redirect()->route('pembayaran.show', $pembayaran->bayar_id)
            ->with('success', 'Pembayaran berhasil diperbarui!');
    }

    public function destroy(PembayaranFasilitas $pembayaran)
    {
        // Hapus semua media terkait
        foreach ($pembayaran->media as $media) {
            // Hapus file dari storage
            $filePath = 'pembayaran_fasilitas/' . $media->file_name;
            if (Storage::disk('public')->exists($filePath)) {
                Storage::disk('public')->delete($filePath);
            }
            // Hapus dari database
            $media->delete();
        }

        // Hapus pembayaran
        $pembayaran->delete();

        return redirect()->route('pembayaran.index')
            ->with('success', 'Pembayaran berhasil dihapus!');
    }

    // Method untuk menghapus media
    public function deleteMedia($bayarId, $mediaId)
    {
        $media = Media::where('ref_table', 'pembayaran_fasilitas')
                     ->where('ref_id', $bayarId)
                     ->where('media_id', $mediaId)
                     ->firstOrFail();

        // Hapus file dari storage
        $filePath = 'pembayaran_fasilitas/' . $media->file_name;
        if (Storage::disk('public')->exists($filePath)) {
            Storage::disk('public')->delete($filePath);
        }

        // Hapus dari database
        $media->delete();

        return back()->with('success', 'File berhasil dihapus');
    }

    // Method khusus untuk upload media dari halaman detail
    public function uploadMedia(Request $request, $id)
    {
        $pembayaran = PembayaranFasilitas::findOrFail($id);

        $request->validate([
            'files' => 'required',
            'files.*' => 'file|mimes:jpg,jpeg,png,pdf',
        ]);

        $uploadPath = 'pembayaran_fasilitas';

        // Buat folder jika belum ada
        if (!Storage::disk('public')->exists($uploadPath)) {
            Storage::disk('public')->makeDirectory($uploadPath);
        }

        $sortOrder = Media::where('ref_table', 'pembayaran_fasilitas')
                         ->where('ref_id', $pembayaran->bayar_id)
                         ->max('sort_order') ?? 0;

        $uploadedCount = 0;

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $index => $file) {
                if ($file->isValid()) {
                    $originalName = $file->getClientOriginalName();
                    $extension = $file->getClientOriginalExtension();
                    $fileName = time() . '_' . Str::random(10) . '.' . $extension;

                    // Simpan file ke storage public
                    $file->storeAs($uploadPath, $fileName, 'public');

                    // Simpan ke database
                    Media::create([
                        'ref_table' => 'pembayaran_fasilitas',
                        'ref_id' => $pembayaran->bayar_id,
                        'file_name' => $fileName,
                        'caption' => $request->captions[$index] ?? null,
                        'mime_type' => $file->getMimeType(),
                        'sort_order' => ++$sortOrder
                    ]);

                    $uploadedCount++;
                }
            }
        }

        if ($uploadedCount > 0) {
            return back()->with('success', $uploadedCount . ' file berhasil diupload!');
        }

        return back()->with('error', 'Tidak ada file yang berhasil diupload');
    }
}

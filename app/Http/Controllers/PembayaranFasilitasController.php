<?php

namespace App\Http\Controllers;

use App\Models\PembayaranFasilitas;
use App\Models\PeminjamanFasilitas;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PembayaranFasilitasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;

        $query = PembayaranFasilitas::with([
            'peminjaman.warga',
            'peminjaman.fasilitas',
            'media'
        ]);

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

        $pembayaran = $query->orderBy('bayar_id', 'DESC')->paginate(10);

        return view('pages.pembayaranfasilitas.index', compact('pembayaran', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $peminjaman = PeminjamanFasilitas::with(['warga', 'fasilitas'])
            ->where('status', '!=', 'dibatalkan')
            ->whereDoesntHave('pembayaran')
            ->get();

        return view('pages.pembayaranfasilitas.create', compact('peminjaman'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'pinjam_id' => 'required|exists:peminjaman_fasilitas,pinjam_id',
            'tanggal'   => 'required|date',
            'jumlah'    => 'required|numeric|min:0',
            'metode'    => 'required|string',
            'files.*'   => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'captions.*'=> 'nullable|string|max:255',
        ]);

        $pembayaran = PembayaranFasilitas::create([
            'pinjam_id'  => $request->pinjam_id,
            'tanggal'    => $request->tanggal,
            'jumlah'     => $request->jumlah,
            'metode'     => $request->metode,
            'keterangan' => $request->keterangan,
        ]);

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $index => $file) {
                $fileName = time().'_'.uniqid().'.'.$file->getClientOriginalExtension();
                $path = 'uploads/pembayaran_fasilitas/';

                // Simpan file
                $file->storeAs($path, $fileName, 'public');

                // SESUAIKAN dengan struktur Media Anda
                Media::create([
                    'ref_table'     => 'pembayaran_fasilitas',
                    'ref_id'        => $pembayaran->bayar_id,
                    'file_name'     => $fileName,
                    'original_name' => $file->getClientOriginalName(),
                    'mime_type'     => $file->getMimeType(),
                    'size'          => $file->getSize(),
                    'caption'       => $request->captions[$index] ?? null,
                    'path'          => $path.$fileName,
                ]);
            }
        }

        return redirect()->route('pembayaran.index')
            ->with('success', 'Pembayaran berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $pembayaran = PembayaranFasilitas::with([
            'peminjaman.warga',
            'peminjaman.fasilitas',
            'media'
        ])->findOrFail($id);

        return view('pages.pembayaranfasilitas.show', compact('pembayaran'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pembayaran = PembayaranFasilitas::with('media')->findOrFail($id);
        $peminjaman = PeminjamanFasilitas::with(['warga', 'fasilitas'])->get();

        return view('pages.pembayaranfasilitas.edit', compact('pembayaran', 'peminjaman'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'pinjam_id' => 'required|exists:peminjaman_fasilitas,pinjam_id',
            'tanggal'   => 'required|date',
            'jumlah'    => 'required|numeric|min:0',
            'metode'    => 'required|string',
            'files.*'   => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'captions.*'=> 'nullable|string|max:255',
        ]);

        $pembayaran = PembayaranFasilitas::findOrFail($id);

        $pembayaran->update([
            'pinjam_id'  => $request->pinjam_id,
            'tanggal'    => $request->tanggal,
            'jumlah'     => $request->jumlah,
            'metode'     => $request->metode,
            'keterangan' => $request->keterangan,
        ]);

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $index => $file) {
                $fileName = time().'_'.uniqid().'.'.$file->getClientOriginalExtension();
                $path = 'uploads/pembayaran_fasilitas/';

                // Simpan file
                $file->storeAs($path, $fileName, 'public');

                Media::create([
                    'ref_table'     => 'pembayaran_fasilitas',
                    'ref_id'        => $pembayaran->bayar_id,
                    'file_name'     => $fileName,
                    'original_name' => $file->getClientOriginalName(),
                    'mime_type'     => $file->getMimeType(),
                    'size'          => $file->getSize(),
                    'caption'       => $request->captions[$index] ?? null,
                    'path'          => $path.$fileName,
                ]);
            }
        }

        return redirect()->route('pembayaran.show', $id)
            ->with('success', 'Pembayaran berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pembayaran = PembayaranFasilitas::with('media')->findOrFail($id);

        foreach ($pembayaran->media as $media) {
            // Cek jika path tidak null atau kosong sebelum menghapus
            if (!empty($media->path)) {
                Storage::disk('public')->delete($media->path);
            }
            $media->delete();
        }

        $pembayaran->delete();

        return redirect()->route('pembayaran.index')
            ->with('success', 'Pembayaran berhasil dihapus');
    }

    /**
     * Delete media dari pembayaran
     */
    public function deleteMedia($id, $mediaId)
    {
        $media = Media::where('ref_table', 'pembayaran_fasilitas')
            ->where('ref_id', $id)
            ->findOrFail($mediaId);

        // Cek jika path tidak null atau kosong sebelum menghapus
        if (!empty($media->path)) {
            Storage::disk('public')->delete($media->path);
        }

        $media->delete();

        return back()->with('success', 'File berhasil dihapus');
    }

    /**
     * Upload media tambahan untuk pembayaran yang sudah ada
     */
    public function uploadMedia(Request $request, $id)
    {
        $request->validate([
            'files.*'   => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'captions.*'=> 'nullable|string|max:255',
        ]);

        $pembayaran = PembayaranFasilitas::findOrFail($id);

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $index => $file) {
                $fileName = time().'_'.uniqid().'.'.$file->getClientOriginalExtension();
                $path = 'uploads/pembayaran_fasilitas/';

                // Simpan file
                $file->storeAs($path, $fileName, 'public');

                Media::create([
                    'ref_table'     => 'pembayaran_fasilitas',
                    'ref_id'        => $pembayaran->bayar_id,
                    'file_name'     => $fileName,
                    'original_name' => $file->getClientOriginalName(),
                    'mime_type'     => $file->getMimeType(),
                    'size'          => $file->getSize(),
                    'caption'       => $request->captions[$index] ?? null,
                    'path'          => $path.$fileName,
                ]);
            }
        }

        return back()->with('success', 'File berhasil diupload');
    }
}

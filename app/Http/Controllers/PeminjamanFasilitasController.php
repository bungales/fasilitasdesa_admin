<?php

namespace App\Http\Controllers;

use App\Models\PeminjamanFasilitas;
use App\Models\FasilitasUmum;
use App\Models\Warga;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PeminjamanFasilitasController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $filterStatus = $request->status;
        $month = $request->month;

        $query = PeminjamanFasilitas::with(['fasilitas', 'warga'])->withCount('media');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->whereHas('warga', function ($w) use ($search) {
                    $w->where('nama', 'like', "%$search%");
                    if (\Schema::hasColumn('warga', 'nik')) {
                        $w->orWhere('nik', 'like', "%$search%");
                    } elseif (\Schema::hasColumn('warga', 'no_identitas')) {
                        $w->orWhere('no_identitas', 'like', "%$search%");
                    }
                })
                ->orWhereHas('fasilitas', function ($f) use ($search) {
                    $f->where('nama', 'like', "%$search%")
                      ->orWhere('jenis', 'like', "%$search%");
                })
                ->orWhere('tujuan', 'like', "%$search%")
                ->orWhere('status', 'like', "%$search%");
            });
        }

        if ($filterStatus) {
            $query->where('status', $filterStatus);
        }

        if ($month) {
            $query->whereYear('tanggal_mulai', Carbon::parse($month)->year)
                  ->whereMonth('tanggal_mulai', Carbon::parse($month)->month);
        }

        $peminjaman = $query->orderBy('pinjam_id', 'DESC')->paginate(10);

        $total = PeminjamanFasilitas::count();
        $waiting = PeminjamanFasilitas::where('status', 'Menunggu')->count();
        $approved = PeminjamanFasilitas::where('status', 'Disetujui')->count();
        $rejected = PeminjamanFasilitas::where('status', 'Ditolak')->count();

        return view('pages.peminjamanfasilitas.index', compact(
            'peminjaman',
            'search',
            'filterStatus',
            'total',
            'waiting',
            'approved',
            'rejected'
        ));
    }

    public function create()
    {
        $fasilitas = FasilitasUmum::orderBy('nama')->get();
        $warga = Warga::orderBy('nama')->get();

        return view('pages.peminjamanfasilitas.create', compact('fasilitas', 'warga'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'fasilitas_id' => 'required|exists:fasilitas_umum,fasilitas_id',
            'warga_id' => 'required|exists:warga,warga_id',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'tujuan' => 'required|string|max:500',
            'status' => 'required|in:Menunggu,Disetujui,Ditolak,Selesai',
            'total_biaya' => 'required|numeric|min:0',
            'catatan' => 'nullable|string|max:1000',
        ]);

        $data = $request->all();
        $data['tanggal_mulai'] = Carbon::parse($request->tanggal_mulai)->format('Y-m-d');
        $data['tanggal_selesai'] = Carbon::parse($request->tanggal_selesai)->format('Y-m-d');

        PeminjamanFasilitas::create($data);

        return redirect()->route('peminjaman.index')
            ->with('success', 'Peminjaman fasilitas berhasil ditambahkan!');
    }

    public function show($id)
    {
        $peminjaman = PeminjamanFasilitas::with(['fasilitas', 'warga', 'media'])->findOrFail($id);
        return view('pages.peminjamanfasilitas.show', compact('peminjaman'));
    }

    public function edit($id)
    {
        $peminjaman = PeminjamanFasilitas::with(['fasilitas', 'warga', 'media'])->findOrFail($id);
        $fasilitas = FasilitasUmum::orderBy('nama')->get();
        $warga = Warga::orderBy('nama')->get();
        $media = $peminjaman->media;

        return view('pages.peminjamanfasilitas.edit', compact('peminjaman', 'fasilitas', 'warga', 'media'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'fasilitas_id' => 'required|exists:fasilitas_umum,fasilitas_id',
            'warga_id' => 'required|exists:warga,warga_id',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'tujuan' => 'required|string|max:500',
            'status' => 'required|in:Menunggu,Disetujui,Ditolak,Selesai',
            'total_biaya' => 'required|numeric|min:0',
            'catatan' => 'nullable|string|max:1000',
        ]);

        $peminjaman = PeminjamanFasilitas::findOrFail($id);

        $data = $request->all();
        $data['tanggal_mulai'] = Carbon::parse($request->tanggal_mulai)->format('Y-m-d');
        $data['tanggal_selesai'] = Carbon::parse($request->tanggal_selesai)->format('Y-m-d');

        $peminjaman->update($data);

        return redirect()->route('peminjaman.index')
            ->with('success', 'Peminjaman fasilitas berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $peminjaman = PeminjamanFasilitas::with('media')->findOrFail($id);

        foreach ($peminjaman->media as $media) {
            Storage::disk('public')->delete('uploads/peminjaman_fasilitas/' . $media->file_name);
            $media->delete();
        }

        $peminjaman->delete();

        return redirect()->route('peminjaman.index')
            ->with('success', 'Peminjaman fasilitas berhasil dihapus!');
    }

    // ================= UPLOAD MEDIA =================
    public function uploadMedia(Request $request, $id)
    {
        $request->validate([
            'files' => 'required|array',
            'files.*' => 'file|mimes:jpg,jpeg,png,pdf,doc,docx,xls,xlsx|max:5120',
        ]);

        $peminjaman = PeminjamanFasilitas::findOrFail($id);

        $sortOrder = Media::where('ref_table', 'peminjaman_fasilitas')
            ->where('ref_id', $id)
            ->max('sort_order') ?? 0;

        foreach ($request->file('files') as $index => $file) {
            if (!$file->isValid()) continue;

            $fileName = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME))
                . '_' . time() . '_' . Str::random(5)
                . '.' . $file->getClientOriginalExtension();

            // 🔴 SIMPAN KE storage/app/public
            $file->storeAs('uploads/peminjaman_fasilitas', $fileName, 'public');

            Media::create([
                'ref_table' => 'peminjaman_fasilitas',
                'ref_id' => $id,
                'file_name' => $fileName,
                'caption' => $request->captions[$index] ?? null,
                'mime_type' => $file->getMimeType(),
                'sort_order' => ++$sortOrder
            ]);
        }

        return back()->with('success', 'File berhasil diupload');
    }

    public function deleteMedia($id, $mediaId)
    {
        $media = Media::where('ref_table', 'peminjaman_fasilitas')
            ->where('ref_id', $id)
            ->where('media_id', $mediaId)
            ->firstOrFail();

        Storage::disk('public')->delete('uploads/peminjaman_fasilitas/' . $media->file_name);
        $media->delete();

        return back()->with('success', 'File berhasil dihapus');
    }
}

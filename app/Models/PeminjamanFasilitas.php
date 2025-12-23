<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeminjamanFasilitas extends Model
{
    use HasFactory;

    protected $primaryKey = 'pinjam_id';

    protected $fillable = [
        'fasilitas_id',
        'warga_id',
        'tanggal_mulai',
        'tanggal_selesai',
        'tujuan',
        'status',
        'total_biaya',
    ];

    // Relasi ke fasilitas_umum
    public function fasilitas()
    {
        return $this->belongsTo(FasilitasUmum::class, 'fasilitas_id', 'fasilitas_id');
    }

    // Relasi ke warga
    public function warga()
    {
        return $this->belongsTo(Warga::class, 'warga_id', 'warga_id');
    }

    public function pembayaran()
    {
        return $this->hasMany(PembayaranFasilitas::class, 'pinjam_id', 'pinjam_id');
    }

    // Relasi ke media
    public function media()
    {
        return $this->hasMany(Media::class, 'ref_id', 'pinjam_id')
                    ->where('ref_table', 'peminjaman_fasilitas')
                    ->orderBy('sort_order');
    }
}

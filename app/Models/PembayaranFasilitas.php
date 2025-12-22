<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembayaranFasilitas extends Model
{
    use HasFactory;

    protected $table = 'pembayaran_fasilitas';
    protected $primaryKey = 'bayar_id';
    public $timestamps = true;

    protected $fillable = [
        'pinjam_id',
        'tanggal',
        'jumlah',
        'metode',
        'keterangan',
        'status',
        'bukti_bayar'
    ];

    protected $casts = [
        'tanggal' => 'date',
        'jumlah' => 'decimal:2',
    ];

    // Relasi ke peminjaman
    public function peminjaman()
    {
        return $this->belongsTo(PeminjamanFasilitas::class, 'pinjam_id', 'pinjam_id');
    }

    // Relasi ke media
    public function media()
    {
        return $this->morphMany(Media::class, 'referensi', 'ref_table', 'ref_id')
                   ->where('ref_table', 'pembayaran_fasilitas')
                   ->orderBy('sort_order');
    }

    // Scope untuk pembayaran aktif
    public function scopeAktif($query)
    {
        return $query->where('status', '!=', 'dibatalkan');
    }
}

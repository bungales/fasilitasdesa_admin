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
        'keterangan'
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

    // Relasi ke media - SESUAI dengan struktur Media Anda
    public function media()
    {
        return $this->hasMany(Media::class, 'ref_id', 'bayar_id')
                   ->where('ref_table', 'pembayaran_fasilitas');
    }

    // Accessor untuk jumlah format Rupiah
    public function getJumlahRupiahAttribute()
    {
        return 'Rp ' . number_format($this->jumlah, 0, ',', '.');
    }

    // Accessor untuk tanggal format Indonesia
    public function getTanggalIndoAttribute()
    {
        return \Carbon\Carbon::parse($this->tanggal)->format('d/m/Y');
    }

    // Scope untuk pembayaran yang memiliki media
    public function scopeWithMedia($query)
    {
        return $query->whereHas('media');
    }
}

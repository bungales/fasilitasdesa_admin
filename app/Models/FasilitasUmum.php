<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FasilitasUmum extends Model
{
    use HasFactory;

    protected $table = 'fasilitas_umum';
    protected $primaryKey = 'fasilitas_id';

    protected $fillable = [
        'nama',
        'jenis',
        'alamat',
        'rt',
        'rw',
        'kapasitas',
        'deskripsi',
    ];

    // Relasi ke PetugasFasilitas
    public function petugas()
    {
        return $this->hasMany(PetugasFasilitas::class, 'fasilitas_id', 'fasilitas_id');
    }

    // Relasi ke Warga melalui petugas
    public function petugasWarga()
    {
        return $this->hasManyThrough(
            Warga::class,
            PetugasFasilitas::class,
            'fasilitas_id', // Foreign key pada tabel petugas_fasilitas
            'warga_id',     // Foreign key pada tabel warga
            'fasilitas_id', // Local key pada tabel fasilitas_umum
            'petugas_warga_id' // Local key pada tabel petugas_fasilitas
        );
    }
}

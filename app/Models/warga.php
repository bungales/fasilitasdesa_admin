<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Warga extends Model
{
    protected $table = 'warga';
    protected $primaryKey = 'warga_id';

    protected $fillable = [
        'nama',
        'alamat',
        'rt',
        'rw',
        'jenis_kelamin',
        'no_hp',
    ];

    // Relasi ke PetugasFasilitas (sebagai petugas)
    public function fasilitasTugas()
    {
        return $this->hasMany(PetugasFasilitas::class, 'petugas_warga_id', 'warga_id');
    }

    // Relasi ke FasilitasUmum melalui petugas_fasilitas
    public function fasilitas()
    {
        return $this->hasManyThrough(
            FasilitasUmum::class,
            PetugasFasilitas::class,
            'petugas_warga_id', // Foreign key pada tabel petugas_fasilitas
            'fasilitas_id',     // Foreign key pada tabel fasilitas_umum
            'warga_id',         // Local key pada tabel warga
            'fasilitas_id'      // Local key pada tabel petugas_fasilitas
        );
    }
}

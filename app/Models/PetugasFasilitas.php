<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PetugasFasilitas extends Model
{
    use HasFactory;

    protected $table = 'petugas_fasilitas';
    protected $primaryKey = 'petugas_id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'fasilitas_id',
        'petugas_warga_id',
        'peran',
    ];

    // Relasi ke model Warga
    public function warga()
    {
        return $this->belongsTo(Warga::class, 'petugas_warga_id', 'warga_id');
    }

    // Relasi ke model FasilitasUmum
    public function fasilitas()
    {
        return $this->belongsTo(FasilitasUmum::class, 'fasilitas_id', 'fasilitas_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SyaratFasilitas extends Model
{
    use HasFactory;

    protected $table = 'syarat_fasilitas';
    protected $primaryKey = 'syarat_id';
    protected $fillable = [
        'fasilitas_id',
        'nama_syarat',
        'deskripsi',
        'dokumen_syarat'
    ];

    public $timestamps = true;

    /**
     * Relasi ke model FasilitasUmum
     */
    public function fasilitas()
    {
        return $this->belongsTo(FasilitasUmum::class, 'fasilitas_id', 'fasilitas_id');
    }
}

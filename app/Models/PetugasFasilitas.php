<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class PetugasFasilitas extends Model
{
    use HasFactory;

    protected $table = 'petugas_fasilitas';

    // Tentukan primary key secara dinamis
    protected function getPrimaryKey()
    {
        if (Schema::hasColumn($this->getTable(), 'id')) {
            return 'id';
        } elseif (Schema::hasColumn($this->getTable(), 'petugas_id')) {
            return 'petugas_id';
        }

        return 'id'; // default
    }

    // Override method getKeyName()
    public function getKeyName()
    {
        return $this->getPrimaryKey();
    }

    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'fasilitas_id',
        'petugas_warga_id',
        'peran',
    ];

    public function warga()
    {
        return $this->belongsTo(Warga::class, 'petugas_warga_id', 'warga_id');
    }

    public function fasilitas()
    {
        return $this->belongsTo(FasilitasUmum::class, 'fasilitas_id', 'fasilitas_id');
    }
}

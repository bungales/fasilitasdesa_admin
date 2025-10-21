<?php
namespace App\Models;


use Illuminate\Database\Eloquent\Model;


class warga extends Model
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
}




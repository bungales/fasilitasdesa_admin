<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    protected $table = 'media';
    protected $primaryKey = 'media_id';

    protected $fillable = [
        'ref_table',
        'ref_id',
        'file_name',
        'caption',
        'mime_type',
        'sort_order'
    ];

    /**
     * Scope untuk mengambil media berdasarkan tabel dan ID referensi
     */
    public function scopeByReference($query, $refTable, $refId)
    {
        return $query->where('ref_table', $refTable)
                    ->where('ref_id', $refId)
                    ->orderBy('sort_order');
    }

    /**
     * Get the full URL of the file
     */
    public function getFileUrlAttribute()
    {
        return asset('storage/uploads/' . $this->ref_table . '/' . $this->file_name);
    }

    /**
     * Check if file is an image
     */
    public function getIsImageAttribute()
    {
        return strpos($this->mime_type, 'image/') === 0;
    }

    /**
     * Get file extension
     */
    public function getExtensionAttribute()
    {
        return pathinfo($this->file_name, PATHINFO_EXTENSION);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Media extends Model
{
    use HasFactory;

    protected $table = 'media';
    protected $primaryKey = 'media_id';
    public $timestamps = true;

    protected $fillable = [
        'ref_table',
        'ref_id',
        'file_name',
        'caption',
        'mime_type',
        'sort_order',
        'is_primary'
    ];

    protected $appends = ['url', 'is_image', 'is_pdf', 'exists', 'size', 'public_url'];

    // Relasi polymorphic
    public function referensi()
    {
        return $this->morphTo(__FUNCTION__, 'ref_table', 'ref_id');
    }

    // Get URL file menggunakan Storage facade - DIPERBAIKI
    public function getUrlAttribute()
    {
        return Storage::url('uploads/' . $this->ref_table . '/' . $this->file_name);
    }

    // Get public URL (alternatif) - DIPERBAIKI
    public function getPublicUrlAttribute()
    {
        return asset('storage/uploads/' . $this->ref_table . '/' . $this->file_name);
    }

    // Get full path
    public function getFullPathAttribute()
    {
        return storage_path('app/public/uploads/' . $this->ref_table . '/' . $this->file_name);
    }

    // Get public path
    public function getPublicPathAttribute()
    {
        return 'storage/uploads/' . $this->ref_table . '/' . $this->file_name;
    }

    // Cek apakah file gambar
    public function getIsImageAttribute()
    {
        return strpos($this->mime_type, 'image/') === 0;
    }

    // Cek apakah file PDF
    public function getIsPdfAttribute()
    {
        return $this->mime_type === 'application/pdf';
    }

    // Cek apakah file ada di storage - DIPERBAIKI
    public function getExistsAttribute()
    {
        return Storage::disk('public')->exists('uploads/' . $this->ref_table . '/' . $this->file_name);
    }

    // Get file size - DIPERBAIKI
    public function getSizeAttribute()
    {
        if ($this->exists) {
            $size = Storage::disk('public')->size('uploads/' . $this->ref_table . '/' . $this->file_name);
            return $this->formatBytes($size);
        }
        return '0 KB';
    }

    // Format bytes to readable size
    private function formatBytes($bytes, $precision = 2)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        $bytes /= pow(1024, $pow);
        return round($bytes, $precision) . ' ' . $units[$pow];
    }

    // Method untuk mendapatkan URL dengan fallback
    public function getUrlWithFallback()
    {
        $url = $this->url;
        $exists = $this->exists;

        if (!$exists) {
            // Coba alternatif path
            $altPath = 'pembayaran_fasilitas/' . $this->file_name;
            if (Storage::disk('public')->exists($altPath)) {
                $url = Storage::url($altPath);
            }
        }

        return $url;
    }
}

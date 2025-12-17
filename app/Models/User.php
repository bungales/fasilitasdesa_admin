<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'profile_picture',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Const untuk role
    const ROLE_SUPER_ADMIN   = 'Super Admin';
    const ROLE_ADMINISTRATOR = 'Administrator';
    const ROLE_PELANGGAN     = 'Pelanggan';
    const ROLE_MITRA         = 'Mitra';

    public static function getRoles()
    {
        return [
            self::ROLE_SUPER_ADMIN,
            self::ROLE_ADMINISTRATOR,
            self::ROLE_PELANGGAN,
            self::ROLE_MITRA,
        ];
    }

    // Method untuk mendapatkan URL gambar profil
    public function getProfilePictureUrlAttribute()
    {
        if ($this->profile_picture && Storage::disk('public')->exists($this->profile_picture)) {
            return asset('storage/' . $this->profile_picture);
        }
        return null;
    }

    // Method untuk mendapatkan inisial nama
    public function getInitialAttribute()
    {
        return strtoupper(substr($this->name, 0, 1));
    }

    // Method untuk mendapatkan warna avatar berdasarkan inisial
    public function getAvatarColorAttribute()
    {
        $initial = $this->initial;
        $colors = [
            'A' => '#FF6B6B', 'B' => '#4ECDC4', 'C' => '#45B7D1', 'D' => '#96CEB4',
            'E' => '#FECA57', 'F' => '#FF9FF3', 'G' => '#54A0FF', 'H' => '#5F27CD',
            'I' => '#00D2D3', 'J' => '#FF9F43', 'K' => '#EE5A24', 'L' => '#C4E538',
            'M' => '#12CBC4', 'N' => '#FDA7DF', 'O' => '#ED4C67', 'P' => '#B53471',
            'Q' => '#006266', 'R' => '#1B1464', 'S' => '#5758BB', 'T' => '#6F1E51',
            'U' => '#EE5A24', 'V' => '#C4E538', 'W' => '#12CBC4', 'X' => '#FDA7DF',
            'Y' => '#ED4C67', 'Z' => '#B53471'
        ];

        return $colors[$initial] ?? '#6C5CE7';
    }

    // Method untuk menghapus gambar profil
    public function deleteProfilePicture()
    {
        if ($this->profile_picture && Storage::disk('public')->exists($this->profile_picture)) {
            Storage::disk('public')->delete($this->profile_picture);
        }
        $this->update(['profile_picture' => null]);
    }
}

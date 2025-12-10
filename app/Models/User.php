<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // penambahan role
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Optional: Const untuk role
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
}

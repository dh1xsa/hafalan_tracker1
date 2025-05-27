<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    // Kolom yang bisa diisi massal
    protected $fillable = [
        'name',
        'email',
        'password',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat',
        'kelas',
        'level',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
        'tanggal_lahir' => 'date',
    ];

    public function students()
    {
        return $this->hasMany(Student::class, 'guru_id');
    }
}

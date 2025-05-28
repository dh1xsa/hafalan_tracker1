<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'level',
        'name',
        'password',
        'tanggal_lahir',
        'jenis_kelamin',
        'kelas',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    // Relasi: Guru punya banyak murid
    public function students()
    {
        return $this->hasMany(Student::class, 'guru_id');
    }

    // Scope untuk mengambil hanya guru
    public function scopeGuru($query)
    {
        return $query->where('level', 2);
    }

    // Scope untuk admin
    public function scopeAdmin($query)
    {
        return $query->where('level', 1);
    }
}

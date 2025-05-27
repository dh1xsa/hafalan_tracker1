<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'guru_id',
        'name',
        'password',
        'tanggal_lahir',
        'jenis_kelamin',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    // Relasi: Murid dimiliki oleh satu guru
    public function guru()
    {
        return $this->belongsTo(User::class, 'guru_id');
    }
}

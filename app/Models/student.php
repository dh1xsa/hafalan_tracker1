<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Student extends Model
{
    protected $fillable = [
        'guru_id',
        'name',
        'password',
        'tanggal_lahir',
        'jenis_kelamin',
    ];

    // Relasi ke guru (user)
    public function guru(): BelongsTo
    {
        return $this->belongsTo(User::class, 'guru_id')->where('level', 2);
    }
}

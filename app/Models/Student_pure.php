<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student_pure extends Model
{
    use HasFactory;

    protected $table = 'students_pure';  // pastikan tabel ini sesuai di database kamu

    protected $fillable = [
        'user_id',
        'group_id',
        'name',
        'birth_date',
        'gender',
    ];

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $table = 'students';

    protected $fillable = [
        'group_id',
        'user_id', // tambahkan ini
        'name',
        'password',
        'birth_date',
        'gender',
    ];


    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function hafalans()
    {
        return $this->hasMany(Hafalan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
}

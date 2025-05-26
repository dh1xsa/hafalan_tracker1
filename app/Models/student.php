<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Student extends Model
{
    use HasFactory;

    protected $table = 'students';


    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'name',
        'password',
    ];
    public function user()
    {
        return $this->belongsTo(user::class, 'user_id');
    }

    public function setPasswordAttribute($value)
    {
            $this->attributes['password'] = Hash::make($value);
    }
    

}

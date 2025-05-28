<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class group extends Model
{
    use HasFactory;

    protected $table = 'group';


    public $timestamps = true;

    protected $fillable = [
        'group_name',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(user::class, 'user_id');
    }

    public function students()
    {
        return $this->hasMany(Student::class, 'group_id', 'id');
    }
}

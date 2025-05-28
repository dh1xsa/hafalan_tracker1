<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class hafalan extends Model
{
    use HasFactory;

    protected $table = 'hafalans';


    public $timestamps = true;

    protected $fillable = [
        'group_id',
        'user_id',
        'student_id',
        'hafalan',
        'description',
        'date',
    ];

    public function group()
    {
        return $this->belongsTo(group::class, 'group_id');
    }
    public function user()
    {
        return $this->belongsTo(user::class, 'user_id');
    }

    public function student()
    {
        return $this->belongsTo(student::class, 'student_id');
    }
}

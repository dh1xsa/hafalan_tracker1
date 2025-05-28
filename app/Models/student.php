<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class student extends Model
{
    use HasFactory;
    protected $table = 'students';
    public $timestamps = true;

    protected $fillable = [
        'group_id',
        'name',
        'password',
        'birth_date',
        'gender',
    ];

    public function group()
    {
        return $this->belongsTo(group::class, 'group_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $table = 'groups';

    protected $fillable = [
        'groups_name',
    ];

    public function users()
{
    return $this->belongsToMany(User::class, 'group_user', 'group_id', 'user_id');
}

    public function students()
    {
        return $this->hasMany(Student::class); // default foreign key: group_id
    }
    public function guru()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

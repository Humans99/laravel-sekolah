<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'user_id',
        'parent_id',
        'grade_id',
        'class_id',
        'gender',
        'username',
        'name',
        'surname',
        'email',
        'phone',
        'address',
        'bloodType'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

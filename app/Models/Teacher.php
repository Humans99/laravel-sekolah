<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = [
        'user_id',
        'username',
        'name',
        'surname',
        'email',
        'phone',
        'address',
        'image',
        'bloodType',
        'gender'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

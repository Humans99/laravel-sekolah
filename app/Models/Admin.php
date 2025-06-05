<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['user_id', 'username', 'password'];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

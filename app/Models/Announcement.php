<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $fillable = ['title', 'description', 'date', 'class_id'];

    public function class()
    {
        return $this->belongsTo(ClassModel::class);
    }
}

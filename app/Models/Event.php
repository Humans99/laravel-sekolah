<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = ['title', 'description', 'start', 'end', 'class_id'];

    public function class()
    {
        return $this->belongsTo(ClassModel::class);
    }
}

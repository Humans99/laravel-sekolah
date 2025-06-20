<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;
    protected static $factory;
    protected $fillable = ['title', 'description', 'start', 'end', 'class_id'];

    public function class()
    {
        return $this->belongsTo(ClassModel::class);
    }
}

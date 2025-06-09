<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Exam extends Model
{
    use HasFactory;
    protected static $factory;
    protected $fillable = ['title', 'start', 'end', 'lesson_id'];

    public function results()
    {
        return $this->hasMany(Result::class);
    }

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $fillable = ['title', 'start', 'end', 'lesson_id'];

    public function result()
    {
        return $this->hasMany(Result::class);
    }

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }
}

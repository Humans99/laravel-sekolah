<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $fillable = [
        'score',
        'exam_id',
        'assignment_id',
        'student_id'
    ];

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    public function assignment()
    {
        return $this->belongsTo(Assignment::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}

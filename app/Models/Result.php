<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Result extends Model
{
    use HasFactory;
    protected static $factory;
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

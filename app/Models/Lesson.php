<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lesson extends Model
{
    use HasFactory;
    protected static $factory;
    protected $fillable = [
        'start',
        'end',
        'name',
        'subject_id',
        'grade_id',
        'class_id',
        'teacher_id'
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function class()
    {
        return $this->belongsTo(ClassModel::class);
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }

    public function exams()
    {
        return $this->hasMany(Exam::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function subjects()
    {
        return $this->belongsTo(Subject::class);
    }
}

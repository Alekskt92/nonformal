<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentEducation extends Model
{
    protected $fillable = ['type_education', 'sphere_education', 'duration', 'duration_type', 'diploma'];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_uuid', 'student_uuid');
    }
}

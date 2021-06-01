<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\GroupStudent;

class Student extends Model
{

    protected $fillable = ['name', 'last_name', 'patronymic', 'group_uuid'];

    public function groupStudent()
    {
        return $this->belongsTo(GroupStudent::class, 'group_uuid', 'group_uuid');
    }

    public function studentEducation()
    {
        return $this->hasMany(StudentEducation::class, 'student_uuid', 'student_uuid');
    }
}

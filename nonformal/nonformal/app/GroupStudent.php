<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Student;

class GroupStudent extends Model
{
    protected $fillable = ['name_group'];


    public function students()
    {
        return $this->hasMany(Student::class, 'group_uuid', 'group_uuid');
    }
}

<?php

namespace App\Employee;

use Illuminate\Database\Eloquent\Model;

class EmployeeDetail extends Model
{
    protected $table = 'employee_details';

    public function hasBloodGroup()
    {
        return $this->belongsTo('App\Model\Blood_groups','blood_group_id');
    }

    public function hasEducation()
    {
        return $this->belongsTo('App\Model\Educations','education_id');
    }
}

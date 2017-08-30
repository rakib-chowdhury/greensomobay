<?php

namespace App\Employee;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $id = 'id';

    protected $table = 'employee';

    public function hasBranch()
    {
        return $this->belongsTo('App\Branches\Branches','branch_id');
    }

    public function hasDesignation()
    {
        return $this->belongsTo('App\Model\Designations','designation_id');
    }

    public function hasRole()
    {
        return $this->belongsTo('App\Model\Roles','role_id');
    }
    
    public function hasEmployeeDetails()
    {
        return $this->hasOne('App\Employee\EmployeeDetail','emp_id');
    }
}

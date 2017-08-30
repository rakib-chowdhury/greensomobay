<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Member_emp_rels extends Model
{
    protected $table = 'member_employee_rel';

    public function hasEmployee()
    {
        return $this->belongsTo('App\Employee\Employee','emp_id');
    }
    public function hasMember()
    {
        return $this->belongsTo('App\Members\Members','member_id');
    }
}

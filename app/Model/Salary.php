<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    protected $table = 'salary';

    public function hasEmployee()
    {
        return $this->belongsTo('App\Employee\Employee','emp_id');
    }
   
}

<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Salary_advance extends Model
{
   protected $table = 'salary_advance';
   public function hasEmployee()
   {
      return $this->belongsTo('App\Employee\Employee','emp_id');
   }
}

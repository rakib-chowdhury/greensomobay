<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Member_resignations extends Model
{
   protected $table = 'member_resignation_list';

   public function hasMember()
   {
      return $this->belongsTo('App\Members\Members','member_id');
   }
}

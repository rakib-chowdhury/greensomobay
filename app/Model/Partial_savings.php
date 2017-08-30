<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Partial_savings extends Model
{
   protected $table = 'partial_withdrawal_list';

   public function hasMember()
   {
      return $this->belongsTo('App\Members\Members','member_id');
   }
}

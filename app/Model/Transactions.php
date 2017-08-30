<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    protected $table = 'transaction';

    public function hasMember()
    {
        return $this->belongsTo('App\Members\Members','member_id');
    }

    public function hasSubGroup()
    {
        return $this->belongsTo('App\Model\Sub_group','sub_group_id');
    }
}

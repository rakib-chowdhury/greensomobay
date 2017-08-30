<?php

namespace App\Members;

use Illuminate\Database\Eloquent\Model;

class Members extends Model
{
    protected $table = 'members';

    public function hasBranch()
    {
        return $this->belongsTo('App\Branches\Branches','branch_id');
    }

    public function hasMemberDetails()
    {
        return $this->hasOne('App\Members\MemberDetail','members_id');
    }

    public function hasTransaction()
    {
        return $this->hasMany('App\Model\Transactions','member_id');
    }
}

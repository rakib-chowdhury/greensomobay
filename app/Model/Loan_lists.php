<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Loan_lists extends Model
{
    protected $table = 'loan_list';

    public function hasMember()
    {
        return $this->belongsTo('App\Members\Members','member_id');
    }
}

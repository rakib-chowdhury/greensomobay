<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Loan_request_lists extends Model
{
    protected $table = 'loan_request_list';

    public function hasMember()
    {
        return $this->belongsTo('App\Members\Members','member_id');
    }
}

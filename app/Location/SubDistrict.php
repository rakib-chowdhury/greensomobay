<?php

namespace App\Location;

use Illuminate\Database\Eloquent\Model;

class SubDistrict extends Model
{
    protected $id = 'id';

    protected $table = 'upazilla';

    protected $fillable = ['bn_name','en_name','district_id'];

    public function district()
    {
        return $this->belongsTo('App\Location\District');
    }
}

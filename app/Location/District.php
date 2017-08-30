<?php

namespace App\Location;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $id = 'id';

    protected $table = 'district';

    protected $fillable = ['bn_name','en_name','division_id'];

    public function division()
    {
        return $this->belongsTo('App\Location\Division');
    }

    public function subDistrict()
    {
        return $this->hasMany('App\Location\SubDistrict');
    }
}

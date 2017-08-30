<?php

namespace App\Location;

use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    protected $id = 'id';

    protected $table = 'division';

    protected $fillable = ['name','en_name'];

    public function subDistrict()
    {
        return $this->hasMany('App\Location\District');
    }
}

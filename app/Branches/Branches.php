<?php

namespace App\Branches;

use Illuminate\Database\Eloquent\Model;

class Branches extends Model
{
    protected $id = 'id';

    protected $table = 'branches';

    protected $fillable = ['name', 'division_id','district_id', 'subDistrict_id', 'specified_location','status'];

    public function division()
    {
        return $this->belongsTo('App\Location\Division');
    }
    public function district()
    {
        return $this->belongsTo('App\Location\District');
    }
    public function subDistrict()
    {
        return $this->belongsTo('App\Location\SubDistrict','subDistrict_id');
    }
}

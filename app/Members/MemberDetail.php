<?php

namespace App\Members;

use Illuminate\Database\Eloquent\Model;

class MemberDetail extends Model
{
    protected $table = 'member_details';

    public function hasBloodGroup()
    {
        return $this->belongsTo('App\Model\Blood_groups','blood_group');
    }

    public function hasEducation()
    {
        return $this->belongsTo('App\Model\Educations','education_qualification');
    }

    public function hasCurrDivision()
    {
        return $this->belongsTo('App\Location\Division','current_division');
    }

    public function hasPerDivision()
    {
        return $this->belongsTo('App\Location\Division','permanent_division');
    }

    public function hasCurrDistrict()
    {
        return $this->belongsTo('App\Location\District','current_district');
    }

    public function hasPerDistrict()
    {
        return $this->belongsTo('App\Location\District','permanent_district');
    }

    public function hasCurrUpz()
    {
        return $this->belongsTo('App\Location\SubDistrict','current_upazila');
    }
    
    public function hasPerUpz()
    {
        return $this->belongsTo('App\Location\SubDistrict','permanent_upazila');
    }
}

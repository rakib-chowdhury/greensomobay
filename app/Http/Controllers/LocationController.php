<?php

namespace App\Http\Controllers;

use App\Location\District;
use App\Location\SubDistrict;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LocationController extends Controller
{
    public static function getDivision()
    {
        $division = DB::table('division')->get();
        return $division;
    }

    public static function getDistrictByDivision($divisionId)
    {
        $district = DB::table('district')->where('division_id',$divisionId)->get();
        return $district;
    }

    public static function getUpazilaByDistrict($districtId)
    {
        $upazila = DB::table('upazilla')->where('district_id',$districtId)->get();
        return $upazila;
    }

    public static function getBloodGroup()
    {
        return DB::table('blood_group')->get();
    }

    public static function education()
    {
        return DB::table('education')->get();
    }

    public function getDistrictUpzByDivision(Request $r){
        $data['dist']=District::where('division_id',$r->input('div_id'))->get();
        $data['upz']=SubDistrict::where('district_id',$data['dist'][0]->id)->get();

        return response()->json($data);
    }
}

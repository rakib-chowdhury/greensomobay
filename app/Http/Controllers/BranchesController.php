<?php

namespace App\Http\Controllers;

use App\Branches\Branches;
use App\Location\District;
use App\Location\Division;
use App\Location\SubDistrict;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BranchesController extends Controller
{
    protected function index()
    {   
        $branches = Branches::with('division', 'district', 'subDistrict')->get();
        $divisions = Division::where('id', 7)->first();////7=rangpur
        $districts = District::where('id', 59)->first();////ponchogor
        $upazillas = SubDistrict::where('district_id', 59)->get();
        //dd($districts);
        return view('admin.branch.branch', compact('branches', 'divisions', 'districts', 'upazillas'));
    }

    protected function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'division' => 'required',
            'district' => 'required',
            'subDistrict' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect('admin/branches')
                ->withInput($request->all())
                ->withErrors($validator->errors())
                ->with('warning', 'আপনার নতুন ব্রাঞ্চটি খোলা সম্ভব হয়নি');
        } else {
            $store = new Branches();
            $store->name = $request->input('name');
            $store->division_id = $request->input('division');
            $store->district_id = $request->input('district');
            $store->subDistrict_id = $request->input('subDistrict');
            $store->specified_location = $request->input('specified');
            $store->created_at = date('Y-m-d');
            $store->save();

            return redirect('/admin/branches')->with('success', 'আপনার ব্রাঞ্চটি সফলভাবে খোলা হয়েছে');
        }
    }

    protected function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'division' => 'required',
            'district' => 'required',
            'subDistrict' => 'required',
            //'specified' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect('admin/branches')
                ->withInput($request->all())
                ->withErrors($validator->errors())
                ->with('warning', 'আপনার ব্রাঞ্চটি সংশোধন করা সম্ভব হয়নি');
        } else {
            $id = $request->input('id');

            $store['name'] = $request->input('name');
            $store['division_id'] = $request->input('division');
            $store['district_id'] = $request->input('district');
            $store['subDistrict_id'] = $request->input('subDistrict');
            $store['specified_location'] = $request->input('specified');

            Branches::where('id', $id)->update($store);

            return redirect('/admin/branches')->with('success', 'আপনার ব্রাঞ্চটি সফলভাবে সংশোধন করা হয়েছে');
        }
    }

    protected function destroy($id)
    {
        $delete = $this->findBranch($id)->delete();
        if ($delete) return redirect('/admin/branches')->with('success', 'আপনার ব্রাঞ্চটি সফলভাবে মুছে ফেলা হয়েছে ');
        return redirect('/admin/branches')->with('warning', 'আপনার ব্রাঞ্চটি মুছে ফেলা সম্ভব হয়নি ');
    }

    private function findBranch($id)
    {
        return Branches::find($id);
    }
}

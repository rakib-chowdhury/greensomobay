<?php

namespace App\Http\Controllers;

use App\Branches\Branches;
use App\Model\Prokolpos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProkolpoController extends Controller
{
    protected function index()
    {
        $prokolpos = Prokolpos::All();

        return view('admin.prokolpo.prokolpo', compact('prokolpos'));
    }

    protected function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'type' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect('admin/prokolpos')
                ->withInput($request->all())
                ->withErrors($validator->errors())
                ->with('warning', 'প্রকল্প সংযোজন সম্পন্ন হয় নাই ');
        } else {
            $store = new Prokolpos();
            $store->name = $request->input('name');
            $store->type = $request->input('type');
            $store->created_at = date('Y-m-d');
            $store->save();

            return redirect('/admin/prokolpos')->with('success', 'প্রকল্পটি সফলভাবে সংযোজন করা হয়েছে ');
        }
    }

    protected function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'type' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect('admin/prokolpos')
                ->withInput($request->all())
                ->withErrors($validator->errors())
                ->with('warning', 'প্রকল্পটি সংশোধন করা সম্ভব হয়নি');
        } else {
            $id = $request->input('id');

            $store['name'] = $request->input('name');
            $store['type'] = $request->input('type');

            Prokolpos::where('id', $id)->update($store);

            return redirect('/admin/prokolpos')->with('success', 'প্রকল্পটি সফলভাবে সংশোধন করা হয়েছে');
        }
    }

    protected function destroy($id)
    {
        $delete = $this->findProkolpo($id)->delete();
        if ($delete) return redirect('/admin/prokolpos')->with('success', 'প্রকল্পটি সফলভাবে মুছে ফেলা হয়েছে');
        return redirect('/admin/prokolpos')->with('warning', 'প্রকল্পটি মুছে ফেলা সম্ভব হয় নাই। অনুগ্রহ করে আবার চেষ্টা করুন');
    }

    private function findProkolpo($id)
    {
        return Prokolpos::find($id);
    }
}

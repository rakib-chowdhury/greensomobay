<?php

namespace App\Http\Controllers\FrontContent;

use App\Front\FrontData;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AboutUsController extends Controller
{
    public function show($type)
    {
        if ($type == 'about_us') {
            $data['page_title'] = 'আমাদের কথা';
        } elseif ($type == 'rules') {
            $data['page_title'] = 'সমবায় নীতি';
        } elseif ($type == 'current_work') {
            $data['page_title'] = 'চলমান কার্যক্রম';
        } elseif ($type == 'achievement') {
            $data['page_title'] = 'অর্জন';
        } else {
            $data['page_title'] = $type;
        }
        $data['type'] = $type;
        $data['page_info'] = FrontData::where('type', $type)->first();

        return view('frontPages.admin.aboutUs', $data);
    }

    public function store(Request $r)
    {
        $validator = Validator::make($r->all(), [
            'about_us' => 'required',
            'pic' => 'required'
        ]);
        $type=$r->input('type');
        if ($validator->fails()) {
            return redirect('admin/front/'.$type.'/show')
                ->withInput($r->all())
                ->withErrors($validator->errors())
                ->with('warning', 'অনুগ্রহ করে সঠিক তথ্য প্রদান করুন');
        } else {
            $store = new FrontData();
            $store->type = $type;
            $store->pic = 'no_img.jpg';
            $store->content = $r->input('about_us');
            $store->created_at = date('Y-m-d');
            $store->save();

            if ($_FILES['pic']['error'] == 0) {
                $imageName = $type.'_' . $store->id . '.' . $r->pic->getClientOriginalExtension();
                $r->pic->move(public_path('img/frontend/'), $imageName);

                FrontData::where('id', $store->id)->update(['pic' => $imageName]);
            }

            return redirect('/admin/front/'.$type.'/show')->with('success', 'কার্যক্রমটি সফল হয়েছে');
        }
    }

    public function update(Request $r)
    {
        $validator = Validator::make($r->all(), [
            'about_us' => 'required'
        ]);
        $type=$r->input('type');
        $id=$r->input('update_id');
        if ($validator->fails()) {
            return redirect('admin/front/'.$type.'/show')
                ->withInput($r->all())
                ->withErrors($validator->errors())
                ->with('warning', 'অনুগ্রহ করে সঠিক তথ্য প্রদান করুন');
        } else {
            FrontData::where('id', $id)->update(['content' => $r->input('about_us')]);

            if ($_FILES['pic']['error'] == 0) {
                $imageName = $type.'_' . $id . '.' . $r->pic->getClientOriginalExtension();
                $r->pic->move(public_path('img/frontend/'), $imageName);

                FrontData::where('id', $id)->update(['pic' => $imageName]);
            }

            return redirect('/admin/front/'.$type.'/show')->with('success', 'কার্যক্রমটি সফল হয়েছে');
        }
    }
}

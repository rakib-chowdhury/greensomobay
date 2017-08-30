<?php

namespace App\Http\Controllers\FrontContent;

use App\Front\FrontData;
use App\Model\Company_infos;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ContactUsController extends Controller
{
    public function show()
    {   
        $data['page_info'] = Company_infos::first();

        return view('frontPages.admin.contactUs', $data);
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
            'address' => 'required',
            'mobile' => 'required',
            'email' => 'required'
        ]);
        $id=$r->input('update_id');
        if ($validator->fails()) {
            return redirect('admin/front/contact_us')
                ->withInput($r->all())
                ->withErrors($validator->errors())
                ->with('warning', 'অনুগ্রহ করে সঠিক তথ্য প্রদান করুন');
        } else {
            $d['address']=$r->input('address');
            $d['email']=$r->input('email');
            $d['tnt']=$r->input('phone');
            $d['mobile']=$r->input('mobile');
            Company_infos::where('id', $id)->update($d);

            return redirect('/admin/front/contact_us')->with('success', 'কার্যক্রমটি সফল হয়েছে');
        }
    }
}

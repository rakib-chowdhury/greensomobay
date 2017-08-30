<?php

namespace App\Http\Controllers\FrontContent;

use App\Model\Gallery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class GalleryController extends Controller
{
    public function show()
    {        
        $data['page_info'] = Gallery::all();

        return view('frontPages.admin.gallery', $data);
    }

    public function store(Request $r)
    {
        $validator = Validator::make($r->all(), [            
            'pic' => 'required'
        ]);
        $type=$r->input('type');
        if ($validator->fails()) {
            return redirect('admin/front/gallery')
                ->withInput($r->all())
                ->withErrors($validator->errors())
                ->with('warning', 'অনুগ্রহ করে সঠিক তথ্য প্রদান করুন');
        } else {
            $store = new Gallery();            
            $store->name = 'no_img.jpg';
            $store->details = $r->input('details');
            $store->added_by = Auth::user()->emp_id;
            $store->created_at = date('Y-m-d');
            $store->save();

            if ($_FILES['pic']['error'] == 0) {

                $imageName = 'gallery_' . $store->id . '.' . $r->pic->getClientOriginalExtension();
                $r->pic->move(public_path('img/gallery/big/'), $imageName);

                Gallery::where('id', $store->id)->update(['name' => $imageName]);

                $oldPath = public_path('img/gallery/big/'.$imageName);

                $newPath = public_path('img/gallery/thumbs/'.$imageName);

                if (\File::copy($oldPath , $newPath)) {

                }
            }

            return redirect('/admin/front/gallery')->with('success', 'কার্যক্রমটি সফল হয়েছে');
        }
    }

    public function delete($id){
        $tmp = Gallery::where('id', $id)->first();

        if ($tmp->name != 'no_img.png') {
            unlink(public_path('img\gallery\big\\' . $tmp->name));
            unlink(public_path('img\gallery\thumbs\\' . $tmp->name));
        }

        Gallery::where('id', $id)->delete();       

        return redirect('admin/front/gallery')->with('success', 'কার্যক্রমটি সফল হয়েছে');
    }
}

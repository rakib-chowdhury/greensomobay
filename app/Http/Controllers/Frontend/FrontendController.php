<?php

namespace App\Http\Controllers\Frontend;

use App\Front\FrontData;
use App\Http\Controllers\Controller;
use App\Members\Members;
use App\Model\Company_infos;
use App\Model\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mail;
use App\Mail\Send_mail;
use App\Mail\Newsletter;

class FrontendController extends Controller
{
    public static $bn_digits = array('০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯');
    public static $en_digits = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');

    protected function index()
    {
        return view('welcome');
    }

    protected function show($type)
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
        $data['page_info'] = FrontData::where('type', $type)->first();

        return view('frontPages.about', $data);
    }

    protected function contact_us()
    {
        $data['page_info'] = Company_infos::first();
        return view('frontPages.contact_us', $data);
    }

    protected function gallery()
    {
        $data['page_info'] = Gallery::where('status', 1)->get();
        return view('frontPages.gallery', $data);
    }

    public function send_mail(Request $r)
    {
        $data['email'] = $r->input('email');
        $data['name'] = $r->input('name');
        $data['subject'] = $r->input('subject');
        $data['messages'] = $r->input('message');
        //echo '<pre>'; print_r($data); die();

        Mail::to('support@greensomobaybazar.com')->send(new Send_mail($data));
        return redirect('/contact_us')->with('success', 'Message has been send.');
    }

    public function newsletter(Request $r)
    {
        $data['email'] = $r->input('email');
        $data['subject'] = 'Newsletter';
        //echo '<pre>'; print_r($data); die();

        Mail::to('support@greensomobaybazar.com')->send(new Newsletter($data));
        return redirect('/')->with('success', 'কার্যক্রমটি সফল হয়েছে');
    }

    public function check_member(Request $r)
    {
        $mb = str_replace(self::$bn_digits, self::$en_digits, $r->input('mb'));
        $reg_no = str_replace(self::$bn_digits, self::$en_digits, $r->input('reg_no'));
        $res = Members::where('registration_no', $reg_no)->where('phone', $mb)->where('status', 1)->first();

        return response()->json(sizeof($res));
    }

    public function check_members(Request $r)
    {
        $mb = str_replace(self::$bn_digits, self::$en_digits, $r->input('mb'));
        $reg_no = str_replace(self::$bn_digits, self::$en_digits, $r->input('reg_no'));
        $res = Members::where('registration_no', $reg_no)->where('phone', $mb)->where('status', 1)->first();

        if ($r->input('m_type') == 'loan') {
            return redirect('/loanApplicant/' . $res->id);
        } elseif ($r->input('m_type') == 'partial') {
            return redirect('/partialSavings/' . $res->id);
        } elseif ($r->input('m_type') == 'resignation') {
            return redirect('/membersRecall/' . $res->id);
        }

    }
}

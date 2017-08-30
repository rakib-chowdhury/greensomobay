<?php

namespace App\Http\Controllers\FrontForms;

use App\Http\Requests\MembersResignationValidation;
use App\Members\MemberDetail;
use App\Members\Members;
use App\Model\Member_accounts;
use App\Model\Member_emp_rels;
use App\Model\Member_resignations;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MemberResignationController extends Controller
{
    public static $bn_digits = array('০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯');
    public static $en_digits = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');

    protected function show($id)
    {
        $data['member_info'] = Members::with('hasMemberDetails')
            ->with('hasMemberDetails.hasCurrDivision')
            ->with('hasMemberDetails.hasCurrDistrict')
            ->with('hasMemberDetails.hasCurrUpz')
            ->first();
        $tmp = Member_accounts::where('member_id', $id)->get();
        $data['deposit'] = $tmp->sum('debit') - $tmp->sum('credit');

        return view('frontPages.forms.membersRecall',$data);
    }

    protected function post(MembersResignationValidation $req)
    {
        $mem_reg = new Member_resignations();
        $mem_reg->member_id = $req->input('mem_id');
        $mem_reg->total_amount = str_replace(self::$bn_digits, self::$en_digits, $req->input('savedMoney'));
        $mem_reg->requested_amount = str_replace(self::$bn_digits, self::$en_digits, $req->input('withdrawMoney'));
        $mem_reg->created_at = date('Y-m-d');
        $mem_reg->save();
        return redirect('/admin/message')->with('success', 'আবেদন প্রক্রিয়া সফলভাবে সম্পন্ন হয়েছে');
    }
}

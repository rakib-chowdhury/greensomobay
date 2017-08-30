<?php

namespace App\Http\Controllers\FrontForms;

use App\Http\Requests\PartialSavingsValidation;
use App\Members\MemberDetail;
use App\Members\Members;
use App\Model\Member_accounts;
use App\Model\Member_resignations;
use App\Model\Member_emp_rels;
use App\Model\Partial_savings;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PartialSavingController extends Controller
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
        return view('frontPages.forms.partialSavings', $data);
    }

    protected function post(PartialSavingsValidation $req)
    {
        dd($req->all());

        $partial_sav = new Partial_savings();
        //$mem_reg->members_id = $mem->id;
        $partial_sav->member_id = $req->input('mem_id');
        $partial_sav->total_amount = str_replace(self::$bn_digits, self::$en_digits, $req->input('savedMoney'));
        $partial_sav->requested_amount = str_replace(self::$bn_digits, self::$en_digits, $req->input('withdrawMoney'));
        $partial_sav->created_at = date('Y-m-d');
        $partial_sav->save();

        return redirect('/admin/message')->with('success', 'আবেদন প্রক্রিয়া সফলভাবে সম্পন্ন হয়েছে');
    }
}

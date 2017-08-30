<?php

namespace App\Http\Controllers\FrontForms;

use App\Branches\Branches;
use App\Http\Controllers\LocationController;
use App\Http\Requests\LoanApplicantValidation;
use App\Location\District;
use App\Location\Division;
use App\Location\SubDistrict;
use App\Model\Loan_lists;
use App\Model\Member_accounts;
use App\Model\Member_emp_rels;
use App\Model\Member_resignations;
use App\Model\Loan_applicant;
use App\Members\MemberDetail;
use App\Members\Members;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoanApplyController extends Controller
{
    public static $bn_digits = array('০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯');
    public static $en_digits = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');

    protected function show($id)
    {
        $data['divisions'] = Division::all();
        $data['districts'] = District::all();
        $data['upz'] = SubDistrict::all();

        $data['member_info'] = Members::with('hasMemberDetails')
            ->with(['hasTransaction' => function ($query) {
                $query->where('group_id', 6);
                $query->orderBy('transaction_date', 'desc');
            }])
            ->where('id', $id)->first();
        $tmp = Member_accounts::where('member_id', $id)->get();
        $data['deposit'] = $tmp->sum('debit') - $tmp->sum('credit');
        $data['take_loan'] = Loan_lists::where('id', $id)->orderBy('id','desc')->get();
        //echo sizeof($data['take_loan']); die();
        return view('frontPages.forms.loanApplicant', $data);
    }

    protected function post(LoanApplicantValidation $req)
    {
        //dd($req->all());
        $tempMem = Members::orderBy('id', 'desc')->first();
        if (sizeof($tempMem) != 0) {
            $tmpId = $tempMem->id + 1;
        } else {
            $tmpId = 1;
        }
        $memId = sprintf("%'.06d\n", $tmpId);


        $loan_app = new Loan_applicant();
        $loan_app->member_id = $req->input('mem_id');
        $loan_app->grantor_name = $req->input('guardianName');
        $loan_app->grantor_sign = "no_img.png";
        $loan_app->grantor_relation = $req->input('nomineeRelation');
        $loan_app->loan_number = $req->input('loanTimes');
        $loan_app->loan_amount = $req->input('loanAmount');
        $loan_app->loan_pay_condition = $req->input('repaymentStatus');
        if ($req->input('paymentDeadline') != null || $req->input('paymentDeadline') != '') {
            //$tmpDate = explode('/', $req->input('paymentDeadline'));
            //$loan_app->last_loan_pay_date = $tmpDate[2] . '-' . $tmpDate[0] . '-' . $tmpDate[1];
            $loan_app->last_loan_pay_date = $req->input('paymentDeadline');
        }
        $loan_app->last_month_deposit = $req->input('storageStatus');
        $loan_app->second_last_month_deposit = $req->input('storageStatus2nd');
        $loan_app->third_last_month_deposit = $req->input('storageStatus3rd');
        $loan_app->curr_deposit_amount = str_replace(self::$bn_digits, self::$en_digits, $req->input('totalSavings'));
        $loan_app->partial_withdrawal_amount = $req->input('partialRefund');
        $loan_app->requested_amount = $req->input('proposedLoan');
        $loan_app->laon_field = $req->input('creditSector');
        $loan_app->loan_duration = $req->input('termLoan');
        $loan_app->witness_one_sign = "no_img.png";
        $loan_app->witness_two_sign = "no_img.png";
        $loan_app->witness_three_sign = "no_img.png";
        $loan_app->created_at = date('Y-m-d');
        $loan_app->save();

        $imageName2 = 'guardian_sign_' . $loan_app->id . '.' . $req->guardianSignature->getClientOriginalExtension();
        $req->guardianSignature->move(public_path('img/loan_applicants'), $imageName2);

        Loan_applicant::where('id', $loan_app->id)->update(['grantor_sign' => $imageName2]);

        $imageName3 = 'witness1_sign_' . $loan_app->id . '.' . $req->witnessSignature1->getClientOriginalExtension();
        $req->witnessSignature1->move(public_path('img/loan_applicants'), $imageName3);

        Loan_applicant::where('id', $loan_app->id)->update(['witness_one_sign' => $imageName3]);

        $imageName4 = 'witness2_sign_' . $loan_app->id . '.' . $req->witnessSignature2->getClientOriginalExtension();
        $req->witnessSignature2->move(public_path('img/loan_applicants'), $imageName4);

        Loan_applicant::where('id', $loan_app->id)->update(['witness_two_sign' => $imageName4]);

        $imageName5 = 'witness3_sign_' . $loan_app->id . '.' . $req->witnessSignature3->getClientOriginalExtension();
        $req->witnessSignature3->move(public_path('img/loan_applicants'), $imageName5);

        Loan_applicant::where('id', $loan_app->id)->update(['witness_three_sign' => $imageName5]);

        return redirect('/admin/message')->with('success', 'আবেদন প্রক্রিয়া সফলভাবে সম্পন্ন হয়েছে');
    }
}

<?php

namespace App\Http\Controllers;

use App\Branches\Branches;
use App\Employee\Employee;
use App\Location\District;
use App\Location\Division;
use App\Location\SubDistrict;
use App\Members\MemberDetail;
use App\Members\Members;
use App\Model\Admission_share;
use App\Model\Company_accounts;
use App\Model\Member_accounts;
use App\Model\Member_emp_rels;
use App\Model\Prokolpos;
use App\Model\Sub_account_group;
use App\Model\Transaction_details;
use App\Model\Transactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{
    public static $bn_digits = array('০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯');
    public static $en_digits = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');

    protected function add()
    {
        $d_date = date('Y-m-d');
        $data['d_date'] = $d_date;
        $data['deposit_type'] = Prokolpos::where('status', 1)->where('type', 1)->get();
        $data['member'] = Member_emp_rels::with('hasMember.hasMemberDetails.hasCurrDivision')
            ->with('hasMember.hasMemberDetails.hasCurrDistrict')
            ->with('hasMember.hasMemberDetails.hasCurrUpz')
            ->with(['hasMember.hasTransaction' => function ($trans) use ($d_date) {
                $trans->where('transaction_date', '=', $d_date);
                $trans->where('group_id', '=', 6);
            }])
            ->where('status', 1)->where('emp_id', session('emp_id'))->get();

        //dd($data);

        return view('admin.account.deposit.add', $data);
    }

    protected function post(Request $r)
    {
        $tmpDate = explode('/', $r->input('deposit_date'));
        $d_date = $tmpDate[2] . '-' . $tmpDate[0] . '-' . $tmpDate[1];

        $amounts = $r->input('deposit_amount');
        $members = $r->input('mem_id');

        foreach ($members as $k => $a) {
            $tmpEmp = Members::where('id', $members[$k])->first();

            /******************************
             *********Transaction**********
             ******************************/

            $chk_tran = Transactions::where('member_id', $members[$k])
                ->where('group_id', 6)
                ->where('transaction_date', $d_date)
                ->first();
            //echo sizeof($chk_tran);
            if (sizeof($chk_tran) == 0) {
                $tran = new Transactions();
                $tran->created_at = date('Y-m-d');
                $tran->credit = 0;
                $tran->group_id = 6;
                $tran->account_group_id = 0;
                $tran->employee_id = 0;
                $tran->transaction_date = $d_date;
                $tran->added_by = session('emp_id');
                $tran->member_id = $members[$k];

                $tDEBIT = 0;
                if (is_numeric($amounts[$k])) {
                    $tDEBIT = str_replace(self::$bn_digits, self::$en_digits, $amounts[$k]);
                } else {
                    $tDEBIT = 0;
                }
                $tran->debit = $tDEBIT;
                $tDescription = '';
                if ($r->input('depositType_' . $members[$k]) == 2) {
                    $tran->sub_group_id = 1;
                    $tDescription = $tmpEmp->name . ' এর গ্রাম সঞ্চয় - ' . str_replace(self::$en_digits, self::$bn_digits, $tran->debit) . ' টাকা ';
                } else {
                    $tran->sub_group_id = 2;
                    $tDescription = $tmpEmp->name . ' এর বাজার সঞ্চয় - ' . str_replace(self::$en_digits, self::$bn_digits, $tran->debit) . ' টাকা ';
                }
                $tran->description = $tDescription;
                $tran->save();

                /******************************
                 *********Company Account**********
                 ******************************/
                ////deposit add to company account
                $cmp_acc = new Company_accounts();
                $cmp_acc->transaction_id = $tran->id;
                $cmp_acc->description = $tDescription;
                $cmp_acc->debit = $tDEBIT;
                $cmp_acc->credit = 0;
                $cmp_acc->group_id = 6;
                $cmp_acc->account_group_id = 0;
                $cmp_acc->created_at = date('Y-m-d');
                $cmp_acc->save();

                ////deposit add to member account
                $mem_acc = new Member_accounts();
                $mem_acc->member_id = $members[$k];
                $mem_acc->description = $tDescription;
                $mem_acc->debit = $tDEBIT;
                $mem_acc->credit = 0;
                $mem_acc->group_id = 6;
                $mem_acc->transaction_id = $tran->id;
                $mem_acc->created_at = date('Y-m-d');
                $mem_acc->save();

            } else {

                if (is_numeric($amounts[$k])) {
                    $tran['debit'] = str_replace(self::$bn_digits, self::$en_digits, $amounts[$k]);
                    $company['debit'] = str_replace(self::$bn_digits, self::$en_digits, $amounts[$k]);
                    $member['debit'] = str_replace(self::$bn_digits, self::$en_digits, $amounts[$k]);
                } else {
                    $tran['debit'] = 0;
                    $company['debit'] = 0;
                    $member['debit'] = 0;
                }

                if ($r->input('depositType_' . $members[$k]) == 2) {
                    $tran['sub_group_id'] = 1;
                    $tran['description'] = $tmpEmp->name . ' এর গ্রাম সঞ্চয় - ' . str_replace(self::$en_digits, self::$bn_digits, $tran['debit']) . ' টাকা ';
                    $company['description'] = $tmpEmp->name . ' এর গ্রাম সঞ্চয় - ' . str_replace(self::$en_digits, self::$bn_digits, $tran['debit']) . ' টাকা ';
                    $member['description'] = $tmpEmp->name . ' এর গ্রাম সঞ্চয় - ' . str_replace(self::$en_digits, self::$bn_digits, $tran['debit']) . ' টাকা ';
                } else {
                    $tran['sub_group_id'] = 2;
                    $tran['description'] = $tmpEmp->name . ' এর বাজার সঞ্চয় - ' . str_replace(self::$en_digits, self::$bn_digits, $tran['debit']) . ' টাকা ';
                    $company['description'] = $tmpEmp->name . ' এর বাজার সঞ্চয় - ' . str_replace(self::$en_digits, self::$bn_digits, $tran['debit']) . ' টাকা ';
                    $member['description'] = $tmpEmp->name . ' এর বাজার সঞ্চয় - ' . str_replace(self::$en_digits, self::$bn_digits, $tran['debit']) . ' টাকা ';
                }
                Transactions::where('id', $chk_tran->id)->update($tran);
                Company_accounts::where('transaction_id', $chk_tran->id)->update($company);
                Member_accounts::where('transaction_id', $chk_tran->id)->update($member);
            }
        }

        return redirect('/admin/collect_deposit')->with('success', 'সঞ্চয় আদায় সফলভাবে সংরক্ষণ করা হয়েছে');
    }

    protected function loan()
    {
        $d_date = date('Y-m-d');
        $data['d_date'] = $d_date;

        $data['deposit_type'] = Prokolpos::where('status', 1)->where('type', 1)->get();
        $data['member'] = Member_emp_rels::with('hasMember.hasMemberDetails.hasCurrDivision')
            ->with('hasMember.hasMemberDetails.hasCurrDistrict')
            ->with('hasMember.hasMemberDetails.hasCurrUpz')
            ->with(['hasMember.hasTransaction' => function ($trans) use ($d_date) {
                $trans->where('transaction_date', '=', $d_date);
                $trans->whereIn('group_id', array(3, 4, 5));
                $trans->orderBy('group_id', 'asc');
            }])
            ->where('status', 1)->where('emp_id', session('emp_id'))->get();
        //dd($data);
        return view('admin.account.loan.add', $data);
    }

    protected function loan_post(Request $r)
    {
//        echo '<pre>';
//        print_r($r->all());
//        die();

        $tmpDate = explode('/', $r->input('loan_date'));
        $d_date = $tmpDate[2] . '-' . $tmpDate[0] . '-' . $tmpDate[1];
        $members = $r->input('mem_id');

        /*************
         ****Laon*****
        **************/
        $amounts = $r->input('loan_amount');

        foreach ($members as $k => $a) {
            $tmpEmp = Members::where('id', $members[$k])->first();
            $chk_tran = Transactions::where('member_id', $members[$k])
                ->where('group_id', 3)
                ->where('transaction_date', $d_date)
                ->first();

            if (is_numeric($amounts[$k])) {
                $tmpDEBIT = str_replace(self::$bn_digits, self::$en_digits, $amounts[$k]);
            } else {
                $tmpDEBIT = 0;
            }
            if (sizeof($chk_tran) == 0) {
                /////transaction
                $tran = new Transactions();
                $tran->created_at = date('Y-m-d');
                $tran->credit = 0;
                $tran->group_id = 3;
                $tran->sub_group_id = 0;
                $tran->account_group_id = 0;
                $tran->employee_id = 0;
                $tran->transaction_date = $d_date;
                $tran->added_by = session('emp_id');
                $tran->member_id = $members[$k];
                $tran->debit = $tmpDEBIT;
                $tran->description = $tmpEmp->name . ' এর ঋণ আদায় - ' . str_replace(self::$en_digits, self::$bn_digits, $tmpDEBIT) . ' টাকা ';
                $tran->save();

                ////company account
                $cmp_acc = new Company_accounts();
                $cmp_acc->transaction_id = $tran->id;
                $cmp_acc->description = $tmpEmp->name . ' এর ঋণ আদায় - ' . str_replace(self::$en_digits, self::$bn_digits, $tmpDEBIT) . ' টাকা ';
                $cmp_acc->debit = $tmpDEBIT;
                $cmp_acc->credit = 0;
                $cmp_acc->group_id = 0;
                $cmp_acc->account_group_id = 0;
                $cmp_acc->created_at = date('Y-m-d');
                $cmp_acc->save();

                ////deposit add to member account
                $mem_acc = new Member_accounts();
                $mem_acc->member_id = $members[$k];
                $mem_acc->description = $tmpEmp->name . ' এর ঋণ আদায় - ' . str_replace(self::$en_digits, self::$bn_digits, $tmpDEBIT) . ' টাকা ';
                $mem_acc->debit = $tmpDEBIT;
                $mem_acc->credit = 0;
                $mem_acc->group_id = 0;
                $mem_acc->transaction_id = $tran->id;
                $mem_acc->created_at = date('Y-m-d');
                $mem_acc->save();

            } else {

                $tran['debit'] = $tmpDEBIT;
                $tran['description'] = $tmpEmp->name . ' এর ঋণ আদায় - ' . str_replace(self::$en_digits, self::$bn_digits, $tmpDEBIT) . ' টাকা ';
                Transactions::where('id', $chk_tran->id)->update($tran);

                $company['debit'] = $tmpDEBIT;
                $company['description'] = $tmpEmp->name . ' এর ঋণ আদায় - ' . str_replace(self::$en_digits, self::$bn_digits, $tmpDEBIT) . ' টাকা ';
                Company_accounts::where('transaction_id', $chk_tran->id)->update($company);

                $memberAcc['debit'] = $tmpDEBIT;
                $memberAcc['description'] = $tmpEmp->name . ' এর ঋণ আদায় - ' . str_replace(self::$en_digits, self::$bn_digits, $tmpDEBIT) . ' টাকা ';
                Member_accounts::where('transaction_id', $chk_tran->id)->update($tran);

            }
        }

        /***********************
         ****service charge*****
         ***********************/
        $amounts = $r->input('service_charge');

        foreach ($members as $k => $a) {
            $tmpEmp = Members::where('id', $members[$k])->first();
            $chk_tran = Transactions::where('member_id', $members[$k])
                ->where('group_id', 4)
                ->where('transaction_date', $d_date)
                ->first();

            if (is_numeric($amounts[$k])) {
                $tmpDEBIT = str_replace(self::$bn_digits, self::$en_digits, $amounts[$k]);
            } else {
                $tmpDEBIT = 0;
            }
            if (sizeof($chk_tran) == 0) {
                /////transaction
                $tran = new Transactions();
                $tran->created_at = date('Y-m-d');
                $tran->credit = 0;
                $tran->group_id = 4;
                $tran->sub_group_id = 0;
                $tran->account_group_id = 0;
                $tran->employee_id = 0;
                $tran->transaction_date = $d_date;
                $tran->added_by = session('emp_id');
                $tran->member_id = $members[$k];
                $tran->debit = $tmpDEBIT;
                $tran->description = $tmpEmp->name . ' এর সার্ভিস চার্জ আদায় - ' . str_replace(self::$en_digits, self::$bn_digits, $tmpDEBIT) . ' টাকা ';
                $tran->save();

                ////company account
                $cmp_acc = new Company_accounts();
                $cmp_acc->transaction_id = $tran->id;
                $cmp_acc->description = $tmpEmp->name . ' এর সার্ভিস চার্জ আদায় - ' . str_replace(self::$en_digits, self::$bn_digits, $tmpDEBIT) . ' টাকা ';
                $cmp_acc->debit = $tmpDEBIT;
                $cmp_acc->credit = 0;
                $cmp_acc->group_id = 0;
                $cmp_acc->account_group_id = 0;
                $cmp_acc->created_at = date('Y-m-d');
                $cmp_acc->save();

                ////deposit add to member account
                $mem_acc = new Member_accounts();
                $mem_acc->member_id = $members[$k];
                $mem_acc->description = $tmpEmp->name . ' এর সার্ভিস চার্জ আদায় - ' . str_replace(self::$en_digits, self::$bn_digits, $tmpDEBIT) . ' টাকা ';
                $mem_acc->debit = $tmpDEBIT;
                $mem_acc->credit = 0;
                $mem_acc->group_id = 0;
                $mem_acc->transaction_id = $tran->id;
                $mem_acc->created_at = date('Y-m-d');
                $mem_acc->save();

            } else {

                $tran['debit'] = $tmpDEBIT;
                $tran['description'] = $tmpEmp->name . ' এর সার্ভিস চার্জ আদায় - ' . str_replace(self::$en_digits, self::$bn_digits, $tmpDEBIT) . ' টাকা ';
                Transactions::where('id', $chk_tran->id)->update($tran);

                $company['debit'] = $tmpDEBIT;
                $company['description'] = $tmpEmp->name . ' এর সার্ভিস চার্জ আদায় - ' . str_replace(self::$en_digits, self::$bn_digits, $tmpDEBIT) . ' টাকা ';
                Company_accounts::where('transaction_id', $chk_tran->id)->update($company);

                $memberAcc['debit'] = $tmpDEBIT;
                $memberAcc['description'] = $tmpEmp->name . ' এর সার্ভিস চার্জ আদায় - ' . str_replace(self::$en_digits, self::$bn_digits, $tmpDEBIT) . ' টাকা ';
                Member_accounts::where('transaction_id', $chk_tran->id)->update($tran);

            }
        }

        /******************
         ****insurance*****
         ******************/
        $amounts = $r->input('loan_insurance');

        foreach ($members as $k => $a) {
            $tmpEmp = Members::where('id', $members[$k])->first();
            $chk_tran = Transactions::where('member_id', $members[$k])
                ->where('group_id', 5)
                ->where('transaction_date', $d_date)
                ->first();

            if (is_numeric($amounts[$k])) {
                $tmpDEBIT = str_replace(self::$bn_digits, self::$en_digits, $amounts[$k]);
            } else {
                $tmpDEBIT = 0;
            }
            if (sizeof($chk_tran) == 0) {
                /////transaction
                $tran = new Transactions();
                $tran->created_at = date('Y-m-d');
                $tran->credit = 0;
                $tran->group_id = 5;
                $tran->sub_group_id = 0;
                $tran->account_group_id = 0;
                $tran->employee_id = 0;
                $tran->transaction_date = $d_date;
                $tran->added_by = session('emp_id');
                $tran->member_id = $members[$k];
                $tran->debit = $tmpDEBIT;
                $tran->description = $tmpEmp->name . ' এর ঋণ বীমা আদায় - ' . str_replace(self::$en_digits, self::$bn_digits, $tmpDEBIT) . ' টাকা ';
                $tran->save();

                ////company account
                $cmp_acc = new Company_accounts();
                $cmp_acc->transaction_id = $tran->id;
                $cmp_acc->description = $tmpEmp->name . ' এর ঋণ বীমা আদায় - ' . str_replace(self::$en_digits, self::$bn_digits, $tmpDEBIT) . ' টাকা ';
                $cmp_acc->debit = $tmpDEBIT;
                $cmp_acc->credit = 0;
                $cmp_acc->group_id = 0;
                $cmp_acc->account_group_id = 0;
                $cmp_acc->created_at = date('Y-m-d');
                $cmp_acc->save();

                ////deposit add to member account
                $mem_acc = new Member_accounts();
                $mem_acc->member_id = $members[$k];
                $mem_acc->description = $tmpEmp->name . ' এর ঋণ বীমা আদায় - ' . str_replace(self::$en_digits, self::$bn_digits, $tmpDEBIT) . ' টাকা ';
                $mem_acc->debit = $tmpDEBIT;
                $mem_acc->credit = 0;
                $mem_acc->group_id = 0;
                $mem_acc->transaction_id = $tran->id;
                $mem_acc->created_at = date('Y-m-d');
                $mem_acc->save();

            } else {

                $tran['debit'] = $tmpDEBIT;
                $tran['description'] = $tmpEmp->name . ' এর ঋণ বীমা আদায় - ' . str_replace(self::$en_digits, self::$bn_digits, $tmpDEBIT) . ' টাকা ';
                Transactions::where('id', $chk_tran->id)->update($tran);

                $company['debit'] = $tmpDEBIT;
                $company['description'] = $tmpEmp->name . ' এর ঋণ বীমা আদায় - ' . str_replace(self::$en_digits, self::$bn_digits, $tmpDEBIT) . ' টাকা ';
                Company_accounts::where('transaction_id', $chk_tran->id)->update($company);

                $memberAcc['debit'] = $tmpDEBIT;
                $memberAcc['description'] = $tmpEmp->name . ' এর ঋণ বীমা আদায় - ' . str_replace(self::$en_digits, self::$bn_digits, $tmpDEBIT) . ' টাকা ';
                Member_accounts::where('transaction_id', $chk_tran->id)->update($tran);

            }
        }

        return redirect('/admin/collect_loan')->with('success', 'ঋণ আদায় সফলভাবে সংরক্ষণ করা হয়েছে');


    }

    protected function share()
    {
        $data['share_info'] = Admission_share::where('type', 2)->first()->price;
        $data['member_list'] = Members::where('status', 1)->where('branch_id', session('branch_id'))->get();

        return view('admin.account.share.add', $data);
    }

    protected function share_post(Request $r)
    {
        $tmpDate = explode('/', $r->input('share_date'));
        $d_date = $tmpDate[2] . '-' . $tmpDate[0] . '-' . $tmpDate[1];
        $tmpEmp = Members::where('id', $r->input('member'))->first();

        /***********************************
         *************Share Fee*************
         ***********************************/
        /////share add to transaction
        $tran = new Transactions();
        $tran->created_at = date('Y-m-d');
        $tran->credit = 0;
        $tran->group_id = 2;
        $tran->sub_group_id = 0;
        $tran->account_group_id = 2;
        $tran->employee_id = 0;
        $tran->transaction_date = $d_date;
        $tran->added_by = session('emp_id');
        $tran->member_id = $r->input('member');

        $shareN = str_replace(self::$bn_digits, self::$en_digits, $r->input('share_num'));
        $perShare = str_replace(self::$bn_digits, self::$en_digits, $r->input('per_share_price'));

        $tmpAmnt = ($perShare * $shareN);
        $tran->debit = str_replace(self::$bn_digits, self::$en_digits, $tmpAmnt);

        $tran->description = $tmpEmp->name . ' এর ' . str_replace(self::$bn_digits, self::$en_digits, $r->input('share_num')) . ' টি শেয়ার এর শেয়ার মূল্য - ' . str_replace(self::$en_digits, self::$bn_digits, $tmpAmnt) . ' টাকা ';

        $tran->save();

        ////share fee add to company account
        $cmp_acc = new Company_accounts();
        $cmp_acc->transaction_id = $tran->id;
        $cmp_acc->description = $tmpEmp->name . ' এর ' . str_replace(self::$bn_digits, self::$en_digits, $r->input('share_num')) . ' টি শেয়ার এর শেয়ার মূল্য - ' . str_replace(self::$en_digits, self::$bn_digits, $tmpAmnt) . ' টাকা ';
        $cmp_acc->debit = str_replace(self::$bn_digits, self::$en_digits, $tmpAmnt);
        $cmp_acc->credit = 0;
        $cmp_acc->group_id = 2;
        $cmp_acc->account_group_id = 2;
        $cmp_acc->created_at = date('Y-m-d');
        $cmp_acc->save();

        ////share fee add to member account
        $mem_acc = new Member_accounts();
        $mem_acc->member_id = $r->input('member');
        $mem_acc->description = $tmpEmp->name . ' এর ' . str_replace(self::$bn_digits, self::$en_digits, $r->input('share_num')) . ' টি শেয়ার এর শেয়ার মূল্য - ' . str_replace(self::$en_digits, self::$bn_digits, $tmpAmnt) . ' টাকা ';
        $mem_acc->debit = str_replace(self::$bn_digits, self::$en_digits, $tmpAmnt);
        $mem_acc->credit = 0;
        $mem_acc->group_id = 2;
        $mem_acc->transaction_id = $tran->id;
        $mem_acc->created_at = date('Y-m-d');
        $mem_acc->save();

        $tmpTotalShare = $tmpEmp->member_share + str_replace(self::$bn_digits, self::$en_digits, $r->input('share_num'));
        Members::where('id', $tmpEmp->id)->update(['share_number' => $tmpTotalShare]);

        return redirect('/admin/collect_share')->with('success', 'শেয়ার ফান্ড গ্রহণ সফলভাবে সংরক্ষণ করা হয়েছে');
    }

    protected function return_share()
    {
        $data['share_info'] = '20';
        $data['member_list'] = Members::where('status', 1)->where('branch_id', session('branch_id'))->get();

        return view('admin.account.share.return', $data);
    }

    protected function return_share_post(Request $r)
    {
        $tmpDate = explode('/', $r->input('share_date'));
        $d_date = $tmpDate[2] . '-' . $tmpDate[0] . '-' . $tmpDate[1];
        $tmpEmp = Members::where('id', $r->input('member'))->first();

        /***********************************
         *************Share Fee*************
         ***********************************/
        /////share add to transaction
        $tran = new Transactions();
        $tran->created_at = date('Y-m-d');
        $tran->debit = 0;
        $tran->group_id = 2;
        $tran->sub_group_id = 0;
        $tran->account_group_id = 2;
        $tran->employee_id = 0;
        $tran->transaction_date = $d_date;
        $tran->added_by = session('emp_id');
        $tran->member_id = $r->input('member');

        $shareN = str_replace(self::$bn_digits, self::$en_digits, $r->input('share_num'));
        $perShare = str_replace(self::$bn_digits, self::$en_digits, $r->input('per_share_price'));

        $tmpAmnt = ($perShare * $shareN);
        $tran->credit = str_replace(self::$bn_digits, self::$en_digits, $tmpAmnt);

        $tran->description = $tmpEmp->name . ' এর ' . str_replace(self::$bn_digits, self::$en_digits, $r->input('share_num')) . ' টি শেয়ার ফেরত , শেয়ার মূল্য - ' . str_replace(self::$en_digits, self::$bn_digits, $tmpAmnt) . ' টাকা ';

        $tran->save();

        ////share fee add to company account
        $cmp_acc = new Company_accounts();
        $cmp_acc->transaction_id = $tran->id;
        $cmp_acc->description = $tmpEmp->name . ' এর ' . str_replace(self::$bn_digits, self::$en_digits, $r->input('share_num')) . ' টি শেয়ার ফেরত , শেয়ার মূল্য - ' . str_replace(self::$en_digits, self::$bn_digits, $tmpAmnt) . ' টাকা ';
        $cmp_acc->credit = str_replace(self::$bn_digits, self::$en_digits, $tmpAmnt);
        $cmp_acc->debit = 0;
        $cmp_acc->group_id = 2;
        $cmp_acc->account_group_id = 2;
        $cmp_acc->created_at = date('Y-m-d');
        $cmp_acc->save();

        ////share fee add to member account
        $mem_acc = new Member_accounts();
        $mem_acc->member_id = $r->input('member');
        $mem_acc->description = $tmpEmp->name . ' এর ' . str_replace(self::$bn_digits, self::$en_digits, $r->input('share_num')) . ' টি শেয়ার ফেরত , শেয়ার মূল্য - ' . str_replace(self::$en_digits, self::$bn_digits, $tmpAmnt) . ' টাকা ';
        $mem_acc->credit = str_replace(self::$bn_digits, self::$en_digits, $tmpAmnt);
        $mem_acc->debit = 0;
        $mem_acc->group_id = 2;
        $mem_acc->transaction_id = $tran->id;
        $mem_acc->created_at = date('Y-m-d');
        $mem_acc->save();

        $tmpTotalShare = $tmpEmp->member_share - str_replace(self::$bn_digits, self::$en_digits, $r->input('share_num'));
        Members::where('id', $tmpEmp->id)->update(['share_number' => $tmpTotalShare]);

        return redirect('/admin/collect_share')->with('success', 'শেয়ার ফান্ড ফেরত সফলভাবে সংরক্ষণ করা হয়েছে');
    }

    protected function member_admission($id)
    {
        $data['share_price'] = Admission_share::where('type', 2)->where('status', 1)->first()->price;
        $data['admission_fee'] = Admission_share::where('type', 1)->where('status', 1)->first()->price;
        $data['member_list'] = Members::where('id', $id)->get();

        return view('admin.member.admission', $data);
    }

    protected function member_admission_post(Request $r)
    {
        $tmpDate = explode('/', $r->input('share_date'));
        $d_date = $tmpDate[2] . '-' . $tmpDate[0] . '-' . $tmpDate[1];
        $tmpEmp = Members::where('id', $r->input('member'))->first();

        /***********************************
         *************Admission Fee*********
         ***********************************/

        ////admission fee add to transaction
        $tran = new Transactions();
        $tran->created_at = date('Y-m-d');
        $tran->credit = 0;
        $tran->group_id = 1;
        $tran->sub_group_id = 0;
        $tran->account_group_id = 1;
        $tran->employee_id = 0;
        $tran->transaction_date = $d_date;
        $tran->added_by = session('emp_id');
        $tran->member_id = $r->input('member');
        $tran->debit = str_replace(self::$bn_digits, self::$en_digits, $r->input('admissionFee'));

        $tran->description = $tmpEmp->name . ' এর ভর্তি ফি - ' . str_replace(self::$en_digits, self::$bn_digits, $r->input('admissionFee')) . ' টাকা ';

        $tran->save();

        ////admission fee add to company account
        $cmp_acc = new Company_accounts();
        $cmp_acc->transaction_id = $tran->id;
        $cmp_acc->description = $tmpEmp->name . ' এর ভর্তি ফি - ' . str_replace(self::$en_digits, self::$bn_digits, $r->input('admissionFee')) . ' টাকা ';
        $cmp_acc->debit = str_replace(self::$bn_digits, self::$en_digits, $r->input('admissionFee'));
        $cmp_acc->credit = 0;
        $cmp_acc->group_id = 1;
        $cmp_acc->account_group_id = 1;
        $cmp_acc->created_at = date('Y-m-d');
        $cmp_acc->save();

        ////admission fee add to member account
        $mem_acc = new Member_accounts();
        $mem_acc->member_id = $r->input('member');
        $mem_acc->description = $tmpEmp->name . ' এর ভর্তি ফি - ' . str_replace(self::$en_digits, self::$bn_digits, $r->input('admissionFee')) . ' টাকা ';
        $mem_acc->debit = str_replace(self::$bn_digits, self::$en_digits, $r->input('admissionFee'));
        $mem_acc->credit = 0;
        $mem_acc->group_id = 1;
        $mem_acc->transaction_id = $tran->id;
        $mem_acc->created_at = date('Y-m-d');
        $mem_acc->save();

        /***********************************
         *************Share Fee*************
         ***********************************/
        /////share add to transaction
        $tran = new Transactions();
        $tran->created_at = date('Y-m-d');
        $tran->credit = 0;
        $tran->group_id = 2;
        $tran->sub_group_id = 0;
        $tran->account_group_id = 2;
        $tran->employee_id = 0;
        $tran->transaction_date = $d_date;
        $tran->added_by = session('emp_id');
        $tran->member_id = $r->input('member');

        $shareN = str_replace(self::$bn_digits, self::$en_digits, $r->input('share_num'));
        $perShare = str_replace(self::$bn_digits, self::$en_digits, $r->input('per_share_price'));

        $tmpAmnt = ($perShare * $shareN);
        $tran->debit = str_replace(self::$bn_digits, self::$en_digits, $tmpAmnt);

        $tran->description = $tmpEmp->name . ' এর ' . str_replace(self::$bn_digits, self::$en_digits, $r->input('share_num')) . ' টি শেয়ার এর শেয়ার মূল্য - ' . str_replace(self::$en_digits, self::$bn_digits, $tmpAmnt) . ' টাকা ';

        $tran->save();

        ////share fee add to company account
        $cmp_acc = new Company_accounts();
        $cmp_acc->transaction_id = $tran->id;
        $cmp_acc->description = $tmpEmp->name . ' এর ' . str_replace(self::$bn_digits, self::$en_digits, $r->input('share_num')) . ' টি শেয়ার এর শেয়ার মূল্য - ' . str_replace(self::$en_digits, self::$bn_digits, $tmpAmnt) . ' টাকা ';
        $cmp_acc->debit = str_replace(self::$bn_digits, self::$en_digits, $tmpAmnt);
        $cmp_acc->credit = 0;
        $cmp_acc->group_id = 2;
        $cmp_acc->account_group_id = 2;
        $cmp_acc->created_at = date('Y-m-d');
        $cmp_acc->save();

        ////share fee add to member account
        $mem_acc = new Member_accounts();
        $mem_acc->member_id = $r->input('member');
        $mem_acc->description = $tmpEmp->name . ' এর ' . str_replace(self::$bn_digits, self::$en_digits, $r->input('share_num')) . ' টি শেয়ার এর শেয়ার মূল্য - ' . str_replace(self::$en_digits, self::$bn_digits, $tmpAmnt) . ' টাকা ';
        $mem_acc->debit = str_replace(self::$bn_digits, self::$en_digits, $tmpAmnt);
        $mem_acc->credit = 0;
        $mem_acc->group_id = 2;
        $mem_acc->transaction_id = $tran->id;
        $mem_acc->created_at = date('Y-m-d');
        $mem_acc->save();

        $upMem['status']=6;
        $upMem['share_number']=str_replace(self::$bn_digits, self::$en_digits, $r->input('share_num'));
        Members::where('id', $tmpEmp->id)->update($upMem);

        MemberDetail::where('member_id',$tmpEmp->id)->update(['membership_granted_at'=>date('Y-m-d')]);


        return redirect('/admin/member/lists/New')->with('success', 'সদস্য ভর্তি সম্পন্ন হয়েছে');

    }

    /***********************************
     ***************Expense*************
     ***********************************/
    protected function expense()
    {
        $data['page_title'] = 'ব্যয়';
        $data['sub_acc_type'] = Sub_account_group::where('account_group_id', 5)
            ->whereNotIn('id', [1, 2])
            ->get();

        $data['share_info'] = '20';
        $data['employee'] = Employee::where('status', 1)->get();

        return view('admin.transaction.expense', $data);
    }

    protected function expense_post(Request $r)
    {
        $tmpDate = explode('-', $r->input('share_date'));
        $d_date = $tmpDate[2] . '-' . $tmpDate[0] . '-' . $tmpDate[1];

        $subAccGrp = $r->input('sub_account_group');
        $amount = $r->input('amount');
        $comment = $r->input('description');

        foreach ($subAccGrp as $k => $row) {

            $tmpEx = Sub_account_group::find($row);
            /**transaction**/
            $tran = new Transactions();
            $tran->created_at = date('Y-m-d');
            $tran->debit = 0;
            $tran->group_id = 0;
            $tran->sub_group_id = 0;
            $tran->account_group_id = 5;//5=expense
            $tran->sub_account_group_id = $subAccGrp[$k];
            $tran->employee_id = 0;
            $tran->transaction_date = $d_date;
            $tran->added_by = session('emp_id');
            $tran->member_id = 0;
            $tran->credit = str_replace(self::$bn_digits, self::$en_digits, $amount[$k]);

            $tran->description = $tmpEx->name . ' বাবদ ব্যয় - ' . str_replace(self::$en_digits, self::$bn_digits, $amount[$k]) . ' টাকা ';
            $tran->comment = $comment[$k];
            $tran->save();

            ////company account
            $cmp_acc = new Company_accounts();
            $cmp_acc->transaction_id = $tran->id;
            $cmp_acc->description = $tmpEx->name . ' বাবদ ব্যয় - ' . str_replace(self::$en_digits, self::$bn_digits, $amount[$k]) . ' টাকা ';
            $cmp_acc->credit = str_replace(self::$bn_digits, self::$en_digits, $amount[$k]);
            $cmp_acc->debit = 0;
            $cmp_acc->group_id = 0;
            $cmp_acc->account_group_id = 1;///asset
            $cmp_acc->sub_account_group_id = 24;///cash
            $cmp_acc->created_at = date('Y-m-d');
            $cmp_acc->save();
        }

        return redirect('/admin/expense')->with('success', 'কার্যক্রমটি সফল হয়েছে');
    }

    /***********************************
     ***************Expense*************
     ***********************************/
    protected function income()
    {
        $data['page_title'] = 'আয়';
        $data['sub_acc_type'] = Sub_account_group::where('account_group_id', 4)
            //->whereNotIn('id', [1, 2])
            ->get();

        $data['share_info'] = '20';
        $data['employee'] = Employee::where('status', 1)->get();

        return view('admin.transaction.income', $data);
    }

    protected function income_post(Request $r)
    {
        $tmpDate = explode('-', $r->input('share_date'));
        $d_date = $tmpDate[2] . '-' . $tmpDate[0] . '-' . $tmpDate[1];

        $subAccGrp = $r->input('sub_account_group');
        $amount = $r->input('amount');
        $comment = $r->input('description');

        foreach ($subAccGrp as $k => $row) {

            $tmpEx = Sub_account_group::find($row);
            /**transaction**/
            $tran = new Transactions();
            $tran->created_at = date('Y-m-d');
            $tran->credit = 0;
            $tran->group_id = 0;
            $tran->sub_group_id = 0;
            $tran->account_group_id = 4;//5=income
            $tran->sub_account_group_id = $subAccGrp[$k];
            $tran->employee_id = 0;
            $tran->transaction_date = $d_date;
            $tran->added_by = session('emp_id');
            $tran->member_id = 0;
            $tran->debit = str_replace(self::$bn_digits, self::$en_digits, $amount[$k]);

            $tran->description = $tmpEx->name . ' বাবদ আয় - ' . str_replace(self::$en_digits, self::$bn_digits, $amount[$k]) . ' টাকা ';
            $tran->comment = $comment[$k];
            $tran->save();

            ////company account
            $cmp_acc = new Company_accounts();
            $cmp_acc->transaction_id = $tran->id;
            $cmp_acc->description = $tmpEx->name . ' বাবদ আয় - ' . str_replace(self::$en_digits, self::$bn_digits, $amount[$k]) . ' টাকা ';
            $cmp_acc->debit = str_replace(self::$bn_digits, self::$en_digits, $amount[$k]);
            $cmp_acc->credit = 0;
            $cmp_acc->group_id = 0;
            $cmp_acc->account_group_id = 1;///asset
            $cmp_acc->sub_account_group_id = 24;///cash
            $cmp_acc->created_at = date('Y-m-d');
            $cmp_acc->save();
        }

        return redirect('/admin/income')->with('success', 'কার্যক্রমটি সফল হয়েছে');
    }


    protected function transaction()
    {
        $data['page_title'] = 'ব্যয়';
        $data['sub_acc_type'] = Sub_account_group::where('account_group_id', 5)
            ->whereNotIn('id', [1, 2])
            ->get();

        $data['share_info'] = '20';
        $data['employee'] = Employee::where('status', 1)->get();

        return view('admin.transaction.add', $data);
    }

}

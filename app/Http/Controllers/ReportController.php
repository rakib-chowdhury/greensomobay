<?php

namespace App\Http\Controllers;

use App\Branches\Branches;
use App\Employee\Employee;
use App\Location\District;
use App\Location\Division;
use App\Location\SubDistrict;
use App\Members\Members;
use App\Model\Member_emp_rels;
use App\Model\Prokolpos;
use App\Model\Salary_advance;
use App\Model\Transactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReportController extends Controller
{
    public static $bn_digits = array('০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯');
    public static $en_digits = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');

    protected function loanReport()
    {
        $data['prokolpo'] = Prokolpos::where('status', 1)->where('type', 2)->get();
        //dd($data);
        return view('admin.report.loanReport', $data);
    }

    protected function deposit_report(Request $r)
    {
        $data['prokolpoList'] = Prokolpos::where('status', 1)->where('type', 1)->get();
        $data['branchList'] = Branches::Where('status', 1)->get();
        $data['memberList'] = Members::where('status', 1)->get();
        $data['prokolpo'] = 'all';
        $data['branch'] = 'all';
        $data['member'] = 'all';
        $data['d_date'] = date('Y/m/d') . ' - ' . date('Y/m/d');

        if ($_POST) {
            $data['prokolpo'] = $r->input('prokolpo');
            $data['branch'] = $r->input('branch_id');
            if ($data['branch'] != 'all') {
                $data['memberList'] = Members::where('branch_id', $data['branch'])->get();
            }

            $data['member'] = $r->input('member_id');
            $data['d_date'] = $r->input('d_date');
            //echo '<pre>';
            // print_r($_POST);
        }


        $tmpDate = explode('-', $data['d_date']);
        $tmpDate2 = explode('/', $tmpDate[0]);
        $startDate = $tmpDate2[0] . '-' . $tmpDate2[1] . '-' . $tmpDate2[2];
        $tmpDate2 = explode('/', $tmpDate[1]);
        $endDate = $tmpDate2[0] . '-' . $tmpDate2[1] . '-' . $tmpDate2[2];

        if ($data['prokolpo'] == 'all') {
            $pr = array(1, 2);
        } else {
            if ($data['prokolpo'] == 2) {
                $pr = array(1);
            } elseif ($data['prokolpo'] == 3) {
                $pr = array(2);
            }
        }

        if($data['member']=='all'){
            if($data['branch']=='all'){
                $mem=Members::where('status',1)->get(['id']);
            }else{
                $mem=Members::where('branch_id',$data['branch'])->where('status',1)->get(['id']);
            }
        }else{
            $mem=array($data['member']);
        }


        $data['page_data'] = Transactions::where('group_id', 6)
            ->where('transaction_date', '>=', $startDate)
            ->where('transaction_date', '<=', $endDate)
            ->whereIn('sub_group_id',$pr)
            ->whereIn('member_id',$mem)
            ->get();

//        $data['page_data'] = Members::with('hasMemberDetails')
//            ->with('hasTransaction.hasSubGroup')
//            ->with(['hasTransaction' => function ($query) use ($startDate, $endDate, $pr) {
//                $query->where('transaction_date', '>=', $startDate);
//                $query->where('transaction_date', '<=', $endDate);
//                $query->where('group_id', '=', 6);
//                if ($pr == 2) {
//                    $query->where('sub_group_id', '=', 1);
//                } elseif ($pr == 3) {
//                    $query->where('sub_group_id', '=', 2);
//                }
//            }])
//            ->whereIn('id',$tmpMember)
//            ->get();
        //dd($data);


        return view('admin.report.depositReport', $data);
    }

    public function getMemeberAjax(Request $r)
    {
        if ($r->input('branch') == 'all') {
            $member = Members::where('status', 1)->get();
        } else {
            $member = Members::where('branch_id', $r->input('branch'))->get();
        }
        return response()->json($member);
    }

    public function incomeExpense(Request $r)
    {
        if (session('role') == 1) {
            $data['branchList'] = Branches::where('status', 1)->get();
        } else {
            $data['branchList'] = Branches::where('id', session('branch_id'))->get();
        }
        $data['d_date'] = date('Y/m/d') . ' - ' . date('Y/m/d');

        if ($_POST) {
            $data['branch'] = $r->input('branch_id');
            $data['d_date'] = $r->input('d_date');
        }
        $data['branch_id'] = $data['branchList'][0]->id;
        $empId = Employee::where('branch_id', $data['branch_id']);
        $tmpDate = explode('-', $data['d_date']);
        $tmpDate2 = explode('/', $tmpDate[0]);
        $startDate = $tmpDate2[0] . '-' . $tmpDate2[1] . '-' . $tmpDate2[2];
        $tmpDate2 = explode('/', $tmpDate[1]);
        $endDate = $tmpDate2[0] . '-' . $tmpDate2[1] . '-' . $tmpDate2[2];

        $data['prev_amnt'] = Transactions::whereIn('added_by', $empId)
            ->where('transaction_date', '<', $startDate)
            ->get();

        return view('admin.report.incomeExpense', $data);
    }

    public function show2(Request $r)
    {
        $data['d_date'] = date('Y/m/d') . ' - ' . date('Y/m/d');

        if (session('role') == 1) {
            $data['branchList'] = Branches::Where('status', 1)->get();
        } else {
            $data['branchList'] = Branches::Where('id', session('branch_id'))->get();
        }
        $data['branch'] = Branches::Where('id', $data['branchList'][0]->id)->get();

        if (session('role') == 4) {
            $data['employeeList'] = Employee::where('id', session('emp_id'))->get();
        } else {
            $data['employeeList'] = Employee::where('branch_id', $data['branch'][0]->id)
                ->where('designation_id', 4)
                ->get();
        }
        $data['employee'] = 'all';

        if ($_POST) {
            $data['branch'] = $r->input('branch_id');
            $data['employee'] = $r->input('emp_id');
            $data['d_date'] = $r->input('d_date');
        }
        $data['employee'] = Employee::where('id', session('emp_id'))->first()->id;

        $tmpDate = explode('-', $data['d_date']);
        $tmpDate2 = explode('/', $tmpDate[0]);
        $startDate = $tmpDate2[0] . '-' . $tmpDate2[1] . '-' . $tmpDate2[2];
        $tmpDate2 = explode('/', $tmpDate[1]);
        $endDate = $tmpDate2[0] . '-' . $tmpDate2[1] . '-' . $tmpDate2[2];
        //echo '|'.$startDate.'|'.$endDate.'|';
        $page_data = Transactions::where('added_by', $data['employee'])
            ->where('transaction_date', '>=', $startDate)
            ->where('transaction_date', '<=', $endDate)
            ->where('group_id', 6)
            ->get();
        $data['deposit'] = $page_data->sum('debit');
        $page_data = Transactions::where('added_by', $data['employee'])
            ->where('transaction_date', '>=', $startDate)
            ->where('transaction_date', '<=', $endDate)
            ->where('group_id', 3)
            ->get();
        $data['loan'] = $page_data->sum('debit');
        $page_data = Transactions::where('added_by', $data['employee'])
            ->where('transaction_date', '>=', $startDate)
            ->where('transaction_date', '<=', $endDate)
            ->where('group_id', 4)
            ->get();
        $data['service_charge'] = $page_data->sum('debit');
        $page_data = Transactions::where('added_by', $data['employee'])
            ->where('transaction_date', '>=', $startDate)
            ->where('transaction_date', '<=', $endDate)
            ->where('group_id', 5)
            ->get();
        $data['insurance'] = $page_data->sum('debit');
        $data['total'] = $data['deposit'] + $data['loan'] + $data['service_charge'] + $data['insurance'];
//dd($data);
        //return view('admin.report.empWiseReport', $data);

        return view('admin.report.details', $data);
    }


    /*************************************
     *********Field Worker Report*********
     *************************************/

    public function lists($id, Request $r)
    {
        $data['branch'] = Branches::Where('id', session('branch_id'))->get();
        $data['employee'] = Employee::where('id', session('emp_id'))->first()->id;
        $data['d_date'] = date('Y/m/d') . ' - ' . date('Y/m/d');

        $data['branchList'] = Branches::Where('id', session('branch_id'))->get();
        $data['employeeList'] = Employee::where('id', session('emp_id'))->get();

        if ($_POST) {
            $data['branch'] = $r->input('branch_id');
            $data['employee'] = $r->input('emp_id');
            $data['d_date'] = $r->input('d_date');
        }
        $tmpDate = explode('-', $data['d_date']);
        $tmpDate2 = explode('/', $tmpDate[0]);
        $startDate = $tmpDate2[0] . '-' . $tmpDate2[1] . '-' . $tmpDate2[2];
        $tmpDate2 = explode('/', $tmpDate[1]);
        $endDate = $tmpDate2[0] . '-' . $tmpDate2[1] . '-' . $tmpDate2[2];
        //echo '|'.$startDate.'|'.$endDate.'|';
        $page_data = Transactions::where('added_by', $data['employee'])
            ->where('transaction_date', '>=', $startDate)
            ->where('transaction_date', '<=', $endDate)
            ->where('group_id', 6)
            ->get();
        $data['deposit'] = $page_data->sum('debit');
        $page_data = Transactions::where('added_by', $data['employee'])
            ->where('transaction_date', '>=', $startDate)
            ->where('transaction_date', '<=', $endDate)
            ->where('group_id', 3)
            ->get();
        $data['loan'] = $page_data->sum('debit');
        $page_data = Transactions::where('added_by', $data['employee'])
            ->where('transaction_date', '>=', $startDate)
            ->where('transaction_date', '<=', $endDate)
            ->where('group_id', 4)
            ->get();
        $data['service_charge'] = $page_data->sum('debit');
        $page_data = Transactions::where('added_by', $data['employee'])
            ->where('transaction_date', '>=', $startDate)
            ->where('transaction_date', '<=', $endDate)
            ->where('group_id', 5)
            ->get();
        $data['insurance'] = $page_data->sum('debit');
        $data['total'] = $data['deposit'] + $data['loan'] + $data['service_charge'] + $data['insurance'];
//dd($data);
        return view('admin.report.empWiseReport', $data);
    }
    protected function deposit_report_pdf(Request $r)
    {
        $data['prokolpoList'] = Prokolpos::where('status', 1)->where('type', 1)->get();
        $data['branchList'] = Branches::Where('status', 1)->get();
        $data['memberList'] = Members::where('status', 1)->get();
        $data['prokolpo'] = 'all';
        $data['branch'] = 'all';
        $data['member'] = 'all';
        $data['d_date'] = date('Y/m/d') . ' - ' . date('Y/m/d');

        if ($_POST) {
            $data['prokolpo'] = $r->input('prokolpo');
            $data['branch'] = $r->input('branch_id');
            if ($data['branch'] != 'all') {
                $data['memberList'] = Members::where('branch_id', $data['branch'])->get();
            }

            $data['member'] = $r->input('member_id');
            $data['d_date'] = $r->input('d_date');
            //echo '<pre>';
            // print_r($_POST);
        }


        $tmpDate = explode('-', $data['d_date']);
        $tmpDate2 = explode('/', $tmpDate[0]);
        $startDate = $tmpDate2[0] . '-' . $tmpDate2[1] . '-' . $tmpDate2[2];
        $tmpDate2 = explode('/', $tmpDate[1]);
        $endDate = $tmpDate2[0] . '-' . $tmpDate2[1] . '-' . $tmpDate2[2];

        if ($data['prokolpo'] == 'all') {
            $pr = array(1, 2);
        } else {
            if ($data['prokolpo'] == 2) {
                $pr = array(1);
            } elseif ($data['prokolpo'] == 3) {
                $pr = array(2);
            }
        }

        if($data['member']=='all'){
            if($data['branch']=='all'){
                $mem=Members::where('status',1)->get(['id']);
            }else{
                $mem=Members::where('branch_id',$data['branch'])->where('status',1)->get(['id']);
            }
        }else{
            $mem=array($data['member']);
        }


        $data['page_data'] = Transactions::where('group_id', 6)
            ->where('transaction_date', '>=', $startDate)
            ->where('transaction_date', '<=', $endDate)
            ->whereIn('sub_group_id',$pr)
            ->whereIn('member_id',$mem)
            ->get();

        return view('admin.report.depositReportPdf', $data);
    }
    public function lists_details($type, $id)
    {
        if ($type == 'depositReceived') {
            $data['page_title'] = 'সঞ্চয় আদায়';

            $data['page_data'] = Transactions::where('added_by', $id)
                //->where('transaction_date', '>=', $startDate)
                //->where('transaction_date', '<=', $endDate)
                ->where('group_id', 6)
                ->orderBy('transaction_date', 'asc')
                ->get();

            $data['total'] = $data['page_data']->sum('debit');
        } elseif ($type == 'loanReceived') {
            $data['page_title'] = 'ঋণ আদায়';

            $data['page_data'] = Transactions::where('added_by', $id)
                //->where('transaction_date', '>=', $startDate)
                //->where('transaction_date', '<=', $endDate)
                ->where('group_id', 3)
                ->orderBy('transaction_date', 'asc')
                ->get();

            $data['total'] = $data['page_data']->sum('debit');
        } elseif ($type == 'serviceChargeReceived') {
            $data['page_title'] = 'সার্ভিস চার্জ আদায়';

            $data['page_data'] = Transactions::where('added_by', $id)
                //->where('transaction_date', '>=', $startDate)
                //->where('transaction_date', '<=', $endDate)
                ->where('group_id', 4)
                ->orderBy('transaction_date', 'asc')
                ->get();

            $data['total'] = $data['page_data']->sum('debit');
        } elseif ($type == 'insuranceReceived') {
            $data['page_title'] = 'ঋণ বীমা আদায়';

            $data['page_data'] = Transactions::where('added_by', $id)
                //->where('transaction_date', '>=', $startDate)
                //->where('transaction_date', '<=', $endDate)
                ->where('group_id', 5)
                ->orderBy('transaction_date', 'asc')
                ->get();

            $data['total'] = $data['page_data']->sum('debit');
        }


        return view('admin.report.empWiseReportDetails', $data);
    }

}

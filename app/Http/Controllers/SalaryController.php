<?php

namespace App\Http\Controllers;

use App\Branches\Branches;
use App\Employee\Employee;
use App\Model\Attendances;
use App\Model\Company_accounts;
use App\Model\Employee_accounts;
use App\Model\Salary;
use App\Model\Salary_advance;
use App\Model\Transactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SalaryController extends Controller
{
    public static $bn_digits = array('০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯');
    public static $en_digits = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');

    protected function add_salary()
    {
        return view('admin.salary.add_salary');
    }

    protected function add_salary_post(Request $r)
    {
        $chk_salary = Salary::where('salary_month', date('Y-m'))->get();

        if (sizeof($chk_salary) == 0) {
            $emp = Employee::where('status', 1)->get();
            $tmpWrkngDay = str_replace(self::$bn_digits, self::$en_digits, $r->input('working_day'));

            foreach ($emp as $row) {
                $sal = new Salary();
                $sal->salary_month = $r->input('sal_mnth');
                $sal->working_day = $tmpWrkngDay;
                $sal->emp_id = $row->id;
                $sal->basic_salary = $row->basic_salary;
                $sal->overtime = 0;
                $sal->bonus = 0;

                $tmpAttndnc = Attendances::where('emp_id', $row->id)->where('attendance_date', 'like', $r->input('sal_mnth') . '%')->get();

                if (sizeof($tmpAttndnc) == 0) {
                    $tmpAttndnc = 0;
                } else {
                    $tmpAttndnc = sizeof($tmpAttndnc);
                }
                $sal->attendence = $tmpAttndnc;

                $leave = $tmpWrkngDay >= $tmpAttndnc;

                $deducVal = 0;
                $deducDes = '';
                if ($leave != 0 && $leave > 0) {
                    $deducVal = ($row->basic_salary / 30) * $leave;
                    $deducDes = 'Leave deduction : ' . $deducVal;
                }
                $sal->deduction = $deducVal;
                $sal->description = $deducDes;
                $sal->addition = 0;

                $tmpAdvSal = Salary_advance::where('emp_id', $row->id)->where('advance_month', $r->input('sal_mnth'))->get();
                if (sizeof($tmpAdvSal) == 0) {
                    $tmpAdvSal = 0;
                } else {
                    $tmpAdvSal = $tmpAdvSal->sum('amount');
                }

                $sal->advance = $tmpAdvSal;
                $sal->mobile = 0;
                $sal->created_by = session('emp_id');
                $sal->created_at = date('Y-m-d');

                $sal->save();
            }

            return redirect('admin/salary')->with('success', 'বর্তমান মাসের বেতন সংযোজন করা হয়েছে');
        } else {
            return redirect('admin/salary')->with('warning', 'বর্তমান মাসের বেতন পূর্বেই সংযোজন করা হয়েছে');
        }
    }

    //checked
    protected function salary(Request $r)
    {
        if (session('role') == 1) {
            $data['branch'] = Branches::where('status', 1)->get();
        } else {
            $data['branch'] = Branches::where('status', 1)->where('id', session('branch_id'))->get();
        }

        $data['crr_mnth'] = date('Y-m');
        $data['crr_brnch'] = $data['branch'][0]->id;

        if ($_POST) {
            $data['crr_mnth'] = $r->input('startDate');
            $data['crr_brnch'] = $r->input('branch');
        }

        $brnch = $data['crr_brnch'];
        $data['page_info'] = Salary::with(['hasEmployee' => function ($member) use ($brnch) {
            $member->where('branch_id', '=', $brnch);
        }])->where('salary_month', $data['crr_mnth'])
            ->orderBy('id', 'desc')
            ->get();

        // dd($data);
        //echo '<pre>'; print_r($data); die();

        return view('admin.salary.salary', $data);
    }   

    protected function advance()
    {
        $data['branch'] = Branches::where('status', 1)->get();
        $data['employees'] = Salary_advance::with('hasEmployee.hasBranch')->get();
        return view('admin.salary.advance', $data);
    }

    protected function new_advance()
    {
        if (session('role') == 1) {
            $data['employeeId'] = Employee::where('status', 1)->get();
        } elseif (session('role') == 2 || session('role') == 3 || session('role') == 4) {
            $data['employeeId'] = Employee::where('status', 1)->where('branch_id', session('branch_id'))->get();
        }

        return view('admin.salary.new_advance', $data);
    }

    protected function new_advance_post(Request $r)
    {
        //echo '<pre>'; print_r($_POST); die();
        $validator = Validator::make($r->all(), [
            'employeeId' => 'required',
            'month' => 'required',
            'amount' => 'required',
            'description' => 'required',
            'dateReceived' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('admin/new_advance')
                ->withInput($r->all())
                ->withErrors($validator->errors())
                ->with('warning', 'অনুগ্রহ করে সঠিকভাবে তথ্য প্রদান করুন');
        } else {
            $tmpEx = Employee::find($r->input('employeeId'));

            /**transaction**/
            $tran = new Transactions();
            $tran->created_at = date('Y-m-d');
            $tran->debit = 0;
            $tran->group_id = 8;
            $tran->sub_group_id = 0;
            $tran->account_group_id = 5;//5=expense
            $tran->sub_account_group_id = 1;
            $tran->employee_id = $r->input('employeeId');
            $tran->transaction_date = $r->input('dateReceived');
            $tran->added_by = session('emp_id');
            $tran->member_id = 0;
            $tran->credit = str_replace(self::$bn_digits, self::$en_digits, $r->input('amount'));

            $tran->description = $tmpEx->name . ' এর ' . str_replace(self::$bn_digits, self::$en_digits, $r->input('month')) . ' মাসের অগ্রিম বেতন  - ' . str_replace(self::$bn_digits, self::$en_digits, $r->input('amount')) . ' টাকা ';
            $tran->comment = $r->input('description');
            $tran->save();

            /**Salary advance**/
            $store = new Salary_advance();
            $store->emp_id = $r->input('employeeId');
            $store->advance_month = $r->input('month');
            $store->amount = str_replace(self::$bn_digits, self::$en_digits, $r->input('amount'));
            $store->description = $r->input('description');
            $store->advance_received = $r->input('dateReceived');
            $store->transaction_id = $tran->id;
            $store->created_at = date('Y-m-d');
            $store->save();

            /**company account**/
            $cmp_acc = new Company_accounts();
            $cmp_acc->transaction_id = $tran->id;
            $cmp_acc->description = $tmpEx->name . ' এর ' . str_replace(self::$bn_digits, self::$en_digits, $r->input('month')) . ' মাসের অগ্রিম বেতন  - ' . str_replace(self::$bn_digits, self::$en_digits, $r->input('amount')) . ' টাকা ';
            $cmp_acc->credit = str_replace(self::$bn_digits, self::$en_digits, $r->input('amount'));
            $cmp_acc->debit = 0;
            $cmp_acc->group_id = 8;
            $cmp_acc->account_group_id = 5;///asset
            $cmp_acc->sub_account_group_id = 1;///cash
            $cmp_acc->created_at = date('Y-m-d');
            $cmp_acc->save();

            /**employee account**/
            $empAcc = new Employee_accounts();
            $empAcc->emp_id = $r->input('employeeId');
            $empAcc->description = $tmpEx->name . ' এর ' . str_replace(self::$bn_digits, self::$en_digits, $r->input('month')) . ' মাসের অগ্রিম বেতন  - ' . str_replace(self::$bn_digits, self::$en_digits, $r->input('amount')) . ' টাকা ';
            $empAcc->debit = str_replace(self::$bn_digits, self::$en_digits, $r->input('amount'));
            $empAcc->credit = 0;
            $empAcc->group_id = 8;
            $empAcc->transaction_id = $tran->id;
            $empAcc->created_at = date('Y-m-d');
            $empAcc->save();

            return redirect('/admin/advance')->with('success', 'কার্যক্রমটি সফল হয়েছে');
        }

    }

    protected function advance_edit($id)
    {
        if (session('role') == 1) {
            $data['employeeId'] = Employee::where('status', 1)->get();
        } elseif (session('role') == 2 || session('role') == 3 || session('role') == 4) {
            $data['employeeId'] = Employee::where('status', 1)->where('branch_id', session('branch_id'))->get();
        }
        $data['page_info'] = Salary_advance::with('hasEmployee')->where('id', $id)->first();
        //dd($data);
        return view('admin.salary.edit_advance', $data);
    }

    protected function advance_edit_post(Request $r){
        $id=$r->input('advance_salary_id');
        $validator = Validator::make($r->all(), [
            'employeeId' => 'required',
            'month' => 'required',
            'amount' => 'required',
            'description' => 'required',
            'dateReceived' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('admin/advance/'.$id.'/edit')
                ->withInput($r->all())
                ->withErrors($validator->errors())
                ->with('warning', 'অনুগ্রহ করে সঠিকভাবে তথ্য প্রদান করুন');
        } else {
            /**Salary advance**/
            $tmpEx = Employee::find($r->input('employeeId'));

            $store['emp_id'] = $r->input('employeeId');

            $store['advance_month'] = $r->input('month');
            $store['amount'] = str_replace(self::$bn_digits, self::$en_digits, $r->input('amount'));
            $store['description'] = $r->input('description');
            $store['advance_received'] = $r->input('dateReceived');
            Salary_advance::where('id',$id)->update($store);

            $tmpTrnId=Salary_advance::find($id)->transaction_id;

            /**transaction**/
            $tran['employee_id'] = $r->input('employeeId');
            $tran['transaction_date'] = $r->input('dateReceived');
            $tran['credit'] = str_replace(self::$bn_digits, self::$en_digits, $r->input('amount'));
            $tran['description'] = $tmpEx->name . ' এর ' . str_replace(self::$bn_digits, self::$en_digits, $r->input('month')) . ' মাসের অগ্রিম বেতন  - ' . str_replace(self::$bn_digits, self::$en_digits, $r->input('amount')) . ' টাকা ';
            $tran['comment'] = $r->input('description');
            Transactions::where('id',$tmpTrnId)->update($tran);

            /**company account**/
            $cmp_acc['description'] = $tmpEx->name . ' এর ' . str_replace(self::$bn_digits, self::$en_digits, $r->input('month')) . ' মাসের অগ্রিম বেতন  - ' . str_replace(self::$bn_digits, self::$en_digits, $r->input('amount')) . ' টাকা ';
            $cmp_acc['credit'] = str_replace(self::$bn_digits, self::$en_digits, $r->input('amount'));
            Company_accounts::where('transaction_id',$tmpTrnId)->update($cmp_acc);

            /**employee account**/
            $empAcc['emp_id'] = $r->input('employeeId');
            $empAcc['description'] = $tmpEx->name . ' এর ' . str_replace(self::$bn_digits, self::$en_digits, $r->input('month')) . ' মাসের অগ্রিম বেতন  - ' . str_replace(self::$bn_digits, self::$en_digits, $r->input('amount')) . ' টাকা ';
            $empAcc['debit'] = str_replace(self::$bn_digits, self::$en_digits, $r->input('amount'));
            Employee_accounts::where('transaction_id',$tmpTrnId)->update($empAcc);

            return redirect('/admin/advance')->with('success', 'কার্যক্রমটি সফল হয়েছে');
        }
    }

}

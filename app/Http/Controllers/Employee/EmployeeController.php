<?php

namespace App\Http\Controllers\Employee;

use App\Branches\Branches;
use App\Employee\Employee;
use App\Employee\EmployeeDetail;
use App\Http\Controllers\LocationController;
use App\Members\Members;
use App\Model\Designations;
use App\Model\Member_emp_rels;
use App\Model\Roles;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    public static $bn_digits = array('০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯');
    public static $en_digits = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');

    protected function index()
    {
        if(session('role')==1){
            $data['employees'] = Employee::with('hasBranch')->with('hasDesignation')->with('hasRole')->get();
        }else{
            $data['employees'] = Employee::with('hasBranch')->with('hasDesignation')->with('hasRole')->where('branch_id',session('branch_id'))->get();
        }

        return view('admin.employee.view', $data);
    }

    protected function create()
    {
        $data['branches'] = Branches::orderBy('created_at', 'desc')->get(['id', 'name']);
        $data['bloodGroups'] = LocationController::getBloodGroup();
        $data['educations'] = LocationController::education();
        $data['designation'] = Designations::where('status', 1)->orderBy('priority', 'asc')->get(['id', 'name']);
        $data['roles'] = Roles::where('status',1)->orderBy('priority','asc')->get();
        return view('admin.employee.create', $data);
    }

    protected function store(Request $r)
    {
        $validator = Validator::make($r->all(), [
            'name' => 'required|min:4',
            'nid' => 'required|min:17|max:17',
            'mobile' => 'required|max:11|min:6',
            'present_add' => 'required',
            'permanent_add' => 'required',
            'dob' => 'required',
            'religion' => 'required',
            'gender' => 'required',
            'marital_status' => 'required',
            'designation' => 'required',
            'education' => 'required',
            'branch' => 'required',
            'role' => 'required',
            'basicSalary' => 'required',
            //'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
        ]);

        if ($validator->fails()) {
            return redirect('admin/employee/create')
                ->withInput($r->all())
                ->withErrors($validator->errors())
                ->with('warning', 'অনুগ্রহ করে সঠিকভাবে তথ্য প্রদান করুন');
        } else {

            $tempEmp = Employee::orderBy('id', 'desc')->first();

            if (sizeof($tempEmp) != 0) {
                $tmpId = $tempEmp->id + 1;
            } else {
                $tmpId = 1;
            }
            $empId = sprintf("%'.06d\n", $tmpId);
            $store = new Employee();
            $store->id_card_no = $empId;
            $store->name = $r->input('name');
            $store->nid = str_replace(self::$bn_digits, self::$en_digits, $r->input('nid'));
            $store->mobile = str_replace(self::$bn_digits, self::$en_digits, $r->input('mobile'));
            $store->pic = 'no_img.png';
            $store->branch_id = $r->input('branch');
            $store->designation_id = $r->input('designation');
            $store->role_id = $r->input('role');
            $store->basic_salary = $r->input('basicSalary');
            $store->save();

            if ($_FILES['image']['error'] == 0) {
                $imageName = 'employee_' . $store->id . '.' . $r->image->getClientOriginalExtension();
                $r->image->move(public_path('img/employee'), $imageName);

                Employee::where('id', $store->id)->update(['pic' => $imageName]);
            }


            $emp_details = new EmployeeDetail();
            $emp_details->emp_id = $store->id;
            $dobFormat = $r->input('dob');
            $new_date = explode("/", $dobFormat);
            $final_dob = $new_date[2] . "-" . $new_date[0] . "-" . $new_date[1];
            $emp_details->dob = $final_dob;
            $emp_details->gender = $r->input('gender');
            $emp_details->maritial_status = $r->input('marital_status');
            $emp_details->blood_group_id = $r->input('bloodGroup');
            $emp_details->nationality = $r->input('nationality');
            $emp_details->religion = $r->input('religion');
            $emp_details->father_name = $r->input('fatherName');
            $emp_details->mother_name = $r->input('motherName');
            $emp_details->present_address = $r->input('present_add');
            $emp_details->permanent_address = $r->input('permanent_add');
            $emp_details->education_id = $r->input('education');
            $emp_details->join_date = date('Y-m-d');
            $emp_details->save();

            if ($r->input('is_login') == 1) {
                $login = new User();
                $login->emp_id = $store->id;
                $login->role = $r->input('role');
                $login->phone = str_replace(self::$bn_digits, self::$en_digits, $r->input('mobile'));
                $login->password = bcrypt('123456');
                $login->created_at = date('Y-m-d');
                $login->remember_token = random_int(10000, 99999);

                $login->save();
            }

            return redirect('/admin/employee')->with('success', 'কর্মকর্তা/কর্মচারী সফলভাবে সংযোজন করা হয়েছে');
        }
    }

    protected function edit($id)
    {
        $data['employees'] = Employee::with('hasEmployeeDetails')->where('id', $id)->get();
        //dd($data);
        $data['is_login'] = User::where('emp_id', $id)->get();
        $data['branches'] = Branches::orderBy('created_at', 'desc')->get(['id', 'name']);
        $data['bloodGroups'] = LocationController::getBloodGroup();
        $data['educations'] = LocationController::education();
        $data['designation'] = Designations::where('status', 1)->orderBy('priority', 'asc')->get(['id', 'name']);
        $data['roles'] = Roles::where('status',1)->orderBy('priority','asc')->get();
        return view('admin.employee.edit', $data);
    }

    protected function update(Request $r)
    {
        $id = $r->input('emp_id');
        $validator = Validator::make($r->all(), [
            'name' => 'required|min:4',
            'nid' => 'required|min:17|max:17',
            'mobile' => 'required|max:11|min:6',
            'present_add' => 'required',
            'permanent_add' => 'required',
            'dob' => 'required',
            'religion' => 'required',
            'gender' => 'required',
            'marital_status' => 'required',
            'designation' => 'required',
            'education' => 'required',
            'branch' => 'required',
            'role' => 'required',
            'basicSalary' => 'required',
            
            //'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
        ]);

        if ($validator->fails()) {
            return redirect('admin/employee' . $id . '/edit')
                ->withInput($r->all())
                ->withErrors($validator->errors())
                ->with('warning', 'অনুগ্রহ করে সঠিকভাবে তথ্য প্রদান করুন');
        } else {

            $store['name'] = $r->input('name');
            $store['nid'] = str_replace(self::$bn_digits, self::$en_digits, $r->input('nid'));
            $store['mobile'] = str_replace(self::$bn_digits, self::$en_digits, $r->input('mobile'));
            $store['branch_id'] = $r->input('branch');
            $store['designation_id'] = $r->input('designation');
            $store['role_id'] = $r->input('role');
            $store['basic_salary'] = $r->input('basicSalary');

            Employee::where('id', $id)->update($store);

            if ($_FILES['image']['error'] == 0) {
                $imageName = 'employee_' . $id . '.' . $r->image->getClientOriginalExtension();
                $r->image->move(public_path('img/employee'), $imageName);

                Employee::where('id', $id)->update(['pic' => $imageName]);
            }

            $dobFormat = str_replace(self::$bn_digits, self::$en_digits, $r->input('dob'));
            $new_date = explode("/", $dobFormat);
            $final_dob = $new_date[2] . "-" . $new_date[0] . "-" . $new_date[1];
            $emp_details['dob'] = $final_dob;
            $emp_details['gender'] = $r->input('gender');
            $emp_details['maritial_status'] = $r->input('marital_status');
            $emp_details['blood_group_id'] = $r->input('bloodGroup');
            $emp_details['nationality'] = $r->input('nationality');
            $emp_details['religion'] = $r->input('religion');
            $emp_details['father_name'] = $r->input('fatherName');
            $emp_details['mother_name'] = $r->input('motherName');
            $emp_details['present_address'] = $r->input('present_add');
            $emp_details['permanent_address'] = $r->input('permanent_add');
            $emp_details['education_id'] = $r->input('education');

            EmployeeDetail::where('emp_id', $id)->update($emp_details);

            $tmpUser = User::where('emp_id', $id)->get();

            if (sizeof($tmpUser) == 0) {
                if ($r->input('is_login') == 1) {
                    $login = new User();
                    $login->emp_id = $id;
                    $login->role = $r->input('role');
                    $login->phone = str_replace(self::$bn_digits, self::$en_digits, $r->input('mobile'));
                    $login->password = bcrypt('123456');
                    $login->created_at = date('Y-m-d');
                    $login->remember_token = random_int(10000, 99999);

                    $login->save();
                }
            }else{
                if ($r->input('is_login')!=1) {
                    User::where('emp_id',$id)->delete();
                }
            }
            
            User::where('emp_id',$id)->update(['role' => $r->input("role")]);


            return redirect('/admin/employee')->with('success', 'কর্মকর্তা/কর্মচারীর তথ্য সফলভাবে সংশোধন করা হয়েছে');
        }
    }

    protected function details($id)
    {
        $data['empInfo'] = Employee::with('hasEmployeeDetails.hasBloodGroup')
            ->with('hasEmployeeDetails.hasEducation')
            ->with('hasBranch')
            ->with('hasDesignation')
            ->where('id', $id)->get();

        $data['assign_member']=Member_emp_rels::with('hasMember')->where('emp_id',$id)->get();
        //dd($data);

        $data['page_title'] = $data['empInfo'][0]->name . ' এর প্রোফাইল ';
        return view('admin.employee.details', $data);
    }

    protected function delete($id)
    {
        $tmpEmp = Employee::where('id', $id)->first();

        if ($tmpEmp->pic != 'no_img.png') {
            unlink(public_path('img\employee\\' . $tmpEmp->pic));
        }

        Employee::where('id', $id)->delete();
        EmployeeDetail::where('emp_id', $id)->delete();

        return redirect('admin/employee')->with('success', 'কার্যক্রমটি সফল হয়েছে');
    }
    
    protected function emp_assign(Request $r){
        
        $rel=new Member_emp_rels();
        $rel->emp_id=$r->input('emp_id');
        $rel->member_id=$r->input('member_id');
        $rel->added_by=1; //session val hbe
        $rel->created_at=date('Y-m-d');

        $rel->save();

        Members::where('id',$r->input('member_id'))->update(['status'=>1]);
        return redirect('admin/member/lists/New')->with('success', 'কার্যক্রমটি সফল হয়েছে');
    }
}

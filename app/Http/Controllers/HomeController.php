<?php

namespace App\Http\Controllers;

use App\Employee\Employee;
use App\Members\Members;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        ////header///
        $tmpEmp=Auth::user()->emp_id;
        $data['logged_info']=Employee::where('id',$tmpEmp)->get();

        Session::put('login_id', Auth::user()->id);
        Session::put('emp_id', $tmpEmp);
        Session::put('name', $data['logged_info'][0]->name);
        Session::put('pic', $data['logged_info'][0]->pic);
        Session::put('role', $data['logged_info'][0]->role_id);
        Session::put('branch_id', $data['logged_info'][0]->branch_id);

        if(session('role')==1){
            $data['applied_member']=Members::where('status',0)->get();            
            $data['total_employee']=Employee::where('status',1)->get();
        }elseif(session('role')==2 || session('role')==3 || session('role')==4){
            $data['new_member']=Members::whereIn('status',[6,7])->where('branch_id',session('branch_id'))->get();
            $data['total_employee']=Employee::where('status',1)->where('branch_id',session('branch_id'))->get();
        }

        return view('home',$data);
    }
}

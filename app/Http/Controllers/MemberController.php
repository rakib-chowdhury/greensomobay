<?php

namespace App\Http\Controllers;

use App\Employee\Employee;
use App\Members\MemberDetail;
use App\Members\Members;
use App\Model\Loan_request_lists;
use App\Model\Member_emp_rels;
use App\Model\Member_resignations;
use App\Model\Partial_savings;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class MemberController extends Controller
{
    protected function lists($type)
    {
        $data['type'] = $type;
        if ($type == 'new') {
            $data['page_title'] = 'আবেদনকৃত সদস্য';
            $data['members'] = Members::with('hasBranch')->where('status', 0)->orderBy('id', 'desc')->get();
        } elseif ($type == 'New') {
            $data['page_title'] = 'নতুন সদস্য';
            $data['employees'] = Employee::where('status', 1)->where('branch_id', session('branch_id'))->where('designation_id', 4)->get();
            $data['members'] = Members::with('hasBranch')->whereIn('status', [6, 7])->where('branch_id', session('branch_id'))->orderBy('id', 'desc')->get();
        } elseif ($type == 'approved') {
            $data['page_title'] = 'অনুমোদনকৃত সদস্য';

            if (session('role') == 1) {
                $data['members'] = Members::with('hasBranch')->whereIn('status', [1, 6, 7])->orderBy('id', 'desc')->get();
            } else {
                $data['members'] = Members::with('hasBranch')->where('branch_id', session('branch_id'))->where('status', 1)->orderBy('id', 'desc')->get();
            }

        } elseif ($type == 'reject') {
            $data['page_title'] = 'বাতিলকৃত সদস্য';
            if (session('role') == 1) {
                $data['members'] = Members::with('hasBranch')->where('status', 2)->orderBy('id', 'desc')->get();
            } else {
                $data['members'] = Members::with('hasBranch')->where('status', 2)->where('branch_id', session('branch_id'))->orderBy('id', 'desc')->get();
            }

        } elseif ($type == 'block') {
            $data['page_title'] = 'ব্লককৃত সদস্য';
            if (session('role') == 1) {
                $data['members'] = Members::with('hasBranch')->where('status', 4)->orderBy('id', 'desc')->get();
            } else {
                $data['members'] = Members::with('hasBranch')->where('status', 4)->where('branch_id', session('branch_id'))->orderBy('id', 'desc')->get();
            }

        }

        return view('admin.member.lists', $data);
    }

    protected function details($type, $id)
    {
        $data['memberInfo'] = Members::with('hasMemberDetails.hasBloodGroup')
            ->with('hasMemberDetails.hasEducation')
            ->with('hasMemberDetails.hasCurrDivision')
            ->with('hasMemberDetails.hasPerDivision')
            ->with('hasMemberDetails.hasCurrDistrict')
            ->with('hasMemberDetails.hasPerDistrict')
            ->with('hasMemberDetails.hasCurrUpz')
            ->with('hasMemberDetails.hasPerUpz')
            ->with('hasBranch')
            ->where('id', $id)->get();
        $data['assign_emp'] = Member_emp_rels::with('hasEmployee')->where('member_id', $id)->get();
        //dd($data);

        $data['page_title'] = $data['memberInfo'][0]->name . ' এর প্রোফাইল ';
        return view('admin.member.details', $data);
    }

    protected function approved($type, $id)
    {
        Members::where('id', $id)->update(['status' => 7]);

        return redirect('admin/member/lists/' . $type)->with('success', 'কার্যক্রমটি সফল হয়েছে');
    }

    protected function reject($type, $id)
    {
        Members::where('id', $id)->update(['status' => 2]);

        return redirect('admin/member/lists/' . $type)->with('success', 'কার্যক্রমটি সফল হয়েছে');
    }

    protected function block($type, $id)
    {
        Members::where('id', $id)->update(['status' => 4]);

        return redirect('admin/member/lists/' . $type)->with('success', 'কার্যক্রমটি সফল হয়েছে');
    }

    protected function delete($type, $id)
    {
        $tmpEmp = Members::where('id', $id)->first();
        if ($tmpEmp->pic != 'no_img.png') {
            unlink(public_path('img\member\\' . $tmpEmp->pic));
        }


        $tmpEmpDtls = MemberDetail::where('members_id', $id)->first();
        if ($tmpEmpDtls->nominee_picture != 'no_img.png') {
            unlink(public_path('img\member\\' . $tmpEmpDtls->nominee_picture));
        }


        Members::where('id', $id)->delete();
        MemberDetail::where('members_id', $id)->delete();

        return redirect('admin/member/lists/' . $type)->with('success', 'কার্যক্রমটি সফল হয়েছে');;
    }


    //resignation
    protected function memberResignation($type)
    {
        $data['type'] = $type;
        if ($type == 'new') {
            $data['page_title'] = 'আবেদনকৃত সদস্য প্রত্যাহার     ';
        } elseif ($type == 'all') {
            $data['page_title'] = 'সকল সদস্য প্রত্যাহার';
        }

        $data['type'] = $type;
        if ($type == 'new') {
            $data['page_title'] = 'আবেদনকৃত সদস্য প্রত্যাহার ';
            if (session('role') == 1) {
                $data['page_info'] = Member_resignations::with('hasMember')->where('status', 3)->get();
            } elseif (session('role') == 2 || session('role') == 3) {
                $data['page_info'] = Partial_savings::with(['hasMember' => function ($member) {
                    $member->where('branch_id', '=', session('branch_id'));
                }])->where('status', 1)
                    ->orderBy('id', 'desc')
                    ->get();
            } elseif (session('role') == 4) {
                $data['page_info'] = Member_resignations::with(['hasMember' => function ($member) {
                    $member->where('branch_id', '=', session('branch_id'));
                }])->where('status', 0)
                    ->orderBy('id', 'desc')
                    ->get();
            }
        } elseif ($type == 'approved') {
            $data['page_title'] = 'অনুমোদনকৃত সদস্য প্রত্যাহার ';

            if (session('role') == 1) {
                $data['page_info'] = Member_resignations::with('hasMember')->where('status', 5)->get();
            } elseif (session('role') == 2 || session('role') == 3) {
                $data['page_info'] = Partial_savings::with(['hasMember' => function ($member) {
                    $member->where('branch_id', '=', session('branch_id'));
                }])->where('status', 3)
                    ->orderBy('id', 'desc')
                    ->get();
            } elseif (session('role') == 4) {
                $data['page_info'] = Member_resignations::with(['hasMember' => function ($member) {
                    $member->where('branch_id', '=', session('branch_id'));
                }])->where('status', 1)
                    ->orderBy('id', 'desc')
                    ->get();
            }

        } elseif ($type == 'reject') {
            $data['page_title'] = 'বাতিলকৃত সদস্য প্রত্যাহার ';

            if (session('role') == 1) {
                $data['page_info'] = Member_resignations::with('hasMember')->where('status', 6)->get();
            } elseif (session('role') == 2 || session('role') == 3) {
                $data['page_info'] = Partial_savings::with(['hasMember' => function ($member) {
                    $member->where('branch_id', '=', session('branch_id'));
                }])->where('status', 4)
                    ->orderBy('id', 'desc')
                    ->get();
            } elseif (session('role') == 4) {
                $data['page_info'] = Member_resignations::with(['hasMember' => function ($member) {
                    $member->where('branch_id', '=', session('branch_id'));
                }])->where('status', 2)
                    ->orderBy('id', 'desc')
                    ->get();
            }else{
                $data['page_info']='';
            }

        }

        return view('admin.member.resignation.memberResignationForm', $data);
    }

    protected function memberResignation_approve($id, $type)
    {
        if (session('role') == 1) {
            Member_resignations::where('id', $id)->update(['status' => 5]);
        } elseif (session('role') == 2 || session('role') == 3) {
            Member_resignations::where('id', $id)->update(['status' => 3]);
        } elseif (session('role') == 4) {
            Member_resignations::where('id', $id)->update(['status' => 1]);
        }
        return redirect('admin/memberResignation/' . $type)->with('success', 'কার্যক্রমটি সফল হয়েছে');
    }

    protected function memberResignation_reject($id, $type)
    {
        if (session('role') == 1) {
            Member_resignations::where('id', $id)->update(['status' => 6]);
        } elseif (session('role') == 2 || session('role') == 3) {
            Member_resignations::where('id', $id)->update(['status' => 4]);
        } elseif (session('role') == 4) {
            Member_resignations::where('id', $id)->update(['status' => 2]);
        }
        return redirect('admin/memberResignation/' . $type)->with('success', 'কার্যক্রমটি সফল হয়েছে');
    }


    //partialDeposit
    protected function partialDeposit($type)
    {
        $data['type'] = $type;
        if ($type == 'new') {
            $data['page_title'] = 'আবেদনকৃত আংশিক সঞ্চয় উত্তোলন';
            if (session('role') == 1) {
                $data['page_info'] = Partial_savings::with('hasMember')->where('status', 3)->get();
            } elseif (session('role') == 2 || session('role') == 3) {
                $data['page_info'] = Partial_savings::with(['hasMember' => function ($member) {
                    $member->where('branch_id', '=', session('branch_id'));
                }])->where('status', 1)
                    ->orderBy('id', 'desc')
                    ->get();
            } elseif (session('role') == 4) {
                $data['page_info'] = Partial_savings::with(['hasMember' => function ($member) {
                    $member->where('branch_id', '=', session('branch_id'));
                }])->where('status', 0)
                    ->orderBy('id', 'desc')
                    ->get();
            }
        } elseif ($type == 'approved') {
            $data['page_title'] = 'অনুমোদনকৃত আংশিক সঞ্চয় উত্তোলন';

            if (session('role') == 1) {
                $data['page_info'] = Partial_savings::with('hasMember')->where('status', 5)->get();
            } elseif (session('role') == 2 || session('role') == 3) {
                $data['page_info'] = Partial_savings::with(['hasMember' => function ($member) {
                    $member->where('branch_id', '=', session('branch_id'));
                }])->where('status', 3)
                    ->orderBy('id', 'desc')
                    ->get();
            } elseif (session('role') == 4) {
                $data['page_info'] = Partial_savings::with(['hasMember' => function ($member) {
                    $member->where('branch_id', '=', session('branch_id'));
                }])->where('status', 1)
                    ->orderBy('id', 'desc')
                    ->get();
            }

        } elseif ($type == 'reject') {
            $data['page_title'] = 'বাতিলকৃত আংশিক সঞ্চয় উত্তোলন';

            if (session('role') == 1) {
                $data['page_info'] = Partial_savings::with('hasMember')->where('status', 6)->get();
            } elseif (session('role') == 2 || session('role') == 3) {
                $data['page_info'] = Partial_savings::with(['hasMember' => function ($member) {
                    $member->where('branch_id', '=', session('branch_id'));
                }])->where('status', 4)
                    ->orderBy('id', 'desc')
                    ->get();
            } elseif (session('role') == 4) {
                $data['page_info'] = Partial_savings::with(['hasMember' => function ($member) {
                    $member->where('branch_id', '=', session('branch_id'));
                }])->where('status', 2)
                    ->orderBy('id', 'desc')
                    ->get();
            }else{
                $data['page_info']='';
            }

        }
        return view('admin.member.partital_withdrawal.partialDepositForm', $data);
    }

    protected function partialDeposit_approve($id, $type)
    {
        if (session('role') == 1) {
            Partial_savings::where('id', $id)->update(['status' => 5]);
        } elseif (session('role') == 2 || session('role') == 3) {
            Partial_savings::where('id', $id)->update(['status' => 3]);
        } elseif (session('role') == 4) {
            Partial_savings::where('id', $id)->update(['status' => 1]);
        }
        return redirect('admin/partialDeposit/' . $type)->with('success', 'কার্যক্রমটি সফল হয়েছে');
    }

    protected function partialDeposit_reject($id, $type)
    {
        if (session('role') == 1) {
            Partial_savings::where('id', $id)->update(['status' => 6]);
        } elseif (session('role') == 2 || session('role') == 3) {
            Partial_savings::where('id', $id)->update(['status' => 4]);
        } elseif (session('role') == 4) {
            Partial_savings::where('id', $id)->update(['status' => 2]);
        }
        return redirect('admin/partialDeposit/' . $type)->with('success', 'কার্যক্রমটি সফল হয়েছে');
    }


    //loan
    protected function loan($type)
    {
        $data['type'] = $type;
        if ($type == 'new') {
            $data['page_title'] = 'আবেদনকৃত ঋণ';
            if (session('role') == 1) {
                $data['page_info'] = Loan_request_lists::with('hasMember')->where('status', 3)->get();
            } elseif (session('role') == 2 || session('role') == 3) {
                $data['page_info'] = Loan_request_lists::with(['hasMember' => function ($member) {
                    $member->where('branch_id', '=', session('branch_id'));
                }])->where('status', 1)
                    ->orderBy('id', 'desc')
                    ->get();
            } elseif (session('role') == 4) {
                $data['page_info'] = Loan_request_lists::with(['hasMember' => function ($member) {
                    $member->where('branch_id', '=', session('branch_id'));
                }])->where('status', 0)
                    ->orderBy('id', 'desc')
                    ->get();
            }
        } elseif ($type == 'approved') {
            $data['page_title'] = 'অনুমোদনকৃত ঋণ';

            if (session('role') == 1) {
                $data['page_info'] = Loan_request_lists::with('hasMember')->where('status', 5)->get();
            } elseif (session('role') == 2 || session('role') == 3) {
                $data['page_info'] = Loan_request_lists::with(['hasMember' => function ($member) {
                    $member->where('branch_id', '=', session('branch_id'));
                }])->where('status', 3)
                    ->orderBy('id', 'desc')
                    ->get();
            } elseif (session('role') == 4) {
                $data['page_info'] = Loan_request_lists::with(['hasMember' => function ($member) {
                    $member->where('branch_id', '=', session('branch_id'));
                }])->where('status', 1)
                    ->orderBy('id', 'desc')
                    ->get();
            }

        } elseif ($type == 'reject') {
            $data['page_title'] = 'বাতিলকৃত ঋণ';

            if (session('role') == 1) {
                $data['page_info'] = Loan_request_lists::with('hasMember')->where('status', 6)->get();
            } elseif (session('role') == 2 || session('role') == 3) {
                $data['page_info'] = Loan_request_lists::with(['hasMember' => function ($member) {
                    $member->where('branch_id', '=', session('branch_id'));
                }])->where('status', 4)
                    ->orderBy('id', 'desc')
                    ->get();
            } elseif (session('role') == 4) {
                $data['page_info'] = Loan_request_lists::with(['hasMember' => function ($member) {
                    $member->where('branch_id', '=', session('branch_id'));
                }])->where('status', 2)
                    ->orderBy('id', 'desc')
                    ->get();
            }else{
                $data['page_info']='';
            }

        }
        return view('admin.member.loan.loanForm', $data);
    }

    protected function loan_approve($id, $type)
    {
        if (session('role') == 1) {
            Loan_request_lists::where('id', $id)->update(['status' => 5]);
        } elseif (session('role') == 2 || session('role') == 3) {
            Loan_request_lists::where('id', $id)->update(['status' => 3]);
        } elseif (session('role') == 4) {
            Loan_request_lists::where('id', $id)->update(['status' => 1]);
        }
        return redirect('admin/loan/' . $type)->with('success', 'কার্যক্রমটি সফল হয়েছে');
    }

    protected function loan_reject($id, $type)
    {
        if (session('role') == 1) {
            Loan_request_lists::where('id', $id)->update(['status' => 6]);
        } elseif (session('role') == 2 || session('role') == 3) {
            Loan_request_lists::where('id', $id)->update(['status' => 4]);
        } elseif (session('role') == 4) {
            Loan_request_lists::where('id', $id)->update(['status' => 2]);
        }
        return redirect('admin/loan/' . $type)->with('success', 'কার্যক্রমটি সফল হয়েছে');
    }
}

<?php

namespace App\Http\Controllers\FrontForms;

use App\Branches\Branches;
use App\Http\Controllers\LocationController;
use App\Http\Requests\MembersRequestValidation;
use App\Location\District;
use App\Location\Division;
use App\Location\SubDistrict;
use App\Members\MemberDetail;
use App\Members\Members;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MemberApplyController extends Controller
{
    public static $bn_digits = array('০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯');
    public static $en_digits = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');

    protected function show()
    {
        $data['divisions'] = Division::all();
        $data['districts'] = District::where('division_id', $data['divisions'][0]->id)->get();
        $data['upz'] = SubDistrict::where('district_id', $data['districts'][0]->id)->get();
        $data['educations'] = LocationController::education();
        $data['blood'] = LocationController::getBloodGroup();
        $data['branch'] = Branches::where('status', 1)->get();
        return view('frontPages.forms.memberAdmit', $data);
    }

    protected function post(MembersRequestValidation $req)
    {
        //dd($req->all());
        $tempMem = Members::orderBy('id', 'desc')->first();
        if (sizeof($tempMem) != 0) {
            $tmpId = $tempMem->id + 1;
        } else {
            $tmpId = 1;
        }
        $memId = sprintf("%'.06d\n", $tmpId);

        $mem = new Members();
        $mem->registration_no = $memId;
        $mem->branch_id = $req->input('officeLocation');
        $mem->name = $req->input('applierName');
        $mem->phone = str_replace(self::$bn_digits, self::$en_digits, $req->input('phoneNumber'));
        $mem->nid = str_replace(self::$bn_digits, self::$en_digits, $req->input('idNumber'));
        $mem->pic = 'no_img.png';
        $mem->created_at = date('Y-m-d');

        $mem->save();

        $imageName = 'member_' . $mem->id . '.' . $req->picture->getClientOriginalExtension();
        $req->picture->move(public_path('img/member'), $imageName);

        Members::where('id', $mem->id)->update(['pic' => $imageName]);

        $memDtls = new MemberDetail();
        $memDtls->members_id = $mem->id;
        $memDtls->occupation = $req->input('applierOccupation');
        $memDtls->guardian_name = $req->input('guardianName');
        $memDtls->guardian_occupation = $req->input('guardianOccupation');
        $memDtls->mother_name = $req->input('motherName');
        $memDtls->mother_occupation = $req->input('motherOccupation');
        $memDtls->current_location = $req->input('location');
        $memDtls->current_postoffice = $req->input('postalLocation');
        $memDtls->current_upazila = $req->input('thana');
        $memDtls->current_district = $req->input('district');
        $memDtls->current_division = $req->input('division');
        $memDtls->permanent_location = $req->input('permanentLocation');
        $memDtls->permanent_postoffice = $req->input('permanentPostal');
        $memDtls->permanent_upazila = $req->input('permanentThana');
        $memDtls->permanent_district = $req->input('permanentDistrict');
        $memDtls->permanent_division = $req->input('permanentDivision');
        $memDtls->gender = $req->input('gender');

        if ($req->input('birthDate') != null || $req->input('birthDate') != '') {
            $tmpDate = explode('/', $req->input('birthDate'));
            $memDtls->birth_date = $tmpDate[2] . '-' . $tmpDate[1] . '-' . $tmpDate[0];
        }
        $memDtls->nationality = $req->input('nationalism');
        $memDtls->religion = $req->input('religion');
        $memDtls->blood_group = $req->input('bloodGroup');
        $memDtls->education_qualification = $req->input('educationQuality');
        $memDtls->marital_status = $req->input('maritalStatus');
        $memDtls->nominee_name = $req->input('nomineeName');
        $memDtls->nominee_relation = $req->input('nomineeRelation');
        $memDtls->nominee_picture = 'no_img.png';
        $memDtls->member_sign = 'no_img.png';
        $memDtls->created_at=date('Y-m-d');

        $memDtls->save();

        $imageName = 'nominee_' . $mem->id . '.' . $req->nomineePicture->getClientOriginalExtension();
        $req->nomineePicture->move(public_path('img/member'), $imageName);

        MemberDetail::where('id', $memDtls->id)->update(['nominee_picture' => $imageName]);

        $imageName = 'applicant_sign_' . $mem->id . '.' . $req->applicantSign->getClientOriginalExtension();
        $req->applicantSign->move(public_path('img/member'), $imageName);

        MemberDetail::where('id', $memDtls->id)->update(['member_sign' => $imageName]);

        return redirect('/member_admission')->with('success', 'আবেদন প্রক্রিয়া সফলভাবে সম্পন্ন হয়েছে');
    }
}

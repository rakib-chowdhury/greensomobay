@extends('layouts.public')

@section('customCss')
    <link rel="stylesheet" href="{{url('public')}}/css/selectize/selectize.css" type="text/css">
    <link rel="stylesheet" href="{{url('public')}}/css/edit-image/iEdit.css">
    <link rel="stylesheet" href="{{url('public')}}/css/datepicker/bootstrap-datepicker.css">
    <style>
        .input-group .form-control-select {
            margin-bottom: -6px
        }
    </style>
@endsection

@section('content')
    @php
    $bn_digits = array('০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯');
    @endphp
    <div class="content_info content_area_main">
        <div class="container">
            <div class="paddings-mini">
                <!--form title-->
                <div class="form-title title-vertical-line">
                    <h2><b>ঋণ আবেদন ফর্ম </b></h2>
                </div>
                <div class="paddings-mini"></div>
                <!--form CONTENT-->
                <div class="form-content">
                    <form id="loanApplicantForm" action="{{url('/loanApplicant')}}" class="form" method="post"
                          enctype="multipart/form-data">
                        {{csrf_field()}}
                        <input type="hidden" name="mem_id" value="{{$member_info->id}}">
                        <!-- to start -->
                        <div class="row">
                            <div class="form-group col-sm-12 {{ $errors->has('applierName') ? 'has-error' : '' }}">
                                <div class="row">
                                    <label for="applicantTo">বরাবর </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-12 {{ $errors->has('applierOccupation') ? 'has-error' : '' }}">
                                <div class="row">
                                    <label for="president">সভাপতি </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-12 {{ $errors->has('applierOccupation') ? 'has-error' : '' }}">
                                <div class="row">
                                    <label for="area">গ্রীন, পঞ্চগড় </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-12 {{ $errors->has('applierOccupation') ? 'has-error' : '' }}">
                                <div class="row">
                                    <label for="subject"><b>বিষয় : পণ্য /ক্ষুদ্র ব্যাবসার জন্য ঋণের আবেদন ।</b> </label>

                                </div>
                            </div>
                        </div>
                        <hr>
                        <!--Applicant name, guardian name-->
                        <div class="row">
                            <!--Applicant name-->
                            <div class="form-group col-sm-6 {{ $errors->has('applierName') ? 'has-error' : '' }}">
                                <div class="row">
                                    <div class="col-sm-4 text-right">
                                        <label class="" for="applierName"><span style="color: red;">* </span>আবেদনকারীর
                                            নাম</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="applierName" name="applierName"
                                               placeholder="নাম" value="{{$member_info->name}}" readonly required>
                                        @include('errors.formValidateError', ['inputName' => 'applierName'])
                                    </div>
                                </div>
                            </div>
                            <!-- guardian name -->
                            <div class="form-group col-sm-6 {{ $errors->has('guardianName') ? 'has-error' : '' }}">
                                <div class="row">
                                    <div class="col-sm-4 text-right">
                                        <label for="guardianName"><span style="color: red;">* </span>পিতা/স্বামীর
                                            নাম</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="guardianName" name="guardianName"
                                               readonly required
                                               placeholder="পিতা/স্বামী"
                                               value="{{$member_info->hasMemberDetails->guardian_name}}">
                                        @include('errors.formValidateError', ['inputName' => 'guardianName'])
                                    </div>
                                </div>
                            </div><!-- /end single form input -->
                        </div>
                        <hr>
                        <!--present address-->
                        <div class="row">
                            <div class="col-sm-2 text-right">
                                <label for="currentAddress"><span style="color: red;">* </span> বর্তমান ঠিকানা</label>
                            </div>
                            <div class="col-sm-10">
                                <div class="row">
                                    <!--village-->
                                    <div class="col-sm-8 form-group {{ $errors->has('location') ? 'has-error' : '' }}">
                                        <div class="input-group">
                                            <label for="location" class="location-label input-group-addon">গ্রাম</label>
                                            <input type="text" class="form-control" name="location" readonly
                                                   value="{{$member_info->hasMemberDetails->current_location}}"
                                                   placeholder="গ্রাম" id="location" required>
                                            @include('errors.formValidateError',['inputName' => 'location','msg'=>'আবশ্যক'])
                                        </div>
                                    </div>
                                    <!--post office-->
                                    <div class="col-sm-4 form-group {{ $errors->has('postalLocation') ? 'has-error' : '' }}">
                                        <div class="input-group">
                                            <label for="postalLocation"
                                                   class="location-label input-group-addon">ডাকঘর</label>
                                            <input type="text" class="form-control" name="postalLocation"
                                                   value="{{$member_info->hasMemberDetails->current_postoffice}}"
                                                   id="postalLocation" placeholder="ডাকঘর" required readonly>
                                            @include('errors.formValidateError',['inputName' => 'postalLocation','msg'=>'আবশ্যক'])
                                        </div>
                                    </div>
                                    <!--division-->
                                    <div class="col-sm-4 form-group {{ $errors->has('division') ? 'has-error' : '' }}">
                                        <div class="input-group">
                                            <label for="division" class="location-label input-group-addon">বিভাগ</label>
                                            <select required name="division" class="form-control-select select-class"
                                                    id="division">
                                                @if(empty($divisions))
                                                    <option value="">No division</option>
                                                @else
                                                    @foreach($divisions as $division)
                                                        @if($member_info->hasMemberDetails->current_division==$division->id)
                                                            <option value="{{ $division->id }}">{{ $division->name }}</option>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </select>
                                            @include('errors.formValidateError',['inputName' => 'division','msg'=>'আবশ্যক'])
                                        </div>
                                    </div>
                                    <!--district-->
                                    <div id="dist"
                                         class="col-sm-4 form-group {{ $errors->has('district') ? 'has-error' : '' }}">
                                        <div class="input-group">
                                            <label for="district" class="location-label input-group-addon">জেলা</label>
                                            <select onchange="getUpz(this.id)" required name="district" id="district"
                                                    class="form-control-select select-class">
                                                @if(empty($districts))
                                                    <option value="">No district</option>
                                                @else
                                                    @foreach($districts as $district)
                                                        @if($member_info->hasMemberDetails->current_district==$district->id)
                                                            <option value="{{ $district->id }}">{{ $district->bn_name }}</option>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </select>
                                            @include('errors.formValidateError',['inputName' => 'district','msg'=>'আবশ্যক'])
                                        </div>
                                    </div>
                                    <!--upazilla-->
                                    <div id="upZ"
                                         class="col-sm-4 form-group {{ $errors->has('thana') ? 'has-error' : '' }}">
                                        <div class="input-group">
                                            <label for="thana" class="location-label input-group-addon">উপজেলা</label>
                                            <select name="thana" id="thana" class="form-control-select select-class"
                                                    required>
                                                @if(empty($upz))
                                                    <option value="">No upazilla</option>
                                                @else
                                                    @foreach($upz as $u)
                                                        @if($member_info->hasMemberDetails->current_upazila==$u->id)
                                                            <option value="{{ $u->id }}">{{ $u->bn_name }}</option>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </select>
                                            @include('errors.formValidateError',['inputName' => 'thana','msg'=>'আবশ্যক'])
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <!--permanent address-->
                        <div class="row">
                            <div class="col-sm-2 text-right">
                                <label for="permanentAddress"><span style="color: red;">* </span> স্থায়ী ঠিকানা</label>
                            </div>
                            <div class="col-sm-10">
                                <div class="row">
                                    <!--village-->
                                    <div class="col-sm-8 form-group {{ $errors->has('permanentLocation') ? 'has-error' : '' }}">
                                        <div class="input-group">
                                            <label for="permanentLocation" class="location-label input-group-addon">গ্রাম</label>
                                            <input type="text" class="form-control" name="permanentLocation"
                                                   value="{{$member_info->hasMemberDetails->permanent_location}}"
                                                   id="permanentLocation" placeholder="গ্রাম" required readonly>
                                            @include('errors.formValidateError',['inputName' => 'permanentLocation','msg'=>'আবশ্যক'])
                                        </div>
                                    </div>
                                    <!--post office-->
                                    <div class="col-sm-4 form-group {{ $errors->has('permanentPostal') ? 'has-error' : '' }}">
                                        <div class="input-group">
                                            <label for="permanentPostal"
                                                   class="location-label input-group-addon">ডাকঘর</label>
                                            <input type="text" class="form-control" name="permanentPostal"
                                                   value="{{$member_info->hasMemberDetails->permanent_postoffice}}"
                                                   id="permanentPostal" placeholder="ডাকঘর" required readonly>
                                            @include('errors.formValidateError',['inputName' => 'permanentPostal','msg'=>'আবশ্যক'])
                                        </div>
                                    </div>
                                    <!--division--->
                                    <div class="col-sm-4 form-group {{ $errors->has('permanentDivision') ? 'has-error' : '' }}">
                                        <div class="input-group">
                                            <label for="permanentDivision" class="location-label input-group-addon">বিভাগ</label>
                                            <select name="permanentDivision" class="form-control-select select-class"
                                                    id="permanentDivision" required>
                                                @if(empty($divisions))
                                                    <option value="">No division</option>
                                                @else
                                                    @foreach($divisions as $division)
                                                        @if($member_info->hasMemberDetails->permanent_division==$division->id)
                                                            <option value="{{ $division->id }}">{{ $division->name }}</option>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </select>
                                            @include('errors.formValidateError',['inputName' => 'permanentDivision','msg'=>'আবশ্যক'])
                                        </div>
                                    </div>
                                    <!--district--->
                                    <div id="pDist"
                                         class="col-sm-4 form-group {{ $errors->has('permanentDistrict') ? 'has-error' : '' }}">
                                        <div class="input-group">
                                            <label for="permanentDistrict"
                                                   class="location-label input-group-addon">জেলা</label>
                                            <select onchange="getUpzP(this.id)" name="permanentDistrict"
                                                    id="permanentDistrict"
                                                    class="form-control-select select-class" required>
                                                @if(empty($districts))
                                                    <option value="">No district</option>
                                                @else
                                                    @foreach($districts as $district)
                                                        @if($member_info->hasMemberDetails->permanent_district==$district->id)
                                                            <option value="{{ $district->id }}">{{ $district->bn_name }}</option>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </select>
                                            @include('errors.formValidateError',['inputName' => 'permanentDistrict','msg'=>'আবশ্যক'])
                                        </div>
                                    </div>
                                    <!--upazilla-->
                                    <div id="pUpz"
                                         class="col-sm-4 form-group {{ $errors->has('permanentThana') ? 'has-error' : '' }}">
                                        <div class="input-group">
                                            <label for="permanentThana"
                                                   class="location-label input-group-addon">উপজেলা</label>
                                            <select name="permanentThana" id="permanentThana"
                                                    class="form-control-select select-class" required>
                                                @if(empty($upz))
                                                    <option value="">No upazilla</option>
                                                @else
                                                    @foreach($upz as $u)
                                                        @if($member_info->hasMemberDetails->permanent_upazila==$u->id)
                                                            <option value="{{ $u->id }}">{{ $u->bn_name }}</option>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </select>
                                            @include('errors.formValidateError',['inputName' => 'permanentThana','msg'=>'আবশ্যক'])
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <!--applicant register date, applicant register no-->
                        <div class="row">
                            <!--applicant register date-->
                            <div class="col-sm-6 form-group {{ $errors->has('applicantDate') ? 'has-error' : '' }}">
                                <div class="row">
                                    <div class="col-sm-4 text-right">
                                        <label for="applicantDate"><span style="color: red;">* </span>সদস্য লাভের তারিখ
                                        </label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input readonly type="text" class="form-control" name="applicantDate" readonly
                                               required
                                               id="applicantDate"
                                               value="{{str_replace(range(0,9),$bn_digits,$member_info->hasMemberDetails->membership_granted_at)}}">
                                        @include('errors.formValidateError',['inputName' => 'applicantDate'])
                                    </div>
                                </div>
                            </div>
                            <!--applicant register no, -->
                            <div class="col-sm-6 form-group {{ $errors->has('registrationNumber') ? 'has-error' : '' }}">
                                <div class="row">
                                    <div class="col-sm-4 text-right">
                                        <label for="registrationNumber"><span style="color: red;">* </span>রেজিস্ট্রেশন
                                            নং</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="registrationNumber" required
                                               readonly
                                               id="registrationNumber" placeholder="রেজিস্ট্রেশন নং"
                                               value="{{str_replace(range(0,9),$bn_digits,$member_info->registration_no)}}">
                                        @include('errors.formValidateError',['inputName' => 'registrationNumber'])
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <!--applicant mobile, applicant designation-->
                        <div class="row">
                            <!--applicant mobile-->
                            <div class="col-sm-6 form-group {{ $errors->has('applicantMobile') ? 'has-error' : '' }}">
                                <div class="row">
                                    <div class="col-sm-4 text-right">
                                        <label for="applicantMobile"><span style="color: red;">* </span>সদস্যের মোবাইল
                                            নং</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="text" maxlength="11" class="form-control" name="applicantMobile"
                                               readonly required
                                               id="applicantMobile" placeholder="সদস্যের  মোবাইল নং"
                                               value="{{str_replace(range(0,9),$bn_digits,$member_info->phone)}}">
                                        @include('errors.formValidateError',['inputName' => 'applicantMobile'])
                                    </div>
                                </div>
                            </div>
                            <!--applicant designation-->
                            <div class="col-sm-6 form-group {{ $errors->has('applicantProfession') ? 'has-error' : '' }}">
                                <div class="row">
                                    <div class="col-sm-4 text-right">
                                        <label for="applicantProfession"><span style="color: red;">* </span>আবেদনকারীর
                                            পেশা</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="applicantProfession"
                                               id="applicantProfession"
                                               value="{{$member_info->hasMemberDetails->occupation}}"
                                               placeholder="আবেদনকারীর  পেশা" readonly required>
                                        @include('errors.formValidateError',['inputName' => 'applicantProfession'])
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <!--prev loan number, loan amount-->
                        <div class="row">
                            <!--prev loan number-->
                            <div class="col-sm-6 form-group {{ $errors->has('loanTimes') ? 'has-error' : '' }}">
                                <div class="row">
                                    <div class="col-sm-4 text-right">
                                        <label for="loanTimes">পূর্বে কতবার ঋণ গ্রহণ করেছেন</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="loanTimes" id="loanTimes"
                                               placeholder="পূর্বে কতবার ঋণ গ্রহণ করেছেন  " readonly
                                               value="{{str_replace(range(0,9),$bn_digits,sizeof($take_loan))}}">
                                    </div>
                                </div>
                            </div>
                            <!--loan amount-->
                            <div class="col-sm-6 form-group {{ $errors->has('loanAmount') ? 'has-error' : '' }}">
                                <div class="row">
                                    <div class="col-sm-4 text-right">
                                        <label for="loanAmount">গৃহীত ঋণের পরিমাণ</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="loanAmount" id="loanAmount"
                                               readonly placeholder="গৃহীত ঋণের পরিমাণ  "
                                               @if(sizeof('take_loan')==0)value="০"
                                               @else value="{{str_replace(range(0,9),$bn_digits,$take_loan->sum('loan_amount'))}}" @endif >
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <!--loan pay cndtn, last loan pay date-->
                        <div class="row">
                            <!--loan pay cndtn-->
                            <div class="col-sm-6 form-group {{ $errors->has('thana') ? 'has-error' : '' }}">
                                <div class="row">
                                    <div class="col-sm-4 text-right">
                                        <label for="repaymentStatus">পূর্ববর্তী ঋণ পরিশোধের অবস্থা</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <select class="form-control" id="repaymentStatus" name="repaymentStatus">
                                            <option>ভাল</option>
                                            <option>মোটামুটি</option>
                                            <option>খারাপ</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!--last loan pay date-->
                            <div class="col-sm-6 form-group {{ $errors->has('paymentDeadline') ? 'has-error' : '' }}">
                                <div class="row">
                                    <div class="col-sm-4 text-right">
                                        <label for="paymentDeadline">পূর্বের ঋণ পরিশোদের শেষ তারিখ</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input readonly type="text" class="form-control dateInput"
                                               name="paymentDeadline" id="paymentDeadline"
                                               @if(empty('take_loan'))value="0" @else value="45{{str_replace(range(0,9),$bn_digits,$take_loan)}}" @endif >
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <!--lst 3mnth deposit --3rd mnth, lst 3mnth deposit --2rd mnth-->
                        <div class="row">
                            <!--lst 3mnth deposit --3rd mnth-->
                            <div class="col-sm-6 form-group {{ $errors->has('storageStatus') ? 'has-error' : '' }}">
                                <div class="row">
                                    <div class="col-sm-4 text-right">
                                        <label for="storageStatus1st">বিগত ৩ মাসের সঞ্চয়ের অবস্থা : ১ম</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="storageStatus" id="storageStatus"
                                               placeholder="১ম মাস   ">
                                    </div>
                                </div>
                            </div>
                            <!--lst 3mnth deposit --2rd mnth-->
                            <div class="col-sm-6 form-group {{ $errors->has('storageStatus2nd') ? 'has-error' : '' }}">
                                <div class="row">
                                    <div class="col-sm-4 text-right">
                                        <label for="storageStatus2nd">২য় মাস</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="storageStatus2nd"
                                               id="storageStatus2nd" placeholder="২য় মাস  ">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--lst 3mnth deposit --1st mnth-->
                        <div class="row">
                            <!--lst 3mnth deposit --1st mnth-->
                            <div class="col-sm-6 form-group {{ $errors->has('storageStatus3rd') ? 'has-error' : '' }}">
                                <div class="row">
                                    <div class="col-sm-4 text-right">
                                        <label for="storageStatus3rd">৩য় মাস</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="storageStatus3rd"
                                               id="storageStatus3rd" placeholder="৩য় মাস   ">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <!--curr deposit, partial witdrawal -->
                        <div class="row">
                            <!--curr deposit-->
                            <div class="col-sm-6 form-group {{ $errors->has('totalSavings') ? 'has-error' : '' }}">
                                <div class="row">
                                    <div class="col-sm-4 text-right">
                                        <label for="totalSavings">বর্তমান মোট সঞ্চয়</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="totalSavings" id="totalSavings"
                                               placeholder="বর্তমান মোট সঞ্চয়" readonly required
                                               value="{{str_replace(range(0,9),$bn_digits,$deposit)}}">
                                        @include('errors.formValidateError',['inputName' => 'totalSavings'])
                                    </div>
                                </div>
                            </div>
                            <!--partial witdrawal-->
                            <div class="col-sm-6 form-group {{ $errors->has('partialRefund') ? 'has-error' : '' }}">
                                <div class="row">
                                    <div class="col-sm-4 text-right">
                                        <label for="partialRefund"><span style="color: red;">* </span>আংশিক সঞ্চয় ফেরত
                                            নেওয়ার পরিমাণ</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="partialRefund" id="partialRefund"
                                               placeholder="আংশিক সঞ্চয় ফেরত নেওয়ার পরিমাণ ">
                                        @include('errors.formValidateError',['inputName' => 'partialRefund'])
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <!--req laon amount, loan field -->
                        <div class="row">
                            <!--req loan amount -->
                            <div class="col-sm-6 form-group {{ $errors->has('proposedLoan') ? 'has-error' : '' }}">
                                <div class="row">
                                    <div class="col-sm-4 text-right">
                                        <label for="proposedLoan"><span style="color: red;">* </span>প্রস্তাবিত ঋণের
                                            পরিমাণ</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="proposedLoan" id="proposedLoan"
                                               placeholder="প্রস্তাবিত ঋণের পরিমাণ   " required>
                                        @include('errors.formValidateError',['inputName' => 'proposedLoan'])
                                    </div>
                                </div>
                            </div>
                            <!--loan field -->
                            <div class="col-sm-6 form-group {{ $errors->has('creditSector') ? 'has-error' : '' }}">
                                <div class="row">
                                    <div class="col-sm-4 text-right">
                                        <label for="creditSector"><span style="color: red;">* </span>ঋণের খাত</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="creditSector" id="creditSector"
                                               placeholder="ঋণের খাত  " required>
                                        @include('errors.formValidateError',['inputName' => 'creditSector'])
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <!--loan duration -->
                        <div class="row">
                            <!--loan duration-->
                            <div class="col-sm-6 form-group {{ $errors->has('termLoan') ? 'has-error' : '' }}">
                                <div class="row">
                                    <div class="col-sm-4 text-right">
                                        <label for="termLoan"><span style="color: red;">* </span>ঋণের মেয়াদ</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control " name="termLoan" id="termLoan"
                                               placeholder="ঋণের মেয়াদ" required>
                                        @include('errors.formValidateError',['inputName' => 'termLoan'])
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-sm-12 form-group ">
                                <div class="row">
                                    <div class="col-sm-12 ">
                                        <label for="termLoan">ঋণ পরিশোধের নিয়ম:<br><br>
                                            আমি আবেদনকারী এই মর্মে অঙ্গীকার করছি যে, আমাকে উক্ত ঋণ প্রদান করলে আমি যথা
                                            সময় এ সমিতির নির্ধারিত চার্জ অনুযায়ী ঋণ পরিশোধ করতে বাধ্য থাকিব ।
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <!---applicant sign--->
                            <div class="col-sm-offset-6 form-group {{ $errors->has('applicantSignature') ? 'has-error' : '' }}">
                                <div class="row">
                                    <div class="col-sm-4 text-right">
                                        <label for="applicantSignature"><span style="color: red;">* </span>আবেদনকারীর
                                            স্বাক্ষর </label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="signature">
                                            <img style="width:120px; height: 60px;"
                                                 src="{{url('public/img/member/'.$member_info->hasMemberDetails->member_sign)}}"
                                                 alt="">
                                        </div>
                                        @include('errors.formValidateError',['inputName' => 'applicantSignature'])
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <!---applicant sign date--->
                            <div class="col-sm-offset-6 form-group {{ $errors->has('signatureDate') ? 'has-error' : '' }}">
                                <div class="row">
                                    <div class="col-sm-4 text-right">
                                        <label for="signatureDate"><span style="color: red;">* </span>তারিখ</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input readonly type="text" class=" form-control" name="signatureDate"
                                               id="signatureDate" value="{{date('Y-m-d')}}" required>
                                        @include('errors.formValidateError',['inputName' => 'signatureDate'])
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <!---loan amount --->
                        <div class="row">
                            <div class="col-sm-12 form-group {{ $errors->has('applicantName') ? 'has-error' : '' }}">
                                <div class="row">
                                    <div class="col-sm-3  ">
                                        <input type="text" class="form-control" name="applicantName" id="applicantName"
                                               placeholder="আবেদনকারীর  নাম " value="{{$member_info->name}}" required
                                               readonly>
                                        @include('errors.formValidateError',['inputName' => 'applicantName'])
                                    </div>
                                    <div class="col-sm-5">
                                        <label for="des"> এর অভিভাবক হিসাবে ঋণ পরিশোধের দায় -দায়িত্ব নিয়ে
                                        </label>
                                    </div>
                                    <!---loan amount--->
                                    <div class="col-sm-4 ">
                                        <input type="text" class="form-control" name="applicantGuardian"
                                               id="applicantGuardian" placeholder="" readonly>
                                        @include('errors.formValidateError',['inputName' => 'applicantGuardian'])
                                    </div>
                                    <hr>
                                    <div>
                                        <label for="des"> টাকা ঋণ প্রদানের জন্য অনুরোধ করছি ।
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <!-- grantor name -->
                            <div class="form-group col-sm-6 {{ $errors->has('guardianName') ? 'has-error' : '' }}">
                                <div class="row">
                                    <div class="col-sm-4 text-right">
                                        <label for="guardianName"><span style="color: red;">* </span>অভিভাবকের নাম
                                        </label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="guardianName" name="guardianName"
                                               placeholder="অভিভাবকের  নাম">
                                        @include('errors.formValidateError', ['inputName' => 'guardianName'])
                                    </div>
                                </div>
                            </div><!-- /end single form input -->
                            <!-- grantor relation -->
                            <div class="form-group col-sm-6 {{ $errors->has('nomineeRelation') ? 'has-error' : '' }}">
                                <div class="row">
                                    <div class="col-sm-4 text-right">
                                        <label for="nomineeRelation"><span style="color: red;">* </span> সম্পর্ক</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="nomineeRelation"
                                               name="nomineeRelation" placeholder="সম্পর্ক">
                                        @include('errors.formValidateError', ['inputName' => 'nomineeRelation'])
                                    </div>
                                </div>
                            </div><!-- /end single form input -->
                        </div>
                        <hr>

                        <div class="row">
                            <!--grantor sign -->
                            <div class="col-sm-6 form-group {{ $errors->has('guardianSignature') ? 'has-error' : '' }}">
                                <div class="row">
                                    <div class="col-sm-4 text-right">
                                        <label for="guardianSignature"><span style="color: red;">* </span>অভিভাবকের
                                            স্বাক্ষর </label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="signature">
                                            <input type="file" id="guardianSignature" name="guardianSignature" required
                                                   class="form-control">
                                            <img id="guardianSignatureView">
                                        </div>
                                        @include('errors.formValidateError',['inputName' => 'guardianSignature'])
                                    </div>
                                </div>
                            </div>
                            <!--grantor designation -->
                            <div class="col-sm-6 form-group {{ $errors->has('guardianCareers') ? 'has-error' : '' }}">
                                <div class="row">
                                    <div class="col-sm-4 text-right">
                                        <label for="guardianCareers"><span style="color: red;">* </span>অভিভাবকের
                                            পেশা</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="guardianCareers"
                                               id="guardianCareers" placeholder="অভিভাবকের পেশা ">
                                        @include('errors.formValidateError',['inputName' => 'guardianCareers'])
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <!-- witness 1 -->
                        <div class="row">
                            <div class="col-sm-6 form-group {{ $errors->has('witnessSignature1') ? 'has-error' : '' }}">
                                <div class="row">
                                    <div class="col-sm-4 text-right">
                                        <label for="witnessSignature1"><span style="color: red;">* </span>সাক্ষীর
                                            স্বাক্ষর: ১ম স্বাক্ষর </label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="signature">
                                            <input type="file" id="witnessSignature1" name="witnessSignature1" required
                                                   class="form-control">
                                            <img id="witnessSignature1View">
                                        </div>
                                        @include('errors.formValidateError',['inputName' => 'witnessSignature1'])
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <!-- witness 2 -->
                        <div class="row">
                            <div class="col-sm-6 form-group {{ $errors->has('witnessSignature2') ? 'has-error' : '' }}">
                                <div class="row">
                                    <div class="col-sm-4 text-right">
                                        <label for="witnessSignature2"><span style="color: red;">* </span>২য় স্বাক্ষর
                                        </label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="signature">
                                            <input type="file" id="witnessSignature2" name="witnessSignature2" required
                                                   class="form-control">
                                            <img id="witnessSignature2View">
                                        </div>
                                        @include('errors.formValidateError',['inputName' => 'witnessSignature2'])
                                    </div>
                                </div>
                            </div><!-- /end single form input -->
                        </div>
                        <hr>
                        <!-- witness 3 -->
                        <div class="row">
                            <div class="col-sm-6 form-group {{ $errors->has('witnessSignature3') ? 'has-error' : '' }}">
                                <div class="row">
                                    <div class="col-sm-4 text-right">
                                        <label for="witnessSignature3"><span style="color: red;">* </span>৩য় স্বাক্ষর
                                        </label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="signature">
                                            <input type="file" id="witnessSignature3" name="witnessSignature3" required
                                                   class="form-control">
                                            <img id="witnessSignature3View">
                                        </div>
                                        @include('errors.formValidateError',['inputName' => 'witnessSignature3'])
                                    </div>
                                </div>
                            </div><!-- /end single form input -->
                        </div>
                        <hr>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-12" style="text-align: center">
                                    <button type="submit" id="btn" class="btn btn-success btn-lg"><i
                                                class="fa fa-save"></i> আবেদন করুন
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="paddings-mini"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('customJs')
    <script type="text/javascript" src="{{url('public')}}/js/libs/selectize/selectize.min.js"></script>
    <script type="text/javascript" src="{{url('public')}}/js/libs/image-resize/iEdit.js"></script>
    <script type="text/javascript" src="{{url('public')}}/js/libs/form-validation/validate.min.js"></script>
    <script type="text/javascript" src="{{url('public')}}/js/libs/datepicker/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="{{url('public')}}/js/form/loan-applicant.js"></script>
    <script>
        $(function () {
            $(".dateInput").datepicker({
                format: "yyyy-mm-dd"
            });
        });
        function checkNumber(id) {
            var tmp_num = $('#' + id).val().getDigitEnglishFromBangla();
            if (tmp_num == null || isNaN(tmp_num)) {
                var x = document.getElementById(id);
                x.value = x.value.replace(/[^0-9]/, '');
            }
        }

        $('#proposedLoan').keyup(function () {
            checkNumber('proposedLoan');
        }).blur(function () {
            checkNumber('proposedLoan');
        });

        $("#guardianSignature").change(function (e) {

            var img = e.target.files[0];

            if (!img.type.match('image.*')) {
                alert("Whoops! That is not an image.");
                $('#guardianSignature').val('');
                return;
            }
            iEdit.open(img, true, function (res) {
                $("#guardianSignatureView").attr("src", res).width(120).height(60);
            });
        });

        $("#witnessSignature1").change(function (e) {

            var img = e.target.files[0];

            if (!img.type.match('image.*')) {
                alert("Whoops! That is not an image.");
                $('#witnessSignature1').val('');
                return;
            }
            iEdit.open(img, true, function (res) {
                $("#witnessSignature1View").attr("src", res).width(120).height(60);
            });
        });

        $("#witnessSignature2").change(function (e) {

            var img = e.target.files[0];

            if (!img.type.match('image.*')) {
                alert("Whoops! That is not an image.");
                $('#witnessSignature2').val('');
                return;
            }
            iEdit.open(img, true, function (res) {
                $("#witnessSignature2View").attr("src", res).width(120).height(60);
            });
        });

        $("#witnessSignature3").change(function (e) {

            var img = e.target.files[0];

            if (!img.type.match('image.*')) {
                alert("Whoops! That is not an image.");
                $('#witnessSignature3').val('');
                return;
            }
            iEdit.open(img, true, function (res) {
                $("#witnessSignature3View").attr("src", res).width(120).height(60);
            });
        });

    </script>
@endsection

<div class="form-group">
    <label for="crs_stts" class="col-md-12" style="text-align: left;"><span style="color: red;">* </span>কোর্স
        স্ট্যাটাস</label>
    <div class="col-md-12">
        <select name="crs_stts" id="crs_stts" required class="form-control">
            <option value="3">সম্পাদনযোগ্য</option>
        </select>
        <span id="crs_stts_err" style="color: red;"></span>
    </div>

</div>
<!--course name--->
<div class="form-group">
    <label for="crs_title" class="col-md-12" style="text-align: left;"><span style="color: red;">* </span>কোর্স
        শিরোনাম</label>
    <div class="col-md-12">
        <select name="crs_title" id="crs_title" class="form-control not-demand"
                required>
            <?php
            foreach ($course_name as $c) { ?>
            <option value="<?= $c['c_id'] ?>"><?= $c['c_name'] ?></option>
            <?php }
            ?>
        </select>
        <span id="crs_title_err" style="color: red;"></span>
    </div>
</div>
<!--year--->
<div class="form-group">
    <label for="crs_year" class="col-md-12" style="text-align: left;"><span style="color: red;">* </span>প্রশিক্ষণ
        বর্ষ</label>
    <div class="col-md-12">
        <input readonly type="text" name="crs_year" id="crs_year"
               value="<?= str_replace(range(0, 9), $bn_digits, $curr_y) ?>"
               class="form-control" required>
        <span id="crs_year_err" style="color: red;"></span>
    </div>
</div>
<!--course time--->
<div class="form-group">
    <label for="start_date" class="col-md-12" style="text-align: left;"><span style="color: red;">* </span>কোর্সের
        সময়সূচি</label>
    <div class="col-md-12">
        <select name="start_date" id="startDate" class="form-control not-demand"
                required>
            <?php
            foreach ($course_time as $c) {
            $dd = explode('-', $c['start_date']);
            $ddd = explode('-', $c['end_date']);
            $dddd = $dd[2] . '/' . $dd[1] . '/' . $dd[0] . ' থেকে ' . $ddd[2] . '/' . $ddd[1] . '/' . $ddd[0];
            ?>
            <option
                    value="<?= $c['c_id'] ?>"><?= str_replace(range(0, 9), $bn_digits, $dddd) ?></option>
            <?php }
            ?>
        </select>
        <span id="start_date_err" style="color: red;"></span>
    </div>
</div>
<!--course meyad--->
<div class="form-group">
    <label for="meyad" class="col-md-12" style="text-align: left;">কোর্সের
        মেয়াদ</label>
    <div class="col-md-12">
        <input readonly type="text" name="meyad" id="meyad"
               class="form-control not-demand">
        <span id="meyad_err" style="color: red;"></span>
    </div>
</div>
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
    <div class="content_info content_area_main">
        <div class="container">
            <div class="paddings-mini">
                @include('includes.flashMessage')
                        <!--form title-->
                <div class="form-title title-vertical-line">
                    <h2><b>সদস্য ভর্তি ফর্ম</b></h2>
                </div>
                <div class="paddings-mini"></div>
                <!--form CONTENT-->
                <div class="form-content">
                    <form id="memberAdmitFrom" action="{{url('/member_admission')}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                                <!--applicant name , profession-->
                        <div class="row">
                            <!-- applicant name -->
                            <div class="form-group col-sm-6 {{ $errors->has('applierName') ? 'has-error' : '' }}">
                                <div class="row">
                                    <div class="col-sm-4 text-right">
                                        <label for="applierName"><span style="color: red;">* </span>আবেদনকারীর
                                            নাম</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="applierName" name="applierName" value="{{old('applierName')}}"
                                               placeholder="নাম" required>
                                        @include('errors.formValidateError', ['inputName' => 'applierName','msg'=>'আবশ্যক'])
                                    </div>
                                </div>
                            </div><!-- /end single form input -->
                            <!-- applicant porfession -->
                            <div class="form-group col-sm-6 {{ $errors->has('applierOccupation') ? 'has-error' : '' }}">
                                <div class="row">
                                    <div class="col-sm-4 text-right">
                                        <label for="applierOccupation"><span style="color: red;">* </span>আবেদনকারীর
                                            পেশা</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="applierOccupation" value="{{old('applierOccupation')}}"
                                               name="applierOccupation" placeholder="পেশা" required>
                                        @include('errors.formValidateError', ['inputName' => 'applierOccupation','msg'=>'আবশ্যক'])
                                    </div>
                                </div>
                            </div><!-- /end single form input -->
                        </div>
                        <hr>
                        <!--father name, profession--->
                        <div class="row">
                            <!-- father name -->
                            <div class="form-group col-sm-6 {{ $errors->has('guardianName') ? 'has-error' : '' }}">
                                <div class="row">
                                    <div class="col-sm-4 text-right">
                                        <label for="guardianName"><span style="color: red;">* </span>পিতা/স্বামীর
                                            নাম</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="guardianName" name="guardianName" value="{{old('guardianName')}}"
                                               placeholder="পিতা/স্বামী" required>
                                        @include('errors.formValidateError', ['inputName' => 'guardianName','msg'=>'আবশ্যক'])
                                    </div>
                                </div>
                            </div><!-- /end single form input -->
                            <!-- father profession -->
                            <div class="form-group col-sm-6 {{ $errors->has('guardianOccupation') ? 'has-error' : '' }}">
                                <div class="row">
                                    <div class="col-sm-4 text-right">
                                        <label for="guardianOccupation"><span style="color: red;">* </span>পিতা/স্বামীর
                                            পেশা</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="guardianOccupation"
                                               name="guardianOccupation" value="{{old('guardianOccupation')}}" placeholder="পেশা" required>
                                        @include('errors.formValidateError', ['inputName' => 'guardianOccupation','msg'=>'আবশ্যক'])
                                    </div>
                                </div>
                            </div><!-- /end single form input -->
                        </div>
                        <hr>
                        <!--mother name , profesion-->
                        <div class="row">
                            <!-- mother name -->
                            <div class="form-group col-sm-6 {{ $errors->has('motherName') ? 'has-error' : '' }}">
                                <div class="row">
                                    <div class="col-sm-4 text-right">
                                        <label for="motherName"><span style="color: red;">* </span>মাতার নাম</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="motherName" name="motherName" value="{{old('motherName')}}"
                                               placeholder="মাতা" required>
                                        @include('errors.formValidateError', ['inputName' => 'motherName','msg'=>'আবশ্যক'])
                                    </div>
                                </div>
                            </div><!-- /end single form input -->
                            <!-- profession -->
                            <div class="form-group col-sm-6 {{ $errors->has('motherOccupation') ? 'has-error' : '' }}">
                                <div class="row">
                                    <div class="col-sm-4 text-right">
                                        <label for="motherOccupation"><span style="color: red;">* </span>মাতার
                                            পেশা</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="motherOccupation"
                                               name="motherOccupation" value="{{old('motherOccupation')}}" placeholder="পেশা" required>
                                        @include('errors.formValidateError', ['inputName' => 'motherOccupation','msg'=>'আবশ্যক'])
                                    </div>
                                </div>
                            </div><!-- /end single form input -->
                        </div>
                        <hr>
                        <!--present address-->
                        <div class="row">
                            <div class="col-sm-2 text-right">
                                <label for="currentAddress"><span style="color: red;">* </span>বর্তমান ঠিকানা</label>
                            </div>
                            <div class="col-sm-10">
                                <div class="row">
                                    <!--village-->
                                    <div class="col-sm-8 form-group {{ $errors->has('location') ? 'has-error' : '' }}">
                                        <div class="input-group">
                                            <label for="location" class="location-label input-group-addon">গ্রাম</label>
                                            <input type="text" class="form-control" name="location" value="{{old('location')}}" id="location"
                                                   placeholder="গ্রাম" required>
                                            @include('errors.formValidateError',['inputName' => 'location','msg'=>'আবশ্যক'])
                                        </div>
                                    </div>
                                    <!--post office-->
                                    <div class="col-sm-4 form-group {{ $errors->has('postalLocation') ? 'has-error' : '' }}">
                                        <div class="input-group">
                                            <label for="postalLocation" class="location-label input-group-addon">ডাকঘর</label>
                                            <input type="text" class="form-control" name="postalLocation" value="{{old('postalLocation')}}"
                                                   id="postalLocation" placeholder="ডাকঘর" required>
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
                                                        <option @if(old('division')==$division->id) {{'selected'}} @endif value="{{ $division->id }}">{{ $division->name }}</option>
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
                                                    <option value="">No division</option>
                                                @else
                                                    @foreach($districts as $district)
                                                        <option @if(old('district')==$district->id) {{'selected'}} @endif value="{{ $district->id }}">{{ $district->bn_name }}</option>
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
                                                        <option @if(old('thana')==$u->id) {{'selected'}} @endif value="{{ $u->id }}">{{ $u->bn_name }}</option>
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
                        <!--parmannt address--->
                        <div class="row">
                            <div class="col-sm-2 text-right">
                                <label for="permanentAddress"><span style="color: red;">* </span>স্থায়ী ঠিকানা</label>
                            </div>
                            <div class="col-sm-10">
                                <div class="row">
                                    <!--village-->
                                    <div class="col-sm-8 form-group {{ $errors->has('permanentLocation') ? 'has-error' : '' }}">
                                        <div class="input-group">
                                            <label for="permanentLocation" class="location-label input-group-addon">গ্রাম</label>
                                            <input type="text" class="form-control" name="permanentLocation" value="{{old('permanentLocation')}}"
                                                   id="permanentLocation" placeholder="গ্রাম" required>
                                            @include('errors.formValidateError',['inputName' => 'permanentLocation','msg'=>'আবশ্যক'])
                                        </div>
                                    </div>
                                    <!--post office-->
                                    <div class="col-sm-4 form-group {{ $errors->has('permanentPostal') ? 'has-error' : '' }}">
                                        <div class="input-group">
                                            <label for="permanentPostal"
                                                   class="location-label input-group-addon">ডাকঘর</label>
                                            <input type="text" class="form-control" name="permanentPostal" value="{{old('permanentPostal')}}"
                                                   id="permanentPostal" placeholder="ডাকঘর" required>
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
                                                        <option @if(old('permanentDivision')==$division->id) {{'selected'}} @endif value="{{ $division->id }}">{{ $division->name }}</option>
                                                        <option value="">dss</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            @include('errors.formValidateError',['inputName' => 'permanentDivision','msg'=>'আবশ্যক'])
                                        </div>
                                    </div>
                                    <!--district--->
                                    <div id="pDist" class="col-sm-4 form-group {{ $errors->has('permanentDistrict') ? 'has-error' : '' }}">
                                        <div class="input-group">
                                            <label for="permanentDistrict"
                                                   class="location-label input-group-addon">জেলা</label>
                                            <select onchange="getUpzP(this.id)" name="permanentDistrict" id="permanentDistrict"
                                                    class="form-control-select select-class" required>
                                                @if(empty($districts))
                                                    <option value="">No division</option>
                                                @else
                                                    @foreach($districts as $district)
                                                        <option @if(old('permanentDistrict')==$district->id) {{'selected'}} @endif value="{{ $district->id }}">{{ $district->bn_name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            @include('errors.formValidateError',['inputName' => 'permanentDistrict','msg'=>'আবশ্যক'])
                                        </div>
                                    </div>
                                    <!--upazilla-->
                                    <div id="pUpz" class="col-sm-4 form-group {{ $errors->has('permanentThana') ? 'has-error' : '' }}">
                                        <div class="input-group">
                                            <label for="permanentThana"
                                                   class="location-label input-group-addon">উপজেলা</label>
                                            <select name="permanentThana" id="permanentThana"
                                                    class="form-control-select select-class" required>
                                                @if(empty($upz))
                                                    <option value="">No upazilla</option>
                                                @else
                                                    @foreach($upz as $u)
                                                        <option @if(old('permanentThana')==$u->id) {{'selected'}} @endif value="{{ $u->id }}">{{ $u->bn_name }}</option>
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
                        <!--dob, gender-->
                        <div class="row">
                            <!-- dob -->
                            <div class="form-group col-sm-6 {{ $errors->has('birthDate') ? 'has-error' : '' }}">
                                <div class="row">
                                    <div class="col-sm-4 text-right">
                                        <label for="birthDate">জন্ম তারিখ</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input readonly type="text" class="form-control" id="birthDate" name="birthDate"
                                               value="{{old('birthDate')}}">
                                        @include('errors.formValidateError', ['inputName' => 'birthDate','msg'=>'আবশ্যক'])
                                    </div>
                                </div>
                            </div><!-- /end single form input -->
                            <!-- gender -->
                            <div class="form-group col-sm-6 {{ $errors->has('gender')?'has-error':'' }}">
                                <div class="row">
                                    <div class="col-sm-4 text-right">
                                        <label for="gender"><span style="color: red;">* </span>লিঙ্গ</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input required @if(old('gender')=="পুরুষ"){{'checked'}}@endif  type="radio" class="" name="gender" value="পুরুষ">&nbsp;পুরুষ &nbsp;&nbsp;&nbsp;
                                        <input required @if(old('gender')=="মহিলা"){{'checked'}}@endif type="radio" class="" name="gender" value="মহিলা">&nbsp;মহিলা
                                        @include('errors.formValidateError',['inputName' => 'gender','msg'=>'আবশ্যক'])
                                    </div>
                                </div>
                            </div><!-- /end single form input -->
                        </div>
                        <hr>
                        <!--NATIOnality, religion -->
                        <div class="row">
                            <!-- nationality-->
                            <div class="form-group col-sm-6 {{ $errors->has('nationalism') ? 'has-error' : '' }}">
                                <div class="row">
                                    <div class="col-sm-4 text-right">
                                        <label for="nationalism"><span style="color: red;">* </span>জাতীয়তা</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="nationalism" name="nationalism"
                                               value="{{old('nationalism')}}" placeholder="জাতীয়তা" required>
                                        @include('errors.formValidateError', ['inputName' => 'nationalism','msg'=>'আবশ্যক'])
                                    </div>
                                </div>
                            </div><!-- /end single form input -->
                            <!-- religion -->
                            <div class="form-group col-sm-6 {{ $errors->has('religion') ? 'has-error' : '' }}">
                                <div class="row">
                                    <div class="col-sm-4 text-right">
                                        <label for="currentAge"><span style="color: red;">* </span>ধর্ম</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <select name="religion" class="form-control-select select-class" id="religion"
                                                required>
                                            <option @if(old('religion')=="মুসলিম"){{'selected'}}@endif value="মুসলিম">
                                                মুসলিম
                                            </option>
                                            <option @if(old('religion')=="হিন্দু"){{'selected'}}@endif value="হিন্দু">
                                                হিন্দু
                                            </option>
                                            <option @if(old('religion')=="বৌদ্ধ"){{'selected'}}@endif value="বৌদ্ধ">
                                                বৌদ্ধ
                                            </option>
                                            <option @if(old('religion')=="খ্রিষ্টান"){{'selected'}}@endif value="খ্রিষ্টান">
                                                খ্রিষ্টান
                                            </option>
                                        </select>
                                        @include('errors.formValidateError', ['inputName' => 'religion','msg'=>'আবশ্যক'])
                                    </div>
                                </div>
                            </div><!-- /end single form input -->
                        </div>
                        <hr>
                        <!--nid, bloood grp-->
                        <div class="row">
                            <!-- nid -->
                            <div class="form-group col-sm-6 {{ $errors->has('idNumber') ? 'has-error' : '' }}">
                                <div class="row">
                                    <div class="col-sm-4 text-right">
                                        <label for="idNumber"><span style="color: red;">* </span>ভোটার পরিচয়
                                            পত্র</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="idNumber" name="idNumber" value="{{old('idNumber')}}"
                                               placeholder="ভোটার পরিচয় পত্র" required maxlength="17" minlength="17">
                                        @include('errors.formValidateError', ['inputName' => 'idNumber','msg'=>'১৭ সংখ্যার হতে হবে'])
                                    </div>
                                </div>
                            </div><!-- /end single form input -->
                            <!-- bld grp -->
                            <div class="form-group col-sm-6 {{ $errors->has('bloodGroup') ? 'has-error' : '' }}">
                                <div class="row">
                                    <div class="col-sm-4 text-right">
                                        <label for="bloodGroup"><span style="color: red;">* </span>রক্তের গ্রুপ</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <select id="bloodGroup" name="bloodGroup"
                                                class="form-control-select select-class" required>
                                            <option value="0">রক্তের গ্রুপ</option>
                                            @if(empty($blood))
                                                <option value="">No blood group</option>
                                            @else
                                                @foreach($blood as $group)
                                                    <option @if(old('group')== $group->id) {{'selected'}} @endif value="{{ $group->id }}">{{ $group->blood_grp_name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @include('errors.formValidateError', ['inputName' => 'bloodGroup','msg'=>'আবশ্যক'])
                                    </div>
                                </div>
                            </div><!-- /end single form input -->
                        </div>
                        <hr>
                        <!--education, marital status-->
                        <div class="row">
                            <!-- education -->
                            <div class="form-group col-sm-6 {{ $errors->has('educationQuality') ? 'has-error' : '' }}">
                                <div class="row">
                                    <div class="col-sm-4 text-right">
                                        <label for="educationQuality"><span style="color: red;">* </span>শিক্ষাগত
                                            যোগ্যতা</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <select name="educationQuality" id="educationQuality"
                                                class="form-control-select select-class" required>
                                            @if(empty($educations))
                                                <option value="">No education</option>
                                            @else
                                                @foreach($educations as $education)
                                                    <option @if(old('education')==$education->id) @endif value="{{ $education->id }}">{{ $education->edu_name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @include('errors.formValidateError', ['inputName' => 'educationQuality','msg'=>'আবশ্যক'])
                                    </div>
                                </div>
                            </div><!-- /end single form input -->
                            <!-- marital status -->
                            <div class="form-group col-sm-6 {{ $errors->has('maritalStatus') ? 'has-error' : '' }}">
                                <div class="row">
                                    <div class="col-sm-4 text-right">
                                        <label for="maritalStatus"><span style="color: red;">* </span>বৈবাহিক
                                            অবস্থা</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input required type="radio" name="maritalStatus" @if(old('maritalStatus')=="বিবাহিত"){{'checked'}} @endif value="বিবাহিত"> বিবাহিত &nbsp;&nbsp;&nbsp;&nbsp;
                                        <input required type="radio" name="maritalStatus" @if(old('maritalStatus')=="অবিবাহিত"){{'checked'}} @endif value="অবিবাহিত"> অবিবাহিত
                                        @include('errors.formValidateError', ['inputName' => 'maritalStatus','msg'=>'আবশ্যক'])
                                    </div>
                                </div>
                            </div><!-- /end single form input -->
                        </div>
                        <hr>
                        <!--nomini name, relation-->
                        <div class="row">
                            <!-- nominee name -->
                            <div class="form-group col-sm-6 {{ $errors->has('nomineeName') ? 'has-error' : '' }}">
                                <div class="row">
                                    <div class="col-sm-4 text-right">
                                        <label for="nomineeName"><span style="color: red;">* </span>নমিনির নাম </label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="nomineeName" name="nomineeName" value="{{old('nomineeName')}}"
                                               placeholder="নাম" required>
                                        @include('errors.formValidateError', ['inputName' => 'nomineeName','msg'=>'আবশ্যক'])
                                    </div>
                                </div>
                            </div><!-- /end single form input -->
                            <!-- nominee relation -->
                            <div class="form-group col-sm-6 {{ $errors->has('nomineeRelation') ? 'has-error' : '' }}">
                                <div class="row">
                                    <div class="col-sm-4 text-right">
                                        <label for="nomineeRelation"><span style="color: red;">* </span>সম্পর্ক</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="nomineeRelation" required
                                               value="{{old('nomineeRelation')}}" name="nomineeRelation" placeholder="সম্পর্ক">
                                        @include('errors.formValidateError', ['inputName' => 'nomineeRelation','msg'=>'আবশ্যক'])
                                    </div>
                                </div>
                            </div><!-- /end single form input -->
                        </div>
                        <hr>
                        <!--mobile, office-->
                        <div class="row">
                            <!--phone-->
                            <div class="col-md-6 form-group {{ $errors->has('phoneNumber') ? 'has-error':'' }}">
                                <div class="row">
                                    <div class="col-sm-4 text-right">
                                        <label for="phoneNumber"><span style="color: red;">* </span>ফোন/মোবাইল </label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" value="{{old('phoneNumber')}}"
                                               placeholder="মোবাইল" maxlength="11" required>
                                        @include('errors.formValidateError', ['inputName' => 'phoneNumber','msg'=>'৭ থেকে ১১ সংখ্যার মধ্যে হতে হবে'])
                                    </div>
                                </div>
                            </div>
                            <!--branch-->
                            <div class="col-md-6 form-group {{ $errors->has('officeLocation') ? 'has-error':'' }}">
                                <div class="row">
                                    <div class="col-sm-4 text-right">
                                        <label for="officeLocation"><span style="color: red;">* </span>অফিস নির্বাচন
                                        </label>
                                    </div>
                                    <div class="col-sm-8">
                                        <select name="officeLocation" id="officeLocation"
                                                class="form-control-select select-class" required>
                                            @if(empty($branch))
                                                <option value="0">অফিস নির্বাচন করুন</option>
                                            @else
                                                @foreach($branch as $b)
                                                    <option @if(old('b')==$b->id) {{'selected'}} @endif value="{{ $b->id }}">{{ $b->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @include('errors.formValidateError', ['inputName' => 'officeLocation','msg'=>'আবশ্যক'])
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <!--applicant pic, nominee pic -->
                        <div class="row">
                            <!--applicant pic-->
                            <div class="col-sm-6 form-group {{ $errors->has('yourPicture') ? 'has-error':'' }}">
                                <div class="row">
                                    <div class="col-sm-4 text-right">
                                        <label for="yourPicture"><span style="color: red;">* </span>আবেদনকারীর ছবি
                                        </label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="profileImage admitPicture">
                                            <input type="file" id="picture" name="picture" required
                                                   class="form-control">
                                            <img id="pictureView">
                                        </div>
                                        @include('errors.formValidateError',['inputName' => 'yourPicture','msg'=>'আবশ্যক'])
                                    </div>
                                </div>
                            </div>
                            <!--nominee pic-->
                            <div class="col-sm-6 form-group {{ $errors->has('nomineePicture') ? 'has-error':'' }}">
                                <div class="row">
                                    <div class="col-sm-4 text-right">
                                        <label for="nomineePicture"><span style="color: red;">* </span>নমিনীর ছবি
                                        </label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="profileImage nomineePicture">
                                            <input type="file" id="nomineePicture" name="nomineePicture" required
                                                   class="form-control">
                                            <img id="nomineePictureView">
                                            @include('errors.formValidateError',['inputName' => 'nomineePicture','msg'=>'আবশ্যক'])
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--applicant pic, nominee pic -->
                        <div class="row">
                            <!--applicant pic-->
                            <div class="col-sm-6 form-group {{ $errors->has('applicantSign') ? 'has-error':'' }}">
                                <div class="row">
                                    <div class="col-sm-4 text-right">
                                        <label for="yourPicture"><span style="color: red;">* </span>আবেদনকারীর স্বাক্ষর
                                        </label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="profileImage admitPicture">
                                            <input type="file" id="applicantSign" name="applicantSign" required
                                                   class="form-control">
                                            <img id="applicantSignView">
                                        </div>
                                        @include('errors.formValidateError',['inputName' => 'yourPicture','msg'=>'আবশ্যক'])
                                    </div>
                                </div>
                            </div>
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
    <script type="text/javascript" src="{{url('public')}}/js/form/member-admit.js"></script>
    <script>
        function checkNumber(id) {
            var tmp_num = $('#' + id).val().getDigitEnglishFromBangla();
            if (tmp_num == null || isNaN(tmp_num)) {
                var x = document.getElementById(id);
                x.value = x.value.replace(/[^0-9]/, '');
            }
        }

        function getUpz(id) {
            var value = $('#'+id).val();
            $.ajax({
                type: 'get',
                url: base_url + '/sub_district/' + value,
                data: {}, success: function (data) {

                    document.getElementById('upZ').innerHTML = '';

                    var trow = '<div class="input-group">'
                            + '<label for="thana" class="location-label input-group-addon">উপজেলা</label>'
                            + '<select name="thana" id="thana" class="form-control-select select-class" required>';
                    $.each(data, function (i, v) {
                        trow += '<option value="' + v.id + '">' + v.bn_name + '</option>';

                    });
                    trow += '</select>'
                            + '</div>'

                    $('#upZ').append(trow);

                    $('#thana').selectize();


                }
            });
        }

        function getUpzP(id) {
            var value = $('#'+id).val();
            $.ajax({
                type: 'get',
                url: base_url + '/sub_district/' + value,
                data: {}, success: function (data) {

                    document.getElementById('pUpz').innerHTML = '';

                    var trow = '<div class="input-group">'
                            + '<label for="thana" class="location-label input-group-addon">উপজেলা</label>'
                            + '<select name="permanentThana" id="permanentThana" class="form-control-select select-class" required>';
                    $.each(data, function (i, v) {
                        trow += '<option value="' + v.id + '">' + v.bn_name + '</option>';

                    });
                    trow += '</select>'
                            + '</div>'

                    $('#pUpz').append(trow);

                    $('#permanentThana').selectize();


                }
            });
        }

        $('#division').on('change', function () {
            var value = $(this).val();

            $.ajax({
                type: 'get',
                url: base_url + '/district',
                data: {
                    div_id: value
                }, success: function (data) {

                    document.getElementById('dist').innerHTML = '';

                    var trow = '<div class="input-group">'
                            + '<label for="district" class="location-label input-group-addon">জেলা</label>'
                            + '<select onchange="getUpz(this.id)" required name="district" id="district" class="form-control-select select-class">';
                    $.each(data['dist'], function (i, v) {
                        trow += '<option value="' + v.id + '">' + v.bn_name + '</option>';

                    });
                    trow += '</select>'
                            + '</div>';

                    $('#dist').append(trow);

                    $('#district').selectize();


                    document.getElementById('upZ').innerHTML = '';

                    var trow = '<div class="input-group">'
                            + '<label for="thana" class="location-label input-group-addon">উপজেলা</label>'
                            + '<select name="thana" id="thana" class="form-control-select select-class" required>';
                    $.each(data['upz'], function (i, v) {
                        trow += '<option value="' + v.id + '">' + v.bn_name + '</option>';

                    });
                    trow += '</select>'
                            + '</div>';

                    $('#upZ').append(trow);

                    $('#thana').selectize();


                }
            });
        });

        $('#permanentDivision').on('change', function () {
            var value = $(this).val();

            $.ajax({
                type: 'get',
                url: base_url + '/district',
                data: {
                    div_id: value
                }, success: function (data) {

                    document.getElementById('pDist').innerHTML = '';

                    var trow = '<div class="input-group">'
                            + '<label for="permanentDistrict" class="location-label input-group-addon">জেলা</label>'
                            + '<select onchange="getUpzP(this.id)" required name="permanentDistrict" id="permanentDistrict" class="form-control-select select-class">';
                    $.each(data['dist'], function (i, v) {
                        trow += '<option value="' + v.id + '">' + v.bn_name + '</option>';

                    });
                    trow += '</select>'
                            + '</div>';

                    $('#pDist').append(trow);

                    $('#permanentDistrict').selectize();


                    document.getElementById('pUpz').innerHTML = '';

                    var trow = '<div class="input-group">'
                            + '<label for="thana" class="location-label input-group-addon">উপজেলা</label>'
                            + '<select name="permanentThana" id="permanentThana" class="form-control-select select-class" required>';
                    $.each(data['upz'], function (i, v) {
                        trow += '<option value="' + v.id + '">' + v.bn_name + '</option>';

                    });
                    trow += '</select>'
                            + '</div>';

                    $('#pUpz').append(trow);

                    $('#permanentThana').selectize();


                }
            });
        });

        $('#birthDate').datepicker({
            format: "dd/mm/yyyy"
        });

        $('#idNumber').keyup(function () {
            checkNumber('idNumber');
        }).blur(function () {
            checkNumber('idNumber');
        });

        $('#phoneNumber').keyup(function () {
            checkNumber('phoneNumber');
        }).blur(function () {
            checkNumber('phoneNumber');
        });

        $("#picture").change(function (e) {

            var img = e.target.files[0];

            if (!img.type.match('image.*')) {
                alert("Whoops! That is not an image.");
                $('#picture').val('');
                return;
            }
            iEdit.open(img, true, function (res) {
                $("#pictureView").attr("src", res).width(120).height(60);
            });
        });

        $("#nomineePicture").change(function (e) {

            var img = e.target.files[0];

            if (!img.type.match('image.*')) {
                alert("Whoops! That is not an image.");
                $('#nomineePicture').val('');
                return;
            }
            iEdit.open(img, true, function (res) {
                $("#nomineePictureView").attr("src", res).width(120).height(60);
            });
        });

        $("#applicantSign").change(function (e) {

            var img = e.target.files[0];

            if (!img.type.match('image.*')) {
                alert("Whoops! That is not an image.");
                $('#applicantSign').val('');
                return;
            }
            iEdit.open(img, true, function (res) {
                $("#applicantSignView").attr("src", res).width(120).height(60);
            });
        });

    </script>
@endsection
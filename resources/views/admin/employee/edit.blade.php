@extends('layouts.app')

@section('specifiedCss')
    <link rel="stylesheet" href="{{url('public')}}/css/selectize/selectize.css" type="text/css">
    <link rel="stylesheet" href="{{url('public')}}/css/datepicker/bootstrap-datepicker.css">
    <link rel="stylesheet" href="{{url('public')}}/css/edit-image/iEdit.css">

@endsection
@php
$bn_digits = array('০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯');
@endphp
@section('content')
    <section>
        <div class="card">
            <div class="card-body">
                @include('includes.flashMessage')
                <div class="alert alert-callout alert-success "><b class="text-lg">কর্মচারী তথ্য সংশোধন করুন</b>
                </div>
                <div class="">
                    <form action="{{ url('/admin/employee/update') }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="emp_id" value="{{$employees[0]->id}}">
                        <div class="alert alert-callout alert-success small-padding">সাধারণ তথ্য</div>
                        <!---name, nid--->
                        <div class="row">
                            <div class="col-sm-6 form-group {{ $errors->has('name')?'has-error':'' }}">
                                <label for="name"> নাম</label>
                                <input type="text" class="form-control" name="name" id="name"
                                       value="{{$employees[0]['name']}}" required>
                                @include('errors.formValidateError',['inputName' => 'name','msg'=>'কমপক্ষে ৪ অক্ষর হতে হবে'])
                            </div>
                            <div class="col-sm-6 form-group {{ $errors->has('nid')?'has-error':'' }}">
                                <label for="nid">জাতীয় পরিচয়পত্র নং</label>
                                <input type="text" class="form-control" name="nid" id="nid"
                                       value="{{str_replace(range(0,9),$bn_digits,$employees[0]['nid'])}}"
                                       maxlength="17" minlength="17" required>
                                @include('errors.formValidateError',['inputName' => 'nid','msg'=>'১৭ অক্ষর হতে হবে'])
                            </div>
                        </div>
                        <!----mobile, pic---->
                        <div class="row">
                            <div class="col-sm-6 form-group {{ $errors->has('mobile')?'has-error':'' }}">
                                <label for="mobile">মোবাইল</label>
                                <input type="text" class="form-control" name="mobile"
                                       value="{{str_replace(range(0,9),$bn_digits,$employees[0]['mobile'])}}"
                                       maxlength="11" id="mobile" required>
                                @include('errors.formValidateError',['inputName' => 'mobile','msg'=>'কমপক্ষে ৬ সংখ্যা হতে হবে'])
                            </div>
                            <div class="col-sm-6 form-group {{ $errors->has('image')?'has-error':'' }}">
                                <label for="image">ছবি</label>
                                <div class="profileImage admitPicture">
                                    <input type="file" name="image" id="image" class="col-sm-6">
                                    <div class="col-sm-6">
                                        <img id="pictureView" style="height: 60px; width: 120px;"
                                             src="{{url('public/img/employee/'.$employees[0]['pic'])}}">
                                    </div>
                                </div>
                                @include('errors.formValidateError',['inputName' => 'pic','msg'=>'ছবি jpg/png ফরমেট এ হতে হবে এবং ১ মেগাবাইট এর কম হতে হবে'])
                            </div>
                        </div>
                        <div class="alert alert-callout alert-success small-padding">বিস্তারিত তথ্য</div>
                        <!---father name , mother name---->
                        <div class="row">
                            <div class="col-sm-6 form-group {{ $errors->has('fatherName')?'has-error':'' }}">
                                <label for="fatherName"> পিতার নাম</label>
                                <input type="text" class="form-control" name="fatherName" id="fatherName"
                                       value="{{$employees[0]->hasEmployeeDetails->father_name}}">
                            </div>
                            <div class="col-sm-6 form-group {{ $errors->has('motherName')?'has-error':'' }}">
                                <label for="motherName"> মাতার নাম</label>
                                <input type="text" class="form-control" name="motherName" id="motherName"
                                       value="{{$employees[0]->hasEmployeeDetails->mother_name}}">
                            </div>
                        </div>
                        <!---present address, permanent address---->
                        <div class="row">
                            <div class="col-sm-6 form-group {{ $errors->has('present_add')?'has-error':'' }}">
                                <label for="present_add">বর্তমান ঠিকানা</label>
                                <input type="text" class="form-control" name="present_add" id="present_add" required
                                       value="{{$employees[0]->hasEmployeeDetails->present_address}}">
                                @include('errors.formValidateError',['inputName' => 'present_add','msg'=>'আবশ্যক'])
                            </div>
                            <div class="col-sm-6 form-group {{ $errors->has('permanent_add')?'has-error':'' }}">
                                <label for="permanent_add">স্থায়ী ঠিকানা</label>
                                <input type="text" class="form-control" name="permanent_add" id="permanent_add"
                                       required value="{{$employees[0]->hasEmployeeDetails->permanent_address}}">
                                @include('errors.formValidateError',['inputName' => 'permanent_add','msg'=>'আবশ্যক'])
                            </div>
                        </div>
                        <!---dob, Nationality ---->
                        <div class="row">
                            <div class="col-sm-6 form-group {{ $errors->has('dob')?'has-error':'' }}">
                                <label for="dob">জন্ম তারিখ</label>
                                @if($employees[0]->hasEmployeeDetails->dob=='' || $employees[0]->hasEmployeeDetails->dob==null)
                                    @php $empDob=''; @endphp
                                @else
                                    @php
                                    $tmp=explode('-',$employees[0]->hasEmployeeDetails->dob);
                                    $empDob=$tmp[1].'/'.$tmp[2].'/'.$tmp[0];
                                    @endphp
                                @endif
                                <input readonly type="text" name="dob" id="dob" class="form-control" required
                                       value="{{str_replace(range(0,9),$bn_digits,$empDob)}}">
                                @include('errors.formValidateError',['inputName' => 'dob','msg'=>'আবশ্যক'])
                            </div>
                            <div class="col-sm-6 form-group {{ $errors->has('nationality')?'has-error':'' }}">
                                <label for="nationality">জাতীয়তা</label>
                                <input type="text" class="form-control" name="nationality" id="nationality"
                                       value="{{$employees[0]->hasEmployeeDetails->nationality}}">
                            </div>
                        </div>
                        <!---blood group, religions--->
                        <div class="row">
                            <div class="col-sm-6 form-group {{ $errors->has('bloodGroup')?'has-error':'' }}">
                                <label for="bloodGroup">রক্তের গ্রুপ</label>
                                <select name="bloodGroup" class="form-control-select" id="bloodGroup">
                                    <option value="0">রক্তের গ্রুপ নির্বাচন</option>
                                    @if(empty($bloodGroups))
                                        <option value="">No Blood</option>
                                    @else
                                        @foreach($bloodGroups as $bloodGroup)
                                            <option @if($bloodGroup->id==$employees[0]->hasEmployeeDetails->blood_group_id){{'selected'}}@endif
                                                    value="{{ $bloodGroup->id }}">
                                                {{$bloodGroup->blood_grp_name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-sm-6 form-group {{ $errors->has('religion')?'has-error':'' }}">
                                <label for="religion">ধর্ম</label>
                                <select name="religion" class="form-control-select" id="religion">
                                    <option @if(old('religion')=="মুসলিম"){{'selected'}}@endif value="মুসলিম">মুসলিম
                                    </option>
                                    <option @if(old('religion')=="হিন্দু"){{'selected'}}@endif value="হিন্দু">হিন্দু
                                    </option>
                                    <option @if(old('religion')=="বৌদ্ধ"){{'selected'}}@endif value="বৌদ্ধ">বৌদ্ধ
                                    </option>
                                    <option @if(old('religion')=="খ্রিষ্টান"){{'selected'}}@endif value="খ্রিষ্টান">
                                        খ্রিষ্টান
                                    </option>
                                </select>
                                @include('errors.formValidateError',['inputName' => 'religion','msg'=>'আবশ্যক'])
                            </div>
                        </div>
                        <!---gender , marital status---->
                        <div class="row">
                            <div class="col-sm-6 form-group {{ $errors->has('gender')?'has-error':'' }}">
                                <label for="gender" class="col-md-12" style="padding-left: 0px;">লিঙ্গ</label>
                                <input required
                                       @if($employees[0]->hasEmployeeDetails->gender=="পুরুষ"){{'checked'}}@endif  type="radio"
                                       class=""
                                       name="gender" value="পুরুষ">&nbsp;পুরুষ &nbsp;&nbsp;&nbsp;
                                <input required
                                       @if($employees[0]->hasEmployeeDetails->gender=="মহিলা"){{'checked'}}@endif type="radio"
                                       class=""
                                       name="gender" value="মহিলা">&nbsp;মহিলা
                                @include('errors.formValidateError',['inputName' => 'gender','msg'=>'আবশ্যক'])
                            </div>
                            <div class="col-sm-6 form-group {{ $errors->has('marital_status')?'has-error':'' }}">
                                <label for="marital_status" class="col-md-12" style="padding-left: 0px;">বৈবাহিক
                                    অবস্থা</label>
                                <input required
                                       @if($employees[0]->hasEmployeeDetails->maritial_status=="বিবাহিত"){{'checked'}}@endif type="radio"
                                       class="" name="marital_status" value="বিবাহিত">&nbsp;বিবাহিত &nbsp;&nbsp;&nbsp;
                                <input required
                                       @if($employees[0]->hasEmployeeDetails->maritial_status=="অবিবাহিত"){{'checked'}}@endif type="radio"
                                       class="" name="marital_status" value="অবিবাহিত">&nbsp;অবিবাহিত
                                @include('errors.formValidateError',['inputName' => 'marital_status','msg'=>'আবশ্যক'])
                            </div>
                        </div>

                        <div class="alert alert-callout alert-success">অফিসিয়াল তথ্য</div>
                        <!--designation , education,branch, role -->
                        <div class="row">
                            <div class="col-sm-6 form-group {{ $errors->has('designation')?'has-error':'' }}">
                                <label for="designation">পদবী</label>
                                <select required class="form-control-select" name="designation" id="designation">
                                    @if(empty($designation))
                                        <option value="">No designation</option>
                                    @else
                                        @foreach($designation as $des)
                                            <option @if($des->id==$employees[0]->designation_id){{'selected'}}@endif
                                                    value="{{ $des->id }}">
                                                {{$des->name }}</option></option>
                                        @endforeach
                                    @endif
                                </select>
                                @include('errors.formValidateError',['inputName' => 'designation','msg'=>'আবশ্যক'])
                            </div>
                            <div class="col-sm-6 form-group {{ $errors->has('education')?'has-error':'' }}">
                                <label for="education">শিক্ষাগত যোগ্যতা</label>
                                <select required class="form-control-select" name="education" id="education">
                                    <option value="">শিক্ষাগত যোগ্যতা নির্বাচন</option>
                                    @if(empty($educations))
                                        <option value="">No education</option>
                                    @else
                                        @foreach($educations as $education)
                                            <option @if($education->id==$employees[0]->hasEmployeeDetails->education_id){{'selected'}}@endif
                                                    value="{{ $education->id }}">
                                                {{$education->edu_name }}</option></option></option>
                                        @endforeach
                                    @endif
                                </select>
                                @include('errors.formValidateError',['inputName' => 'education','msg'=>'আবশ্যক'])
                            </div>
                            <div class="col-sm-6 form-group {{ $errors->has('branch')?'has-error':'' }}">
                                <label for="branch">শাখা অফিস</label>
                                <select required class="form-control-select" name="branch" id="branch">
                                    <option value="">অফিস নির্বাচন</option>
                                    @if(empty($branches))
                                        <option value="">No branch</option>
                                    @else
                                        @foreach($branches as $branch)
                                            <option @if($branch->id==$employees[0]->branch_id){{'selected'}}@endif
                                                    value="{{ $branch->id }}">
                                                {{$branch->name }}</option></option></option>
                                        @endforeach
                                    @endif
                                </select>
                                @include('errors.formValidateError',['inputName' => 'branch','msg'=>'আবশ্যক'])
                            </div>
                            <div class="col-sm-6 form-group {{ $errors->has('role')?'has-error':'' }}">
                                <label for="branch">সফটওয়্যার অ্যাডমিন</label>
                                <select required class="form-control-select" name="role" id="role">
                                    @if(empty($roles))
                                        <option value="1">No role</option>
                                    @else
                                        @foreach($roles as $role)
                                            <option @if($employees[0]->role_id==$role->id){{'selected'}}@endif value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @include('errors.formValidateError',['inputName' => 'role','msg'=>'আবশ্যক'])
                            </div>
                            <div class="col-sm-12">
                                <div class="col-sm-6 form-group {{ $errors->has('basicSalary')?'has-error':'' }}">
                                    <label for="basicSalary">মূল বেতন</label>
                                    <input type="text" class="form-control" name="basicSalary" id="basicSalary"
                                           value="{{$employees[0]->basic_salary}}">
                                </div>
                                <div class="col-sm-6 form-group" style="padding-top: 20px">
                                    <input @if(sizeof($is_login)!=0){{'checked'}}@endif type="checkbox" name="is_login"
                                           value="1"> লগইন অনুমোদন
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-database"></i> সংশোধন
                                করুন
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </section>
@endsection

@section('specifiedJs')
    <script type="text/javascript" src="{{url('public')}}/js/libs/selectize/selectize.min.js"></script>
    <script type="text/javascript" src="{{url('public')}}/js/libs/datepicker/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="{{url('public')}}/js/libs/image-resize/iEdit.js"></script>
    <script type="text/javascript" src="{{url('public')}}/js/libs/form-validation/validate.min.js"></script>
    <script type="text/javascript" src="{{url('public')}}/js/admin/employee.js"></script>
@endsection
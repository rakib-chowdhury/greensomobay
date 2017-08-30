@extends('layouts.app')

@section('specifiedCss')
    <link rel="stylesheet" href="{{url('public')}}/css/selectize/selectize.css" type="text/css">
    <link rel="stylesheet" href="{{url('public')}}/css/datepicker/bootstrap-datepicker.css">
    <link rel="stylesheet" href="{{url('public')}}/css/edit-image/iEdit.css">

@endsection

@section('content')
    <section>
        <div class="card">
            <div class="card-body">
                @include('includes.flashMessage')
                <div class="alert alert-callout alert-success "><b class="text-lg">কর্মচারী সংযোজন করুন</b>
                </div>
                <div class="">
                    <form action="{{ url('/admin/employee/store') }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="alert alert-callout alert-success small-padding">সাধারণ তথ্য</div>
                        <!---name, nid--->
                        <div class="row">
                            <div class="col-sm-6 form-group {{ $errors->has('name')?'has-error':'' }}">
                                <label for="name"><span style="color: red; font-size: 16px;">* </span>নাম</label>
                                <input type="text" class="form-control" name="name" id="name" value="{{old('name')}}"
                                       required>
                                @include('errors.formValidateError',['inputName' => 'name','msg'=>'কমপক্ষে ৪ অক্ষর হতে হবে'])
                            </div>
                            <div class="col-sm-6 form-group {{ $errors->has('nid')?'has-error':'' }}">
                                <label for="nid"><span style="color: red; font-size: 16px;">* </span>জাতীয় পরিচয়পত্র নং</label>
                                <input type="text" class="form-control" name="nid" id="nid" value="{{old('nid')}}"
                                       maxlength="17" minlength="17" required>
                                @include('errors.formValidateError',['inputName' => 'nid','msg'=>'১৭ অক্ষর হতে হবে'])
                            </div>
                        </div>
                        <!----mobile, pic---->
                        <div class="row">
                            <div class="col-sm-6 form-group {{ $errors->has('mobile')?'has-error':'' }}">
                                <label for="mobile"><span style="color: red;font-size: 16px;">* </span>মোবাইল</label>
                                <input type="text" class="form-control" name="mobile" value="{{old('mobile')}}"
                                       maxlength="11" id="mobile" required>
                                @include('errors.formValidateError',['inputName' => 'mobile','msg'=>'কমপক্ষে ৬ সংখ্যা হতে হবে'])
                            </div>
                            <div class="col-sm-6 form-group {{ $errors->has('image')?'has-error':'' }}">
                                <label for="image">ছবি</label>
                                <div class="profileImage admitPicture">
                                    <input type="file" name="image" id="image" class="col-sm-6">
                                    <div class="col-sm-6">
                                        <img id="pictureView">
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
                                       value="{{old('fatherName')}}">
                            </div>
                            <div class="col-sm-6 form-group {{ $errors->has('motherName')?'has-error':'' }}">
                                <label for="motherName"> মাতার নাম</label>
                                <input type="text" class="form-control" name="motherName" id="motherName"
                                       value="{{old('motherName')}}">
                            </div>
                        </div>
                        <!---present address, permanent address---->
                        <div class="row">
                            <div class="col-sm-6 form-group {{ $errors->has('present_add')?'has-error':'' }}">
                                <label for="present_add"><span style="color: red; font-size: 16px;">* </span>বর্তমান
                                    ঠিকানা</label>
                                <input type="text" class="form-control" name="present_add" id="present_add" required
                                       value="{{old('present_add')}}">
                                @include('errors.formValidateError',['inputName' => 'present_add','msg'=>'আবশ্যক'])
                            </div>
                            <div class="col-sm-6 form-group {{ $errors->has('permanent_add')?'has-error':'' }}">
                                <label for="permanent_add"><span style="color: red; font-size: 16px;">* </span>স্থায়ী
                                    ঠিকানা</label>
                                <input type="text" class="form-control" name="permanent_add" id="permanent_add"
                                       required value="{{old('permanent_add')}}">
                                @include('errors.formValidateError',['inputName' => 'permanent_add','msg'=>'আবশ্যক'])
                            </div>
                        </div>
                        <!---dob, Nationality ---->
                        <div class="row">
                            <div class="col-sm-6 form-group {{ $errors->has('dob')?'has-error':'' }}">
                                <label for="dob"><span style="color: red; font-size: 16px;">* </span>জন্ম তারিখ</label>
                                <input readonly type="text" name="dob" id="dob" class="form-control" required
                                       value="{{old('dob')}}">
                                @include('errors.formValidateError',['inputName' => 'dob','msg'=>'আবশ্যক'])
                            </div>
                            <div class="col-sm-6 form-group {{ $errors->has('nationality')?'has-error':'' }}">
                                <label for="nationality">জাতীয়তা</label>
                                <input type="text" class="form-control" name="nationality" id="nationality"
                                       value="{{old('nationality')}}">
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
                                            <option @if(old('bloodGroup')==$bloodGroup->id){{'selected'}}@endif value="{{ $bloodGroup->id }}">{{ $bloodGroup->blood_grp_name }}</option>
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
                                    <option @if(old('religion')=="বুদ্ধ"){{'selected'}}@endif value="বুদ্ধ">বুদ্ধ
                                    </option>
                                    <option @if(old('religion')=="ক্রিষ্টান"){{'selected'}}@endif value="ক্রিষ্টান">
                                        ক্রিষ্টান
                                    </option>
                                </select>
                                @include('errors.formValidateError',['inputName' => 'religion','msg'=>'আবশ্যক'])
                            </div>
                        </div>
                        <!---gender , marital status---->
                        <div class="row">
                            <div class="col-sm-6 form-group {{ $errors->has('gender')?'has-error':'' }}">
                                <label for="gender" class="col-md-12" style="padding-left: 0px;"><span
                                            style="color: red; font-size: 16px;">* </span>লিঙ্গ</label>
                                <input required @if(old('gender')=="পুরুষ"){{'checked'}}@endif  type="radio" class=""
                                       name="gender" value="পুরুষ">&nbsp;পুরুষ &nbsp;&nbsp;&nbsp;
                                <input required @if(old('gender')=="মহিলা"){{'checked'}}@endif type="radio" class=""
                                       name="gender" value="মহিলা">&nbsp;মহিলা
                                @include('errors.formValidateError',['inputName' => 'gender','msg'=>'আবশ্যক'])
                            </div>
                            <div class="col-sm-6 form-group {{ $errors->has('marital_status')?'has-error':'' }}">
                                <label for="marital_status" class="col-md-12" style="padding-left: 0px;"><span
                                            style="color: red; font-size: 16px;">* </span>বৈবাহিক অবস্থা</label>
                                <input required @if(old('marital_status')=="বিবাহিত"){{'checked'}}@endif type="radio"
                                       class="" name="marital_status" value="বিবাহিত">&nbsp;বিবাহিত &nbsp;&nbsp;&nbsp;
                                <input required @if(old('marital_status')=="অবিবাহিত"){{'checked'}}@endif type="radio"
                                       class="" name="marital_status" value="অবিবাহিত">&nbsp;অবিবাহিত
                                @include('errors.formValidateError',['inputName' => 'marital_status','msg'=>'আবশ্যক'])
                            </div>
                        </div>

                        <div class="alert alert-callout alert-success">অফিসিয়াল তথ্য</div>
                        <!--designation , education,branch, role -->
                        <div class="row">
                            <div class="col-sm-6 form-group {{ $errors->has('designation')?'has-error':'' }}">
                                <label for="designation"><span
                                            style="color: red; font-size: 16px;">* </span>পদবী</label>
                                <select required class="form-control-select" name="designation" id="designation">
                                    @if(empty($designation))
                                        <option value="">No designation</option>
                                    @else
                                        @foreach($designation as $des)
                                            <option @if(old('designation')==$des->id){{'selected'}}@endif value="{{ $des->id }}">{{ $des->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @include('errors.formValidateError',['inputName' => 'designation','msg'=>'আবশ্যক'])
                            </div>
                            <div class="col-sm-6 form-group {{ $errors->has('education')?'has-error':'' }}">
                                <label for="education"><span style="color: red; font-size: 16px;">* </span>শিক্ষাগত
                                    যোগ্যতা</label>
                                <select required class="form-control-select" name="education" id="education">
                                    <option value="">শিক্ষাগত যোগ্যতা নির্বাচন</option>
                                    @if(empty($educations))
                                        <option value="">No education</option>
                                    @else
                                        @foreach($educations as $education)
                                            <option @if(old('education')==$education->id){{'selected'}}@endif value="{{ $education->id }}">{{ $education->edu_name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @include('errors.formValidateError',['inputName' => 'education','msg'=>'আবশ্যক'])
                            </div>
                            <div class="col-sm-6 form-group {{ $errors->has('branch')?'has-error':'' }}">
                                <label for="branch"><span style="color: red; font-size: 16px;">* </span>শাখা
                                    অফিস</label>
                                <select required class="form-control-select" name="branch" id="branch">
                                    <option value="">অফিস নির্বাচন</option>
                                    @if(empty($branches))
                                        <option value="">No branch</option>
                                    @else
                                        @foreach($branches as $branch)
                                            <option @if(old('branch')==$branch->id){{'selected'}}@endif value="{{ $branch->id }}">{{ $branch->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @include('errors.formValidateError',['inputName' => 'branch','msg'=>'আবশ্যক'])
                            </div>
                            <div class="col-sm-6 form-group {{ $errors->has('role')?'has-error':'' }}">
                                <label for="branch"><span style="color: red; font-size: 16px;">* </span>সফটওয়্যার
                                    অ্যাডমিন</label>
                                <select required class="form-control-select" name="role" id="role">
                                    @if(empty($roles))
                                        <option value="1">No role</option>
                                    @else
                                        @foreach($roles as $role)
                                            <option @if(old('role')==$role->id){{'selected'}}@endif value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @include('errors.formValidateError',['inputName' => 'role','msg'=>'আবশ্যক'])
                            </div>
                            <div class="col-sm-12">
                                <div class="col-sm-6 form-group {{ $errors->has('basicSalary')?'has-error':'' }}">
                                    <label for="nationality"><span style="color: red; font-size: 16px;">* </span>মূল
                                        বেতন</label>
                                    <input type="text" class="form-control" name="basicSalary" id="basicSalary"
                                           value="{{old('basicSalary')}}">
                                </div>
                                <div class="col-sm-6 form-group" style="padding-top: 20px">
                                    <input type="checkbox" name="is_login" value="1"> লগইন অনুমোদন
                                </div>
                            </div>
                        </div>
                        <div class="form-group" style="text-align:center;">
                            <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-database"></i> সংযোজন
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
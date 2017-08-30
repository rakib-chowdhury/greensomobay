@extends('layouts.app')

@section('specifiedCss')
    <link rel="stylesheet" href="{{url('public')}}/css/selectize/selectize.css" type="text/css">
    <link rel="stylesheet" href="{{url('public')}}/css/datepicker/bootstrap-datepicker.css">
@endsection

@section('content')
    @php
    $bn_digits = array('০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯');
    @endphp
    <section>
        <div class="card">
            <div class="card-body">
                @include('includes.flashMessage')
                <div class="alert alert-callout alert-success "><b class="text-lg">বেতন</b>
                </div>
                <div class="">
                    <form action="{{ url('/admin/employee/store') }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                                <!---date--->
                        <div class="row">
                            <div class="col-sm-8 col-md-offset-2">
                                <!---employee name--->
                                <div class="col-sm-12 form-group {{ $errors->has('employee')?'has-error':'' }}">
                                    <label for="employee" class="col-sm-3"><span style="color: red; font-size: 16px;">* </span>সদস্যের নাম</label>
                                    <div class="col-sm-9">
                                        <select required class="form-control" name="employee" id="employee">
                                            @if(empty($employee))
                                                <option value="">No Employee</option>
                                            @else
                                                @foreach($employee as $row)
                                                    <option @if(old('employee')==$row->id){{'selected'}}@endif value="{{ $row->id }}">{{ $row->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @include('errors.formValidateError',['inputName' => 'employee','msg'=>'আবশ্যক'])
                                    </div>
                                </div>
                                <!--basic-->
                                <div class="col-sm-12 form-group {{ $errors->has('basic')?'has-error':'' }}">
                                    <label for="basic" class="col-sm-3"><span style="color: red; font-size: 16px;">* </span>মূল বেতন</label>
                                    <div class="col-sm-9">
                                        <input readonly type="text" class="form-control Basic" name="basic" id="basic" value="{{old('basic')}}" required>
                                        @include('errors.formValidateError',['inputName' => 'basic','msg'=>'আবশ্যক'])
                                    </div>
                                </div>

                                <!--advance-->
                                <div class="col-sm-12 form-group {{ $errors->has('advance')?'has-error':'' }}">
                                    <label for="advance" class="col-sm-3"><span style="color: red; font-size: 16px;">* </span>অগ্রিম</label>
                                    <div class="col-sm-9">
                                        <input readonly type="text" class="form-control" name="advance" id="advance" value="{{old('advance')}}" required>
                                        @include('errors.formValidateError',['inputName' => 'advance','msg'=>'আবশ্যক'])
                                    </div>
                                </div>
                                <!--Due-->
                                <div class="col-sm-12 form-group {{ $errors->has('due')?'has-error':'' }}">
                                    <label for="due" class="col-sm-3"><span style="color: red; font-size: 16px;">* </span>বকেয়া</label>
                                    <div class="col-sm-9">
                                        <input readonly type="text" class="form-control" name="due" id="due" value="{{old('due')}}" required>
                                        @include('errors.formValidateError',['inputName' => 'due','msg'=>'আবশ্যক'])
                                    </div>
                                </div>
                                <!--Bonus-->
                                <div class="col-sm-12 form-group {{ $errors->has('bonus')?'has-error':'' }}">
                                    <label for="bonus" class="col-sm-3"><span style="color: red; font-size: 16px;">* </span>বোনাস</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="bonus" id="bonus" value="{{old('bonus')}}" required>
                                        @include('errors.formValidateError',['inputName' => 'bonus','msg'=>'আবশ্যক'])
                                    </div>
                                </div>
                                <!--Deduction-->
                                <div class="col-sm-12 form-group {{ $errors->has('deduction')?'has-error':'' }}">
                                    <label for="deduction" class="col-sm-3"><span style="color: red; font-size: 16px;">* </span>কর্তন</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="deduction" id="deduction" value="{{old('deduction')}}" required>
                                        @include('errors.formValidateError',['inputName' => 'deduction','msg'=>'আবশ্যক'])
                                    </div>
                                </div>
                                <!--Addition-->
                                <div class="col-sm-12 form-group {{ $errors->has('addition')?'has-error':'' }}">
                                    <label for="addition" class="col-sm-3"><span style="color: red; font-size: 16px;">* </span>যোগ</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="addition" id="addition" value="{{old('addition')}}" required>
                                        @include('errors.formValidateError',['inputName' => 'addition','msg'=>'আবশ্যক'])
                                    </div>
                                </div>
                                <!--Description-->
                                <div class="col-sm-12 form-group {{ $errors->has('description')?'has-error':'' }}">
                                    <label for="description" class="col-sm-3"><span style="color: red; font-size: 16px;">* </span>বিবরণ</label>
                                    <div class="col-sm-9">
                                        <textarea type="text" class="form-control" name="description" id="description" value="{{old('description')}}" required>
                                        @include('errors.formValidateError',['inputName' => 'description','msg'=>'আবশ্যক'])
                                        </textarea>
                                    </div>
                                </div>
                                <!--Mobile No-->
                                <div class="col-sm-12 form-group {{ $errors->has('mobileNo')?'has-error':'' }}">
                                    <label for="mobileNo" class="col-sm-3"><span style="color: red; font-size: 16px;">* </span>মোবাইল নং</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="mobileNo" id="mobileNo" maxlength="11" minlength="11" value="{{old('mobileNo')}}" required>
                                        @include('errors.formValidateError',['inputName' => 'mobileNo','msg'=>'আবশ্যক'])
                                    </div>
                                </div>
                                <!--Total-->
                                <div class="col-sm-12 form-group {{ $errors->has('total')?'has-error':'' }}">
                                    <label for="total" class="col-sm-3"><span style="color: red; font-size: 16px;">* </span>মোট</label>
                                    <div class="col-sm-9">
                                        <input readonly type="text" class="form-control" name="total" id="total" value="{{old('total')}}" required>
                                        @include('errors.formValidateError',['inputName' => 'total','msg'=>'আবশ্যক'])
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-database"></i> সংযোজন করুন
                            </button>
                        </div>
                    </form>

                </div>
                <hr>
            </div>
        </div>
        </div>
    </section>
@endsection

@section('specifiedJs')
    <script type="text/javascript" src="{{url('public')}}/js/libs/selectize/selectize.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script>
        function checkNumber(id) {
            var tmp_num = $('#' + id).val().getDigitEnglishFromBangla();
            if (tmp_num == null || isNaN(tmp_num)) {
                var x = document.getElementById(id);
                x.value = x.value.replace(/[^0-9]/, '');
            }
        }
        $('#bonus').keyup(function () {
            checkNumber('bonus');
        }).blur(function () {
            checkNumber('bonus');
        });
        $('#deduction').keyup(function () {
            checkNumber('deduction');
        }).blur(function () {
            checkNumber('deduction');
        });
        $('#addition').keyup(function () {
            checkNumber('addition');
        }).blur(function () {
            checkNumber('addition');
        });
        $('#description').keyup(function () {
            checkNumber('description');
        }).blur(function () {
            checkNumber('description');
        });
        $('#mobileNo').keyup(function () {
            checkNumber('mobileNo');
        }).blur(function () {
            checkNumber('mobileNo');
        });

    </script>
@endsection
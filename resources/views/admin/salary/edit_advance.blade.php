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
                <div class="alert alert-callout alert-success "><b class="text-lg">অগ্রিম সংশোধন</b>
                </div>
                <div class="">
                    <form action="{{ url('/admin/advance/update') }}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="advance_salary_id" value="{{$page_info->id}}">
                                <!---date--->
                        <div class="row">
                            <div class="col-sm-8 col-md-offset-2">
                                <!---employee name--->
                                <div class="col-sm-12 form-group {{ $errors->has('employeeId')?'has-error':'' }}">
                                    <label for="employeeId" class="col-sm-3"><span style="color: red; font-size: 16px;">* </span>সদস্যের
                                        নাম</label>
                                    <div class="col-sm-9">
                                        <select required class="form-control" name="employeeId" id="employeeId">
                                            @if(empty($employeeId))
                                                <option value="">No Employee</option>
                                            @else
                                                @foreach($employeeId as $row)
                                                    <option @if($page_info->emp_id==$row->id){{'selected'}}@endif value="{{ $row->id }}">{{ $row->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @include('errors.formValidateError',['inputName' => 'employeeId','msg'=>'আবশ্যক'])
                                    </div>
                                </div>
                                <!--month-->
                                <div class="col-sm-12 form-group {{ $errors->has('month')?'has-error':'' }}">
                                    <label for="month" class="col-sm-3"><span
                                                style="color: red; font-size: 16px;">* </span>মাস</label>
                                    <div class="col-sm-9">
                                        <input readonly type="text" name="month" id="month" class="form-control" required
                                               value="{{$page_info->advance_month}}">
                                        @include('errors.formValidateError',['inputName' => 'month','msg'=>'আবশ্যক'])
                                    </div>
                                </div>
                                <!--basic-->
                                <div class="col-sm-12 form-group {{ $errors->has('amount')?'has-error':'' }}">
                                    <label for="amount" class="col-sm-3"><span
                                                style="color: red; font-size: 16px;">* </span>পরিমাণ</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control Basic" name="amount" id="amount"
                                               value="{{$page_info->amount}}" required>
                                        @include('errors.formValidateError',['inputName' => 'amount','msg'=>'আবশ্যক'])
                                    </div>
                                </div>
                                <!--date_received-->
                                <div class="col-sm-12 form-group {{ $errors->has('dateReceived')?'has-error':'' }}">
                                    <label for="dateReceived" class="col-sm-3"><span
                                                style="color: red; font-size: 16px;">* </span>অগ্রীম  গ্রহণের তারিখ</label>
                                    <div class="col-sm-9">
                                        <input readonly type="text" name="dateReceived" id="dateReceived" class="form-control dateInput" required
                                               value="{{$page_info->advance_received}}">
                                        @include('errors.formValidateError',['inputName' => 'dateReceived','msg'=>'আবশ্যক'])
                                    </div>
                                </div>
                                <!--Description-->
                                <div class="col-sm-12 form-group {{ $errors->has('description')?'has-error':'' }}">
                                    <label for="description" class="col-sm-3"><span
                                                style="color: red; font-size: 16px;">* </span>বিবরণ</label>
                                    <div class="col-sm-9">
                                        <textarea type="text" class="form-control" name="description" id="description"
                                                  required>{{$page_info->description}}</textarea>
                                        @include('errors.formValidateError',['inputName' => 'description','msg'=>'আবশ্যক'])
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-database"></i> সংযোজন
                                করুন
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
    <script type="text/javascript" src="{{url('public')}}/js/libs/datepicker/bootstrap-datepicker.js"></script>
    <script>
        function checkNumber(id) {
            var tmp_num = $('#' + id).val().getDigitEnglishFromBangla();
            if (tmp_num == null || isNaN(tmp_num)) {
                var x = document.getElementById(id);
                x.value = x.value.replace(/[^0-9]/, '');
            }
        }
        $('#month').datepicker({
            format: "yyyy-mm",
            viewMode: "months",
            minViewMode: "months"
        }).on('changeDate', function () {
        });
        $('#dateReceived').datepicker({
            format: "yyyy-mm-dd"
        }).on('changeDate', function () {
            console.log('sds');
        });
        $('#amount').keyup(function () {
            checkNumber('amount');
        }).blur(function () {
            checkNumber('amount');
        });

    </script>
@endsection
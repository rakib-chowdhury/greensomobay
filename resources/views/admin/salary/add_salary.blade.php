@extends('layouts.app')

@section('specifiedCss')
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
                <div class="alert alert-callout alert-success "><b class="text-lg"> বেতন সংযোজন</b>
                </div>
                <div class="">
                    <form action="{{ url('/admin/create_salary') }}" method="post">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-sm-8 col-md-offset-2">
                                <div class="col-sm-12 form-group {{ $errors->has('sal_mnth')?'has-error':'' }}">
                                    <label for="employeeId" class="col-sm-3"><span style="color: red; font-size: 16px;">* </span>মাস</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="sal_mnth" class="form-control mnth-class" required readonly  value="{{old('sal_mnth')}}">
                                        @include('errors.formValidateError',['inputName' => 'sal_mnth','msg'=>'আবশ্যক'])
                                    </div>
                                </div>
                                <div class="col-sm-12 form-group {{ $errors->has('working_day')?'has-error':'' }}">
                                    <label for="month" class="col-sm-3"><span
                                                style="color: red; font-size: 16px;">* </span>কার্যরত দিন</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="working_day" id="working_day" class="form-control" required
                                               value="{{old('working_day')}}">
                                        @include('errors.formValidateError',['inputName' => 'working_day','msg'=>'আবশ্যক'])
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
    <script type="text/javascript" src="{{url('public')}}/js/libs/datepicker/bootstrap-datepicker.js"></script>
    <script>
        $(function () {
            $(".mnth-class").datepicker({
                format: "yyyy-mm",
                viewMode: "months",
                minViewMode: "months",
            });

        });
    </script>
    <script>
        function checkNumber(id) {
            var tmp_num = $('#' + id).val().getDigitEnglishFromBangla();
            if (tmp_num == null || isNaN(tmp_num)) {
                var x = document.getElementById(id);
                x.value = x.value.replace(/[^0-9]/, '');
            }
        }

        $('#working_day').keyup(function () {
            checkNumber('working_day');
        }).blur(function () {
            checkNumber('working_day');
        });

    </script>
@endsection
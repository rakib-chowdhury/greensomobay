@extends('layouts.app')

@section('specifiedCss')
    <link rel="stylesheet" href="{{url('public')}}/css/selectize/selectize.css" type="text/css">
    <link rel="stylesheet" href="{{url('public')}}/css/datepicker/bootstrap-datepicker.css">
@endsection

@section('content')
    <section>
        <div class="card">
            <div class="card-body">
                @include('includes.flashMessage')
                <div class="alert alert-callout alert-success "><b class="text-lg">শেয়ার ফান্ড ফেরত</b>
                </div>
                <div class="">
                    <form action="{{ url('/admin/return_share') }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <!---name, nid--->
                        <div class="row">
                            <div class="col-sm-8 col-md-offset-2">
                                <!--date-->
                                <div class="col-sm-12 form-group {{ $errors->has('share_date')?'has-error':'' }}">
                                    <label for="share_date" class="col-sm-3"><span style="color: red; font-size: 16px;">* </span>তারিখ</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control share_date" name="share_date" id="share_date" value="{{date('m/d/Y')}}" required>
                                        @include('errors.formValidateError',['inputName' => 'share_date','msg'=>'আবশ্যক'])
                                    </div>
                                </div>
                                <!---member name--->
                                <div class="col-sm-12 form-group {{ $errors->has('member')?'has-error':'' }}">
                                    <label for="member" class="col-sm-3"><span style="color: red; font-size: 16px;">* </span>সদস্যের নাম</label>
                                    <div class="col-sm-9">
                                        <select required class="form-control" name="member" id="member">
                                            @if(empty($member_list))
                                                <option value="">No member</option>
                                            @else
                                                @foreach($member_list as $row)
                                                    <option @if(old('member')==$row->id){{'selected'}}@endif value="{{ $row->id }}">{{ $row->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @include('errors.formValidateError',['inputName' => 'member','msg'=>'আবশ্যক'])
                                    </div>
                                </div>
                                <!--share number-->
                                <div class="col-sm-12 form-group {{ $errors->has('share_num')?'has-error':'' }}">
                                    <label for="share_num" class="col-sm-3"><span style="color: red; font-size: 16px;">* </span>শেয়ার সংখ্যা</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="share_num" id="share_num" value="{{old('share_num')}}" required>
                                        @include('errors.formValidateError',['inputName' => 'share_num','msg'=>'আবশ্যক'])
                                    </div>
                                </div>
                                <!--per_share_price-->
                                <div class="col-sm-12 form-group {{ $errors->has('per_share_price')?'has-error':'' }}">
                                    <label for="per_share_price" class="col-sm-3"><span style="color: red; font-size: 16px;">* </span>প্রতি শেয়ার মূল্য </label>
                                    <div class="col-sm-9">
                                        <input readonly type="text" class="form-control" name="per_share_price" id="per_share_price" value="{{$share_info}}" required>
                                        @include('errors.formValidateError',['inputName' => 'per_share_price','msg'=>'আবশ্যক'])
                                    </div>
                                </div>
                                <!--share price-->
                                <div class="col-sm-12 form-group {{ $errors->has('share_pricw')?'has-error':'' }}">
                                    <label for="share_price" class="col-sm-3"><span style="color: red; font-size: 16px;">* </span>মোট শেয়ার মূল্য</label>
                                    <div class="col-sm-9">
                                        <input readonly type="text" class="form-control" name="share_price" id="share_price" value="{{old('share_num')}}" required>
                                        @include('errors.formValidateError',['inputName' => 'share_price','msg'=>'আবশ্যক'])
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
            </div>
        </div>
    </section>
@endsection

@section('specifiedJs')
    <script type="text/javascript" src="{{url('public')}}/js/libs/selectize/selectize.min.js"></script>
    <script type="text/javascript" src="{{url('public')}}/js/libs/datepicker/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="{{url('public')}}/js/libs/form-validation/validate.min.js"></script>
    <script>
        function get_share_price(id) {
            var tmp_num = $('#' + id).val().getDigitEnglishFromBangla();
            if(tmp_num==''){
                tmp_num=0;
            }
            var tmp_num2 = $('#per_share_price').val().getDigitEnglishFromBangla();
            console.log(tmp_num+'dd'+tmp_num2);
            var res= ((parseFloat(tmp_num)*parseFloat(tmp_num2))+'').getDigitBanglaFromEnglish();
            $('#share_price').val(res);

        }
        function checkNumber(id) {
            var tmp_num = $('#' + id).val().getDigitEnglishFromBangla();
            if (tmp_num == null || isNaN(tmp_num)) {
                var x = document.getElementById(id);
                x.value = x.value.replace(/[^0-9]/, '');
            }
            get_share_price(id);
        }
        $(document).ready(function () {
            $('.share_date').datepicker();

            $('#member').selectize();

            $('#share_num').keyup(function () {
                checkNumber('share_num');
            }).blur(function () {
                checkNumber('share_num');
            });
        });
    </script>
@endsection
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
                <div class="alert alert-callout alert-success "><b class="text-lg">সদস্য ভর্তি</b>
                </div>
                <div class="">
                    <form action="{{ url('/admin/member_admission') }}" method="post">
                        {{ csrf_field() }}
                        <div class="row">
                            <!--date-->
                            <div class="col-sm-6 form-group {{ $errors->has('share_date')?'has-error':'' }}">
                                <label for="share_date"><span
                                            style="color: red; font-size: 16px;">* </span>তারিখ</label>

                                <input type="text" class="form-control share_date" name="share_date"
                                       id="share_date" value="{{date('m/d/Y')}}" required>
                                @include('errors.formValidateError',['inputName' => 'share_date','msg'=>'আবশ্যক'])

                            </div>
                            <!---member name--->
                            <div class="col-sm-6 form-group {{ $errors->has('member')?'has-error':'' }}">
                                <label for="member"><span
                                            style="color: red; font-size: 16px;">* </span>সদস্যের নাম</label>

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
                            <!--sdmission fee-->
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-sm-offset-0 form-group table-responsive">
                                <table id="member_admission_table" class="table table-bordered">
                                    <tr>
                                        <td colspan="2">বিস্তারিত</td>
                                        <td>ইউনিট</td>
                                        <td>ইউনিট মূল্য</td>
                                        <td>মোট</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">ভর্তি ফি</td>
                                        <td>১</td>
                                        <input type="hidden" name="admissionFee" value="{{$admission_fee}}">
                                        <td>{{str_replace(range(0,9),$bn_digits,$admission_fee)}}</td>
                                        <td>{{str_replace(range(0,9),$bn_digits,$admission_fee)}} টাকা</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">শেয়ার ফান্ড গ্রহণ</td>
                                        <td>
                                            <input type="text" name="share_num" id="share_num"
                                                   class="form-control"
                                                   value="১"></td>
                                        <td><input type="hidden" name="per_share_price" id="per_share_price"
                                                   value="{{$share_price}}">{{str_replace(range(0,9),$bn_digits,$share_price)}}
                                        </td>
                                        <td>
                                            <span id="t_share_price">{{str_replace(range(0,9),$bn_digits,$share_price)}}</span>
                                            টাকা
                                        </td>
                                    </tr>
                                    {{--<tr>--}}
                                        {{--<td colspan="5">--}}
                                            {{--<button type="button" id="add_other_fee" class="btn btn-success btn-raised"><span--}}
                                                        {{--class="fa fa-plus-circle"></span> বিবিধ আদায়--}}
                                            {{--</button>--}}
                                        {{--</td>--}}
                                    {{--</tr>--}}
                                    <tr>
                                        <td colspan="4" style="text-align: right">সর্বমোট</td>
                                        <td>
                                            <span id="net_total">{{str_replace(range(0,9),$bn_digits,($admission_fee+$share_price))}}</span>
                                            টাকা
                                        </td>
                                    </tr>
                                </table>
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
        var childNum = 0;

        function doCal() {
            var s = document.getElementById("member_admission_table").rows.length - 1;
            var admisn = parseFloat(<?= $admission_fee?>);
            var totalVal = admisn;
            $('#member_admission_table tr').each(function (i, v) {
                if (i > 1 && i != 3 && i != s) {
                    if (i == 2) {
                        var chld1 = $(this).find('td:nth-child(2) input').val();
                        chld1 = (chld1 + '').getDigitEnglishFromBangla();
                        if (chld1 == null || chld1 == '') {
                            chld1 = 0;
                        }

                        var chld2 = $(this).find('td:nth-child(3) input').val();
                        chld2 = (chld2 + '').getDigitEnglishFromBangla();
                        if (chld2 == null || chld2 == '') {
                            chld2 = 0;
                        }
                        var res = parseFloat(chld1) * parseFloat(chld2);
                        totalVal += res;
                        $('#t_share_price').text((res+'').getDigitBanglaFromEnglish());
                    } else {
                        console.log(i + '--ch2--' + $(this).find('td:nth-child(2) input').val());
                        console.log(i + '--ch3--' + $(this).find('td:nth-child(3) input').val());
                        console.log(i + '--ch4--' + $(this).find('td:nth-child(4) input').val());

                        var chld1 = $(this).find('td:nth-child(3) input').val();
                        chld1 = (chld1 + '').getDigitEnglishFromBangla();
                        if (chld1 == null || chld1 == '') {
                            chld1 = 0;
                        }

                        var chld2 = $(this).find('td:nth-child(4) input').val();
                        chld2 = (chld2 + '').getDigitEnglishFromBangla();
                        if (chld2 == null || chld2 == '') {
                            chld2 = 0;
                        }
                        res = parseFloat(chld1) * parseFloat(chld2);
                        totalVal += res;

                        $(this).find('td:nth-child(5)').text((res+'').getDigitBanglaFromEnglish());
                    }
                }
            });

            $('#net_total').text((totalVal + '').getDigitBanglaFromEnglish());
        }

        function checkNumber(id) {
            var tmp_num = $('#' + id).val().getDigitEnglishFromBangla();
            if (tmp_num == null || isNaN(tmp_num)) {
                var x = document.getElementById(id);
                x.value = x.value.replace(/[^0-9]/, '');
            }
            doCal();
        }

        function checkPrice(id) {
            var tmp_num = $('#' + id).val().getDigitEnglishFromBangla();
            if (tmp_num == null || isNaN(tmp_num)) {
                var x = document.getElementById(id);
                x.value = x.value.replace(/[^0-9.]/, '');
            }

            doCal();
        }

        function rmv(id) {
            $('#' + id).remove();
            doCal();
        }

        $(document).ready(function () {
            $('.share_date').datepicker();

            $('#member').selectize();

            $('#share_num').keyup(function () {
                checkNumber('share_num');
            }).blur(function () {
                checkNumber('share_num');
            });

            $('#add_other_fee').click(function () {
                childNum++;
                var trow = '<tr id="' + childNum + '">'
                        + '<td><button onclick="rmv(' + childNum + ')" class="btn btn-danger btn-rounded">X</button></td>'
                        + '<td><input type="text" name="other_fee_field[]" class="form-control"></td>'
                        + '<td><input onkeyup="checkNumber(this.id)" onblur="checkNumber(this.id)" id="otherUnit' + childNum + '" type="text" name="other_fee_unit_num[]" class="form-control"></td>'
                        + '<td><input onkeyup="checkPrice(this.id)" onblur="checkPrice(this.id)" id="otherUnitPriec' + childNum + '" type="text" name="other_fee_unit_price[]" class="form-control"></td>'
                        + '<td><span id="other_fee_price[]"></span></td>'
                        + '</tr>';
                $('#member_admission_table tr:last').before(trow);
            });
        });
    </script>
@endsection
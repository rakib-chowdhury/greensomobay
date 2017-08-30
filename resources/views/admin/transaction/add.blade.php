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
                <div class="alert alert-callout alert-success "><b class="text-lg">ট্রানজেক্শন</b>
                </div>
                <div class="">
                    <form action="" method="">
                        {{ csrf_field() }}
                        <div class="row">
                            <!--date-->
                            <div class="col-sm-6 form-group {{ $errors->has('share_date')?'has-error':'' }}">
                                <label for="share_date"><span
                                            style="color: red; font-size: 16px;">* </span>তারিখ</label>

                                <input readonly type="text" class="form-control share_date" name="share_date"
                                       id="date" value="{{old('share_date')}}" required>
                                @include('errors.formValidateError',['inputName' => 'share_date','msg'=>'আবশ্যক'])

                            </div>
                            <!--sdmission fee-->
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-sm-offset-0 form-group table-responsive">
                                <table id="member_admission_table" class="table table-bordered">
                                    <tr>
                                        <td style="width: 5%; text-align: center">#</td>
                                        <td style="width: 25%; text-align: center">কর্মচারীর নাম</td>
                                        <td style="width: 15%; text-align: center">ধরণ</td>
                                        <td style="width: 10%; text-align: center">টাকা</td>
                                        <td style="text-align: center">বিবরণ</td>
                                        <td style="width:5%">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            1
                                        </td>
                                        <td>
                                            <select name="" id="" class="form-control select-class">
                                                @if(sizeof($employee)==0)
                                                    <option value="">no Employee</option>
                                                @else
                                                    @foreach($employee as $row)
                                                        <option value="{{$row->id}}">{{$row->name}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </td>
                                        <td>
                                            <select name="" id="" class="form-control  select-class">
                                                @if(sizeof($employee)==0)
                                                    <option value="">no Employee</option>
                                                @else
                                                    @foreach($employee as $row)
                                                        <option value="{{$row->id}}">{{$row->name}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" name="amount" id="amount" class="form-control">
                                        </td>
                                        <td>
                                            <textarea name="description" class="form-control"></textarea>
                                        </td>
                                        <td>
                                            <button type="button" id="add_other_fee" class="btn btn-success btn-raised"><span
                                                        class="fa fa-plus-circle"></span>
                                            </button>
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
        var childNumTop = 0;

        function doCal() {
            var s = document.getElementById("member_admission_table").rows.length - 1;
            var admisn = parseFloat(<?= $share_info?>);
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
                        $('#t_share_price').text((res + '').getDigitBanglaFromEnglish());
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

                        $(this).find('td:nth-child(5)').text((res + '').getDigitBanglaFromEnglish());
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
            //doCal();
        }

        $(document).ready(function () {
            $('.share_date').datepicker();

            $('.select-class').selectize();

            $('#share_num').keyup(function () {
                checkNumber('share_num');
            }).blur(function () {
                checkNumber('share_num');
            });
            $('#amount').keyup(function () {
                checkNumber('amount');
            }).blur(function () {
                checkNumber('amount');
            });
            $('#add_other_fee').click(function () {
                childNum++;
                var trow = '<tr id="' + childNum + '">'
                        + '<td><input type="text" name="other_fee_field[]" class="form-control"></td>'
                        + '<td><select id="employee' + childNum + '" type="text" name="employee" class="select-class form-control">'
                        + '<?php if (sizeof($employee) == 0) {
                            echo '<option value="">No Employee</option>';
                        } else {
                            foreach ($employee as $row) {
                                echo '<option value="' . $row->id . '">' . $row->name . '</option>';
                            }
                        }?></select></td>'
                        + '<td><select id="employee' + childNum + '" type="text" name="employee" class="form-control select-class">'
                        + '<?php if (sizeof($employee) == 0) {
                            echo '<option value="">No Employee</option>';
                        } else {
                            foreach ($employee as $row) {
                                echo '<option value="' . $row->id . '">' . $row->name . '</option>';
                            }
                        }?></select></td>'
                        + '<td><input onkeyup="checkPrice(this.id)" onblur="checkPrice(this.id)" id="a' + childNum + '" type="text" name="other_fee_unit_price[]" class="form-control"></td>'
                        + '<td><textarea name="description1" class="form-control"></textarea></td>'
                        + '<td><button onclick="rmv(' + childNum + ')" class="btn btn-danger btn-rounded">-</button></td>'
                        + '</tr>';
                $('#member_admission_table tr:last').after(trow);
            });
        });

    </script>
@endsection
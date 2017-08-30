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
                    <h2><b>আংশিক সঞ্চয় উত্তোলন ফর্ম </b></h2>
                </div>
                <div class="paddings-mini"></div>
                <!--form CONTENT-->
                <div class="form-content">
                    <form id="partial-saving" method="post" action="{{url('/partialSavings')}}" class="form"
                          enctype="multipart/form-data">
                        {{csrf_field()}}
                        <input type="hidden" name="mem_id" value="{{$member_info->id}}">
                        <!--                    to start -->
                        <div class="row">
                            <!-- single form input -->
                            <div class="form-group col-sm-12 {{ $errors->has('applierName') ? 'has-error' : '' }}">
                                <div class="row">
                                    <label for="applicantTo">বরাবর, </label>
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
                                    <label for="area">গ্রীন, পঞ্চগড় । </label>
                                </div>
                            </div>
                        </div>
                        <!-- subject start-->
                        <div class="row">
                            <div class="form-group col-sm-12 {{ $errors->has('applierOccupation') ? 'has-error' : '' }}">
                                <div class="row">
                                    <label for="subject"><b>বিষয় : আংশিক সঞ্চয় উত্তোলনের জন্য আবেদন ।</b> </label>

                                </div>
                            </div>
                        </div>
                        <hr>
                        <!--subject end-->


                        <div class="row">
                            <div class="col-sm-12 form-group {{ $errors->has('thana') ? 'has-error' : '' }}">
                                <div class="row">
                                    <label for="termLoan"><h4><b>জনাব,</b></h4></label>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 ">
                                        <div style="color: #0a0c0e" class="col-sm-8">
                                            আমি নিম্নস্বাক্ষরিত আপনার সমিতির একজন সদস্য । আমার ব্যাক্তিগত সমস্যার কারণে
                                            জমাকৃত মোট সঞ্চয়

                                        </div>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" name="savedMoney" id="savedMoney"
                                                   placeholder="সঞ্চিত টাকা  টাকার পরিমাণ  " readonly required
                                                   value="{{str_replace(range(0,9),$bn_digits,$deposit)}}">
                                            @include('errors.formValidateError',['inputName' => 'savedMoney'])
                                        </div>
                                        <hr>
                                    </div>
                                    <div class="col-sm-12 ">
                                        <div style="color: #0a0c0e" class="col-sm-2">
                                            টাকা থেকে আংশিক
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control" name="withdrawMoney"
                                                   id="withdrawMoney" placeholder=" উত্তোলিত টাকার পরিমান   " required
                                                   value="{{old('withdrawMoney')}}">
                                            @include('errors.formValidateError',['inputName' => 'withdrawMoney'])
                                        </div>
                                        <div class="col-sm-7" style="color: #0a0c0e">
                                            টাকা উত্তোলনের জন্য আবেদন করছি ।
                                        </div>
                                        <hr>
                                    </div>
                                    <div id="errMSG" class="col-sm-12 text-center" style="color: red;">
                                    </div>
                                    <div class="col-sm-12 ">
                                        <div class="col-sm-10" style="color: #0a0c0e">
                                            </br>অতএব, বিষয়টি আপনার সদয় অবগতি ও আমার জমাকৃত সঞ্চয় থেকে আংশিক সঞ্চয়
                                            উত্তোলনের জন্য আবেদন করছি ।
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-offset-6 form-group {{ $errors->has('applicantName') ? 'has-error' : '' }}">

                                <div class="row">
                                    <div class="col-sm-4 text-right">
                                        <label for="applicantName"><span style="color: red;">* </span> আবেদনকারীর নাম :
                                        </label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input class="form-control" type="text" name="applicantName" id="applicantName"
                                               placeholder="আবেদনকারীর নাম"
                                               value="{{str_replace(range(0,9),$bn_digits,$member_info->name)}}"
                                               readonly required>

                                        @include('errors.formValidateError',['inputName' => 'applicantName'])
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-offset-6 form-group {{ $errors->has('sign') ? 'has-error' : '' }}">
                                <div class="row">
                                    <div class="col-sm-4 text-right">
                                        <label for="applicantSignature"><span style="color: red;">* </span>স্বাক্ষর
                                        </label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="signature">
                                            <img id="applicantSignatureView"
                                                 src="{{url('public/img/member/'.$member_info->hasMemberDetails->member_sign)}}"
                                                 style="width: 120px; height: 60px">
                                        </div>
                                        @include('errors.formValidateError',['inputName' => 'sign'])
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-offset-6 form-group {{ $errors->has('thana') ? 'has-error' : '' }}">

                                <div class="row">
                                    <div class="col-sm-4 text-right">
                                        <label for="codeName"><span style="color: red;">* </span> রেজিস্ট্রেশন নং
                                            :</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input class="form-control" type="text" name="codeName" id="codeName"
                                               placeholder="রেজিস্ট্রেশন নং "
                                               value="{{str_replace(range(0,9),$bn_digits,$member_info->registration_no)}}"
                                               required readonly>

                                        @include('errors.formValidateError',['inputName' => 'codeName'])
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-offset-6 form-group {{ $errors->has('address') ? 'has-error' : '' }}">

                                <div class="row">
                                    <div class="col-sm-4 text-right">
                                        <label for="address"><span style="color: red;">* </span>ঠিকানা :</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input class="form-control" type="text" name="address" id="address"
                                               placeholder="ঠিকানা"
                                               value="{{$member_info->hasMemberDetails->current_location}}, {{$member_info->hasMemberDetails->current_postoffice}}, {{$member_info->hasMemberDetails->hasCurrUpz->bn_name}}, {{$member_info->hasMemberDetails->hasCurrDistrict->bn_name}}, {{$member_info->hasMemberDetails->hasCurrDivision->name}}"
                                               readonly>

                                        @include('errors.formValidateError',['inputName' => 'address'])
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-offset-6 form-group {{ $errors->has('applicantMobile') ? 'has-error' : '' }}">
                                <div class="row">
                                    <div class="col-sm-4 text-right">
                                        <label for="applicantMobile"><span style="color: red;">* </span> মোবাইল
                                            নং</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="text" maxlength="11" class="form-control" name="applicantMobile"
                                               id="applicantMobile" placeholder="সদস্যের  মোবাইল নং" required readonly
                                               value="{{str_replace(range(0,9),$bn_digits,$member_info->phone)}}">
                                        @include('errors.formValidateError',['inputName' => 'applicantMobile'])
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>

                        {{--<div class="row">--}}
                        {{--<div class="col-sm-6 form-group {{ $errors->has('thana') ? 'has-error' : '' }}">--}}
                        {{--<div class="row">--}}
                        {{--<div class="col-sm-12" style="color: #0a0c0e">--}}
                        {{--<h4><b>ফিল্ড অর্গানাইজারের মন্তব্য : </b></br></h4>--}}
                        {{--আবেদনপত্রটি বিবেচনা পূর্বক তার আংশিক সঞ্চয়  উত্তোলনের জন্য সুপারিশ করছি ।--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="row">--}}
                        {{--<div class="col-sm-12 form-group {{ $errors->has('applicantSignature') ? 'has-error' : '' }}">--}}
                        {{--<div class="row" style="float: right">--}}
                        {{--<div class="col-sm-4 text-right">--}}
                        {{--<label for="applicantSignature"><span style="color: red;">* </span>আবেদনকারীর স্বাক্ষর   </label>--}}
                        {{--</div>--}}
                        {{--<div class="col-sm-8">--}}
                        {{--<div class="signature">--}}
                        {{--<input type="file" id="applicantSignature" name="applicantSignature" required--}}
                        {{--class="form-control">--}}
                        {{--<img id="applicantSignature1View">--}}
                        {{--</div>--}}
                        {{--@include('errors.formValidateError',['inputName' => 'applicantSignature'])--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        {{--</div><hr>--}}

                        {{--<div class="row">--}}
                        {{--<div class="col-sm-7" style="color: #0a0c0e">--}}
                        {{--আবেদনকারীর আবেদনপত্রটি বিবেচনা করে তার জমাকৃত সঞ্চয় আমানত হতে আংশিক--}}
                        {{--</div>--}}
                        {{--<div class="col-sm-2 form-group {{ $errors->has('money') ? 'has-error' : '' }}">--}}
                        {{--<input type="text"  class="form-control" name="money" id="money"  placeholder=' টাকা '>--}}
                        {{--@include('errors.formValidateError',['inputName' => 'money'])--}}
                        {{--</div>--}}
                        {{--<div class="col-sm-3">--}}
                        {{--<input readonly="" type="text"  class="form-control" name="applicantMobile" id="applicantMobile"  placeholder=' টাকা '>--}}
                        {{--@include('errors.formValidateError',['inputName' => 'applicantMobile'])--}}
                        {{--</div>--}}

                        {{--</div>--}}
                        {{--<div class="row">--}}
                        {{--<div class="col-sm-2" style="color: #0a0c0e">--}}
                        {{--টাকা । অদ্য--}}
                        {{--</div>--}}
                        {{--<div class="col-sm-3 form-group {{ $errors->has('signatureDate') ? 'has-error' : '' }}">--}}
                        {{--<input type="text" class=" form-control dateInput" name="signatureDate" id="signatureDate"  >--}}
                        {{--@include('errors.formValidateError',['inputName' => 'signatureDate'])--}}
                        {{--</div>--}}
                        {{--<div class="col-sm-3" style="color: #0a0c0e">--}}
                        {{--ইং তারিখ এ নগদে প্রদান করে অবশিষ্ট--}}
                        {{--</div>--}}
                        {{--<div class="col-sm-3 form-group {{ $errors->has('deposit') ? 'has-error' : '' }}">--}}
                        {{--<input   type="text"   class="form-control" name="deposit" id="deposit"  placeholder=' টাকা '>--}}
                        {{--@include('errors.formValidateError',['inputName' => 'deposit'])--}}
                        {{--</div>--}}
                        {{--<div class="col-sm-3" style="color: #0a0c0e">--}}
                        {{--টাকা সঞ্চয় রাখা হলো । --}}
                        {{--</div>--}}
                        {{--</div>--}}
                        {{--<hr>--}}
                        <div class="row">
                            <div class="col-sm-offset-3" style="color: #0a0c0e">
                                <h4><b> অনুমোদনের জন্য সমিতির কার্যলয়ের বইসহ পাঠাতে হবে । </b></h4>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-2"></div>
                                <div class="col-sm-12" style="text-align: center">
                                    <button type="submit" id="btn" class="btn btn-success btn-lg"><i
                                                class="fa fa-save"></i> আবেদন করুন
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>

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
    <script type="text/javascript" src="{{url('public')}}/js/form/partial-saving.js"></script>
    <script>
        $(function () {
            $(".dateInput").datepicker();
            $('#division').selectize({
                create: true,
                sortField: {field: 'text'}
            });
        });
    </script>
    <script>
        var finalEnlishToBanglaNumber = {
            '0': '০',
            '1': '১',
            '2': '২',
            '3': '৩',
            '4': '৪',
            '5': '৫',
            '6': '৬',
            '7': '৭',
            '8': '৮',
            '9': '৯'
        };
        var finalBanglaToEnlishNumber = {
            '০': '0',
            '১': '1',
            '২': '2',
            '৩': '3',
            '৪': '4',
            '৫': '5',
            '৬': '6',
            '৭': '7',
            '৮': '8',
            '৯': '9'
        };

        String.prototype.getDigitBanglaFromEnglish = function () {
            var retStr = this;
            for (var x in finalEnlishToBanglaNumber) {
                retStr = retStr.replace(new RegExp(x, 'g'), finalEnlishToBanglaNumber[x]);
            }
            return retStr;
        };
        String.prototype.getDigitEnglishFromBangla = function () {
            var retStr = this;
            for (var x in finalBanglaToEnlishNumber) {
                retStr = retStr.replace(new RegExp(x, 'g'), finalBanglaToEnlishNumber[x]);
            }
            return retStr;
        };

        function checkNumber(id) {
            var tmp_num = $('#' + id).val().getDigitEnglishFromBangla();
            if (tmp_num == null || isNaN(tmp_num)) {
                var x = document.getElementById(id);
                x.value = x.value.replace(/[^0-9]/, '');
            }

            var targetAmnt =<?= $deposit?>;

            if ($('#' + id).val().getDigitEnglishFromBangla() >= targetAmnt) {
                $('#errMSG').text('উত্তোলনকৃত টাকা জমাকৃত টাকার চেয়ে কম হতে হবে');
            }else{
                $('#errMSG').text('');
            }
        }


        $('#withdrawMoney').keyup(function () {
            checkNumber('withdrawMoney');
        }).blur(function () {
            checkNumber('withdrawMoney');
        });

    </script>
@endsection
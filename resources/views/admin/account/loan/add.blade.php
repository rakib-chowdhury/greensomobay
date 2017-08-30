@extends('layouts.app')

@section('specifiedCss')
    <link rel="stylesheet" href="{{url('public')}}/css/selectize/selectize.css" type="text/css">
    <link rel="stylesheet" href="{{url('public')}}/css/datepicker/bootstrap-datepicker.css">
@endsection
@php
$bn_digits = array('০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯');
@endphp
@section('content')
    <section>
        <div class="card">
            <div class="card-body">
                @include('includes.flashMessage')
                <div class="alert alert-callout alert-success "><b class="text-lg">ঋণ ও সার্ভিস চার্জ আদায়</b>
                </div>
                <form action="{{url('admin/collect_loan')}}" method="post">
                    {{csrf_field()}}
                    <div class="row">
                        <div class="col-md-3 form-group">
                            <label for="loan_date">তারিখ</label>
                            <input type="text" name="loan_date" value="{{date('m/d/Y')}}" id="loan_date"
                                   class="form-control">
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tr>
                                <th>#</th>
                                <th>ছবি</th>
                                <th>নাম</th>
                                <th>ঠিকানা</th>
                                <th>ঋণ</th>
                                <th>সার্ভিস চার্জ</th>
                                <th>ঋণ বীমা</th>
                            </tr>
                            @if(sizeof($member)==0)
                                <tr>
                                    <td colspan="7">কোনো তথ্য নেই</td>
                                </tr>
                            @else
                                @foreach($member as $key=>$row)
                                    <input type="hidden" name="mem_id[]" value="{{$row->id}}">
                                    <tr>
                                        <td>{{str_replace(range(0,9),$bn_digits,$key+1)}}</td>
                                        <td><img style="width: 60px; height: 60px;"
                                                 src="{{url('public/img/member/'.$row->hasMember->pic)}}" alt="">
                                        </td>
                                        <td>{{$row->hasMember->name}}</td>
                                        <td>{{$row->hasMember->hasMemberDetails->hasCurrDivision->name.', '.$row->hasMember->hasMemberDetails->hasCurrDistrict->bn_name.', '.$row->hasMember->hasMemberDetails->hasCurrUpz->bn_name.', '.$row->hasMember->hasMemberDetails->current_postoffice.', '.$row->hasMember->hasMemberDetails->current_location}}</td>
                                        <td>
                                            @if(sizeof($row->hasMember->hasTransaction)==0)
                                                <input type="text" class="form-control" name="loan_amount[]">
                                            @else
                                                <input type="text" class="form-control" name="loan_amount[]" value="{{$row->hasMember->hasTransaction[0]->debit}}">
                                            @endif
                                        </td>
                                        <td>
                                            @if(sizeof($row->hasMember->hasTransaction)==0)
                                                <input type="text" class="form-control" name="service_charge[]">
                                            @else
                                                <input type="text" class="form-control" name="service_charge[]" value="{{$row->hasMember->hasTransaction[1]->debit}}">
                                            @endif

                                        </td>
                                        <td>
                                            @if(sizeof($row->hasMember->hasTransaction)==0)
                                                <input type="text" class="form-control" name="loan_insurance[]">
                                            @else
                                                <input type="text" class="form-control" name="loan_insurance[]" value="{{$row->hasMember->hasTransaction[2]->debit}}">
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </table>
                    </div>
                    <div class="row">
                        <div class="form-group text-center">
                            <button class="btn btn-raised btn-rounded btn-success">সংরক্ষণ করুন</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection

@section('specifiedJs')
    <script type="text/javascript" src="{{url('public')}}/js/libs/selectize/selectize.min.js"></script>
    <script type="text/javascript" src="{{url('public')}}/js/libs/datepicker/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="{{url('public')}}/js/libs/form-validation/validate.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#loan_date').datepicker();
        });

        function check_price(id) {
            var tmp_num = $('#' + id).val().getDigitEnglishFromBangla();
            if (tmp_num == null || isNaN(tmp_num)) {
                var x = document.getElementById(id);
                x.value = x.value.replace(/[^0-9]/, '');
            }
        }
    </script>
@endsection
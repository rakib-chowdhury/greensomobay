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
                <div class="alert alert-callout alert-success "><b class="text-lg">সঞ্চয় আদায়</b>
                </div>
                <form action="{{url('admin/collect_deposit')}}" method="post">
                    {{csrf_field()}}
                    <div class="row">
                        <div class="col-md-3 form-group">
                            <label for="deposit_date">তারিখ</label>
                            <input required readonly type="text" name="deposit_date" id="deposit_date"
                                   class="form-control" value="{{date('m/d/Y')}}">
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tr>
                                <th>#</th>
                                <th>ছবি</th>
                                <th>নাম</th>
                                <th>ঠিকানা</th>
                                {{--<th>পূর্বের জমা</th>--}}
                                <th>আজকের জমা</th>
                                <th>সঞ্চয় ধরণ</th>
                            </tr>
                            @if(sizeof($member)==0)
                                <tr>
                                    <td colspan="7">কোনো তথ্য নেই</td>
                                </tr>
                            @else
                                @foreach($member as $key=>$row)
                                    <tr>
                                        <td>{{str_replace(range(0,9),$bn_digits,$key+1)}}</td>
                                        <td><img style="width: 60px; height: 60px;"
                                                 src="{{url('public/img/member/'.$row->hasMember->pic)}}" alt="">
                                        </td>
                                        <td>{{$row->hasMember->name}}</td>
                                        <td>{{$row->hasMember->hasMemberDetails->hasCurrDivision->name.', '.$row->hasMember->hasMemberDetails->hasCurrDistrict->bn_name.', '.$row->hasMember->hasMemberDetails->hasCurrUpz->bn_name.', '.$row->hasMember->hasMemberDetails->current_postoffice.', '.$row->hasMember->hasMemberDetails->current_location}}</td>
                                        {{--<td>{{'prev amnt'}}</td>--}}
                                        <td>
                                            <input type="hidden" name="mem_id[]" value="{{$row->member_id}}">
                                            @if(sizeof($row->hasMember->hasTransaction)==0)
                                                <input onkeyup="check_price(this.id)" onblur="check_price(this.id)"
                                                       type="text" class="form-control"
                                                       id="deposit_amount_{{$row->member_id}}" name="deposit_amount[]">
                                            @else
                                                <input onkeyup="check_price(this.id)" onblur="check_price(this.id)"
                                                       type="text" class="form-control"
                                                       value="{{$row->hasMember->hasTransaction[0]->debit}}"
                                                       id="deposit_amount_{{$row->member_id}}" name="deposit_amount[]">
                                            @endif

                                        </td>
                                        <td>
                                            @foreach($deposit_type as $key2=>$dt)
                                                <input
                                                        <?php if (sizeof($row->hasMember->hasTransaction) == 0) {
                                                            if ($key2 == 1) {
                                                                echo 'checked';
                                                            }
                                                        } else {
                                                            if ($row->hasMember->hasTransaction[0]->sub_group_id == $key2 + 1) {
                                                                echo 'checked';
                                                            }
                                                        }?>
                                                        type="radio"
                                                        name="depositType_{{$row->member_id}}"
                                                        value="{{$dt->id}}"> {{$dt->name}}
                                                &nbsp;&nbsp;
                                            @endforeach
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
            $('#deposit_date').datepicker();
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
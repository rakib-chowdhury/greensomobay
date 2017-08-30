@extends('layouts.app')

@section('specifiedCss')
    <link rel="stylesheet" href="{{url('public')}}/css/selectize/selectize.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css"/>
@endsection

@section('content')
    @php
    $bn_digits = array('০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯');
    @endphp
    <section>
        <div class="card">
            <div class="card-body">
                @include('includes.flashMessage')
                <div class="alert alert-callout alert-success "><b class="text-lg">সঞ্চয় রিপোর্ট</b>
                </div>
                <div class="row">
                    <form action="{{url('admin/report/depositReport')}}" method="post">
                        {{csrf_field()}}
                        <div class="col-sm-3 form-group {{ $errors->has('d_date')?'has-error':'' }}"
                             style="padding-left: 0px; padding-right: 0px;">
                            <label for="d_date" class="col-sm-2" style="padding-top: 9px">তারিখ</label>
                            <div class="col-sm-10">
                                <input type="text" name="d_date" value="{{$d_date}}" id="d_date"
                                       placeholder="তারিখ শুরু" class="form-control"/>
                                @include('errors.formValidateError',['inputName' => 'd_date','msg'=>'আবশ্যক'])
                            </div>
                        </div>

                        <div class="col-sm-2 form-group {{ $errors->has('prokolpo')?'has-error':'' }}"
                             style="padding-left: 0px; padding-right: 0px;">
                            <label for="prokolpo" class="col-sm-3"
                                   style="padding-top: 9px;">প্রকল্প</label>
                            <div class="col-sm-9">
                                <select required name="prokolpo" class="form-control-select select-class"
                                        id="prokolpo">
                                    <option @if($prokolpo=='all') {{'selected'}} @endif value="all">সকল</option>
                                    @if(empty($prokolpoList))
                                        <option value="">No prokolpo</option>
                                    @else
                                        @foreach($prokolpoList as $row)
                                            <option @if($prokolpo==$row->id) {{'selected'}} @endif value="{{ $row->id }}">{{ $row->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-2 form-group {{ $errors->has('branch_id')?'has-error':'' }}"
                             style="padding-left: 0px; padding-right: 0px;">
                            <label for="branch_id" class="col-sm-3"
                                   style="padding-top: 9px;">শাখা</label>
                            <div class="col-sm-9">
                                <select required name="branch_id" class="form-control-select select-class"
                                        id="branch_id">
                                    <option @if($branch=='all') {{'selected'}} @endif value="all">সকল</option>
                                    @if(empty($branchList))
                                        <option value="">No branch</option>
                                    @else
                                        @foreach($branchList as $row)
                                            <option @if($branch==$row->id) {{'selected'}} @endif value="{{ $row->id }}">{{ $row->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-3 form-group {{ $errors->has('member_id')?'has-error':'' }}"
                             style="padding-left: 0px; padding-right: 0px;">
                            <label for="member_id" class="col-sm-2"
                                   style="padding-top: 9px;">সদস্য</label>
                            <div id="memBER" class="col-sm-10">
                                <select required name="member_id" class="form-control-select select-class"
                                        id="member_id">
                                    @if(sizeof($memberList)==0)
                                        <option value="">কোনো সদস্য নেই</option>
                                    @else
                                        <option @if($member=='all') {{'selected'}} @endif value="all">সকল</option>
                                        @foreach($memberList as $row)
                                            <option @if($member==$row->id) {{'selected'}} @endif value="{{ $row->id }}">{{ $row->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-1 form-group " style="padding-left: 0px;">
                            <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-search"></i>
                                অনুসন্ধান
                            </button>
                        </div>
                        <div class="col-sm-1 form-group " style="padding-left: 0px;">
                            <a href="{{url('admin/report/depositReportPdf')}}" class="btn btn-success btn-sm" role="button"><i class="fa fa-file-pdf-o"></i>পি ডি এফ</a>
                            </button>
                        </div>
                    </form>

                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <tr>
                            <th>#</th>
                            <th>তারিখ</th>
                            <th>নাম</th>
                            <th>ঠিকানা</th>
                            <th>মোবাইল নং</th>
                            <th>শাখা</th>
                            <th>প্রকল্প</th>
                            {{--<th>মোট সঞ্চয় জমা</th>--}}
                            {{--<th>আংশিক সঞ্চয় উত্তোলনের পরিমান</th>--}}
                            <th>সঞ্চয়</th>
                            <th></th>
                        </tr>
                        @if(sizeof($page_data)==0)
                            {{'কোনো তথ্য নেই'}}
                        @else
                            @foreach($page_data as $key=>$row)
                                <tr>
                                    <td>{{str_replace(range(0,9),$bn_digits,$key+1)}}</td>
                                    <td>{{str_replace(range(0,9),$bn_digits,$row->transaction_date)}}</td>
                                    <td><a target="_blank" href="{{url('admin/member/depositReport/'.$row->member_id.'/details')}}">{{$row->hasMember->name}}</a></td>
                                    <td>{{$row->hasMember->hasMemberDetails->current_location}}
                                        , {{$row->hasMember->hasMemberDetails->current_postoffice}}
                                        , {{$row->hasMember->hasMemberDetails->hasCurrUpz->bn_name}}
                                        , {{$row->hasMember->hasMemberDetails->hasCurrDistrict->bn_name}}
                                        , {{$row->hasMember->hasMemberDetails->hasCurrDivision->name}}</td>
                                    <td>{{str_replace(range(0,9),$bn_digits,$row->hasMember->phone)}}</td>
                                    <td>{{$row->hasMember->hasBranch->name}}</td>
                                    <td>{{$row->hasSubGroup->name}}</td>
                                    {{--<td>{{str_replace(range(0,9),$bn_digits,$row->debit)}}</td>--}}
                                    {{--<td>{{str_replace(range(0,9),$bn_digits,$row->debit)}}</td>--}}
                                    <td style="text-align: right;">{{str_replace(range(0,9),$bn_digits,$row->debit)}}
                                        টাকা
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="7"></td>
                                <td style="text-align: right;">{{str_replace(range(0,9),$bn_digits,$page_data->sum('debit'))}}
                                    টাকা
                                </td>
                            </tr>
                        @endif
                    </table>
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
    <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
    <script type="text/javascript">
        $(function () {
            $('input[name="d_date"]').daterangepicker({
                locale: {
                    format: 'YYYY/MM/DD'
                }
            });

            $(".select-class").selectize();
        });

        $('#branch_id').change(function () {
            $.ajax({
                url: '{{url('admin/getMemeberAjax')}}',
                type: 'get',
                data: {
                    branch: $(this).val()
                }, success: function (res) {
                    $('#memBER').html('');

                    var trow = '<select required name="member_id" class="form-control-select select-class" id="member_id">'
                    if (res.length == 0) {
                        trow += '<option value="">কোনো সদস্য নেই</option>';
                    } else {
                        trow += '<option value="all">সকল</option>';
                        $.each(res, function (i, v) {
                            trow += '<option value="'+v["id"]+'">'+v["name"]+'</option>';
                        });
                        trow += '</select>';
                    }
                    $('#memBER').append(trow);
                    $('#member_id').selectize();
                }
            });
        });
    </script>
@endsection
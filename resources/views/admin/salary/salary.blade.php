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
                <div class="alert alert-callout alert-success "><b class="text-lg">বেতন রিপোর্ট</b>
                    @if(session('role')==1)
                        <a href="{{url('admin/add_salary')}}" class="btn btn-sm btn-success pull-right"><i
                                    class="fa fa-plus"></i> বেতন সংযোজন করুন</a>
                    @endif
                </div>
                <form action="{{url('admin/salary')}}" method="post">
                    {{csrf_field()}}
                    <div class="row">
                        <div class="col-sm-4 form-group {{ $errors->has('prokolpo')?'has-error':'' }}">
                            <label for="branch" class="col-sm-2"
                                   style="padding-top: 9px;">শাখা</label>
                            <div class="col-sm-10">
                                <select required name="branch" class="form-control-select select-class"
                                        id="branch" style="padding-top: 9px">
                                    @if(empty($branch))
                                        <option value="">No Branch</option>
                                    @else
                                        @foreach($branch as $row)
                                            <option @if($crr_brnch==$row->id) {{'selected'}} @endif value="{{ $row->id }}">{{ $row->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4 form-group {{ $errors->has('startDate')?'has-error':'' }}">
                            <label for="startDate" class="col-sm-2" style="padding-top: 9px">মাস</label>
                            <div class="col-sm-10">
                                <input readonly type="text" class=" form-control dateInput" name="startDate"
                                       id="startDate" placeholder="মাস" value="{{$crr_mnth}}">
                                @include('errors.formValidateError',['inputName' => 'startDate'])
                            </div>
                        </div>
                        <div class="col-sm-2 form-group" style="text-align: center">
                            <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-database"></i>
                                অনুসন্ধান
                            </button>
                        </div>
                        <div class="col-sm-2 form-group " style="text-align: center">
                            <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-file-pdf-o"></i>
                                পি.ডি.এফ
                            </button>
                        </div>
                    </div>
                </form>

                <div class="table-responsive">
                    <table class="table table-striped">
                        <tr>
                            <th>#</th>
                            <th>ছবি</th>
                            <th>নাম</th>
                            <th>পদবী</th>
                            <th>মোবাইল নং</th>
                            <th>মূল বেতন</th>
                            <th>উপস্থিতি</th>
                            <th>মোট</th>
                            <th>অ্যাকশন</th>
                        </tr>
                        @if(sizeof($page_info)==0)
                            <tr>
                                <td colspan="8">কোনো তথ্য নেই</td>
                            </tr>
                        @else
                            @foreach($page_info as $k=>$row)
                                @if(sizeof($row->hasEmployee)!=0)
                                    <tr>
                                        <td>{{str_replace(range(0,9),$bn_digits,$k+1)}}</td>
                                        <td><img style="height: 50px; width: 50px;"
                                                 src="{{url('public/img/employee/'.$row->hasEmployee['pic'])}}" alt="">
                                        </td>
                                        <td>{{$row->hasEmployee['name']}}</td>
                                        <td>{{$row->hasEmployee['name']}}</td>
                                        <td>{{str_replace(range(0,9),$bn_digits,$row->hasEmployee['mobile'])}}</td>
                                        <td>{{str_replace(range(0,9),$bn_digits,$row->hasEmployee['basic_salary'])}}</td>
                                        <td>{{str_replace(range(0,9),$bn_digits,$row->attendence)}}</td>
                                        <td>{{str_replace(range(0,9),$bn_digits,$row->attendence)}}</td>
                                        <td>
                                            <a class="btn btn-xs btn-success"><i class="fa fa-eye"></i> দেখুন</a>
                                            <a class="btn btn-xs btn-info"><i class="fa fa-edit"></i> সংশোধন</a>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
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
    <script type="text/javascript" src="{{url('public')}}/js/libs/datepicker/bootstrap-datepicker.js"></script>
    <script>
        $(function () {
            $(".dateInput").datepicker({
                format: "yyyy-mm"
            });
            $('.select-class').selectize();
        });
    </script>
@endsection
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
                <div class="alert alert-callout alert-success "><b class="text-lg">অগ্রিম বেতন</b>
                    <a href="{{ url('/admin/new_advance') }}" class="btn btn-sm btn-success pull-right"><i
                                class="fa fa-plus"></i> অগ্রিম বেতন সংযোজন করুন</a>
                </div>
                {{--<div class="row">--}}
                    {{--<div class="col-sm-3 form-group {{ $errors->has('prokolpo')?'has-error':'' }}">--}}
                        {{--<label for="branch" class="col-sm-2"--}}
                               {{--style="padding-top: 9px;">শাখা</label>--}}
                        {{--<div class="col-sm-10">--}}
                            {{--<select required name="branch" class="form-control-select select-class"--}}
                                    {{--id="branch" style="padding-top: 9px">--}}
                                {{--@if(empty($branch))--}}
                                    {{--<option value="">No Branch</option>--}}
                                {{--@else--}}
                                    {{--@foreach($branch as $row)--}}
                                        {{--<option @if(old('branch')==$row->id) {{'selected'}} @endif value="{{ $row->id }}">{{ $row->name }}</option>--}}
                                    {{--@endforeach--}}
                                {{--@endif--}}
                            {{--</select>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="col-sm-4 form-group {{ $errors->has('startDate')?'has-error':'' }}">--}}
                        {{--<label for="startDate" class="col-sm-2" style="padding-top: 9px">তারিখ</label>--}}
                        {{--<div class="col-sm-10">--}}
                            {{--<input readonly type="text" class=" form-control dateInput" name="startDate"--}}
                                   {{--id="startDate" placeholder="তারিখ">--}}
                            {{--@include('errors.formValidateError',['inputName' => 'startDate'])--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="col-sm-2 form-group ">--}}
                        {{--<button type="submit" class="btn btn-success btn-sm"><i class="fa fa-database"></i>--}}
                            {{--অনুসন্ধান--}}
                        {{--</button>--}}
                    {{--</div>--}}
                    {{--<div class="col-sm-2 form-group ">--}}
                        {{--<button type="submit" class="btn btn-success btn-sm"><i class="fa fa-file-pdf-o"></i>--}}
                            {{--পি.ডি.এফ--}}
                        {{--</button>--}}
                    {{--</div>--}}

                {{--</div>--}}
                <div class="table-responsive">
                    <table class="table table-striped">
                        <tr>
                            <th>#</th>
                            <th>অগ্রীম গ্রহণের তারিখ</th>
                            <th>ছবি</th>
                            <th>নাম</th>
                            <th>মোবাইল নং</th>
                            <th>শাখা</th>
                            <th>মূল বেতন</th>
                            <th>অগ্রীম বেতন</th>
                            <th>বিবরণ</th>
                            <th>অ্যাকশন</th>
                        </tr>
                        @foreach ($employees as $k=>$employee)
                            <tr>
                                <td>{{str_replace(range(0,9),$bn_digits,($k+1))}}</td>
                                <td>{{str_replace(range(0,9),$bn_digits,$employee->advance_received)}}</td>
                                <td><img style="height: 50px; width: 50px;"
                                         src="{{url('public/img/employee/'.$employee->hasEmployee->pic)}}" alt="no img"></td>
                                <td>{{$employee->hasEmployee->name}}</td>
                                <td>{{str_replace(range(0,9),$bn_digits,$employee->hasEmployee->mobile)}}</td>
                                <td>{{$employee->hasEmployee->hasBranch->name}}</td>
                                <td>{{str_replace(range(0,9),$bn_digits,$employee->hasEmployee->basic_salary)}}</td>
                                <td>{{str_replace(range(0,9),$bn_digits,$employee->amount)}}</td>
                                <td>{{str_replace(range(0,9),$bn_digits,$employee->description)}}</td>
                                <td >
                                    <a href="{{url('admin/advance/'.$employee->id.'/edit')}}" class="btn btn-xs btn-info"><i class="fa fa-edit"></i> সংশোধন</a>
                                </td>
                            </tr>
                        @endforeach
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
            $(".dateInput").datepicker();
            $('#branch').selectize({
                create: true,
                sortField: {field: 'text'}
            });
        });
    </script>
    <script>
        $('#birthDate').datepicker({
            format: "dd/mm/yyyy"
        }).on('changeDate', function () {
            console.log('sds');
            check_age('birthDate');
        });
    </script>
@endsection
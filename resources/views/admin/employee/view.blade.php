@extends('layouts.app')

@section('specifiedCss')
@endsection

@section('content')
    @php
    $bn_digits = array('০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯');
    @endphp
    <section>
        <div class="card">
            <div class="card-body">
                @include('includes.flashMessage')
                <div class="alert alert-callout alert-success "><b class="text-lg">কর্মচারীবৃন্দ</b>
                    <a href="{{ url('/admin/employee/create') }}" class="btn btn-sm btn-success pull-right"><i
                                class="fa fa-plus"></i> কর্মচারী সংযোজন করুন</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <tr>
                            <th>#</th>
                            <th>ছবি</th>
                            <th>আইডি নং</th>
                            <th>নাম</th>
                            {{--<th>জাতীয় পরিচয় পত্র নং</th>--}}
                            <th>মোবাইল নং</th>
                            <th>শাখা</th>
                            <th>পদবী</th>
                            <th style="width: 10%">সফটওয়্যার অ্যাডমিন</th>
                            <th >অ্যাকশন</th>
                        </tr>
                        @foreach ($employees as $k=>$employee)
                            <tr>
                                <td>{{str_replace(range(0,9),$bn_digits,($k+1))}}</td>
                                <td><img style="height: 50px; width: 50px;"
                                         src="{{url('public/img/employee/'.$employee->pic)}}" alt="no img"></td>
                                <td>{{str_replace(range(0,9),$bn_digits,$employee->id_card_no)}}</td>
                                <td>{{$employee->name}}</td>
                                {{--<td>{{str_replace(range(0,9),$bn_digits,$employee->nid)}}</td>--}}
                                <td>{{str_replace(range(0,9),$bn_digits,$employee->mobile)}}</td>
                                <td>{{$employee->hasBranch->name}}</td>
                                <td>{{$employee->hasDesignation->name}}</td>
                                <td style="width: 10%">{{$employee->hasRole->name}}</td>
                                <td style="width: 21%">
                                    <a href="{{ url('admin/employee/'.$employee->id.'/details') }}" class="btn btn-xs btn-success"><i class="fa fa-eye"></i> দেখুন</a>
                                    <a href="{{ url('admin/employee/'.$employee->id.'/edit') }}" class="btn btn-xs btn-info"><i class="fa fa-edit"></i> সংশোধন</a>
                                    <a href="{{ url('/admin/employee/'.$employee->id.'/delete') }}"
                                       class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> বাতিল</a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('specifiedJs')
    <script type="text/javascript" src="{{url('public')}}/js/libs/form-validation/validate.min.js"></script>
@endsection
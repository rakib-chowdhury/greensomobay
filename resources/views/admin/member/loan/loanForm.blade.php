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
                <div class="alert alert-callout alert-success "><b class="text-lg">{{$page_title}}</b>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <tr>
                            <th>#</th>
                            <th>তারিখ</th>
                            <th>ছবি</th>
                            {{--<th>রেজিস্ট্রেশন নং</th>                            --}}
                            <th>নাম</th>
                            <th>মোবাইল নং</th>
                            <th>শাখা</th>
                            <th>বর্তমান ব্যালান্স</th>
                            <th>আকাঙ্ক্ষিত ব্যালান্স</th>
                            <th>অ্যাকশন</th>
                        </tr>
                        @if(sizeof($page_info)==0)
                            <tr>
                                <td colspan="10">কোনো তথ্য নেই</td>
                            </tr>
                        @else
                            @foreach($page_info as $k=>$row)
                                <tr>
                                    <td>{{str_replace(range(0,9),$bn_digits,$k+1)}}</td>
                                    <td>@php $dd=explode(' ',$row->created_at)[0]; @endphp {{str_replace(range(0,9),$bn_digits,$dd)}}</td>
                                    <td><img src="{{url('public/img/member/'.$row->hasMember->pic)}}"
                                             style="height: 50px; width: 50px;" alt=""></td>
                                    {{--<td>{{str_replace(range(0,9),$bn_digits,$row->hasMember->registration_no)}}</td>--}}
                                    <td>{{$row->hasMember->name}}</td>
                                    <td>{{str_replace(range(0,9),$bn_digits,$row->hasMember->phone)}}</td>
                                    <td>{{$row->hasMember->hasBranch->name}}</td>
                                    <td>{{str_replace(range(0,9),$bn_digits,$row->curr_deposit_amount)}}</td>
                                    <td>{{str_replace(range(0,9),$bn_digits,$row->requested_amount)}}</td>
                                    <td style="width: 21%">
                                        {{--<a href="{{ url('admin/loanFrom/'.$row->id.'/details') }}"--}}
                                           {{--class="btn btn-xs btn-info"><i class="fa fa-eye"></i> দেখুন</a>--}}
                                        @if((session('role')==4 && $row->status==0) || (session('role')==1 && $row->status==3) || (session('role')==2 && $row->status==1) || (session('role')==3 && $row->status==1))
                                            <a href="{{ url('admin/loanFrom/'.$row->id.'/approve/'.$type) }}"
                                               class="btn btn-xs btn-success"><i class="fa fa-plus"></i> অনুমোদন</a>
                                            <a href="{{ url('/admin/loanFrom/'.$row->id.'/reject/'.$type) }}"
                                               class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> বাতিল</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('specifiedJs')
    <script type="text/javascript" src="{{url('public')}}/js/libs/form-validation/validate.min.js"></script>
@endsection
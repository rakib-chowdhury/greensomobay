@extends('layouts.app')

@section('specifiedCss')
    <link rel="stylesheet" href="{{url('public')}}/css/selectize/selectize.css" type="text/css">
    <link rel="stylesheet" href="{{url('public')}}/css/datatable/dataTables.bootstrap.min.css">
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
                    <table id="dynamicTable" class="table table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>ছবি</th>
                            <th>রেজিস্ট্রেশন নন্বর</th>
                            <th>নাম</th>
                            <th>জাতীয় পরিচয়পত্র নং</th>
                            <th>মোবাইল নং</th>
                            <th>শাখা</th>
                            <th>অ্যাকশন</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($members as $k=>$row)
                            <tr>
                                <td>{{str_replace(range(0,9),$bn_digits,($k+1))}}</td>
                                <td><img style="height: 50px; width: 50px;"
                                         src="{{url('public/img/member/'.$row->pic)}}" alt="no img"></td>
                                <td>{{str_replace(range(0,9),$bn_digits,$row->registration_no)}}</td>
                                <td>{{$row->name}}</td>
                                <td>{{str_replace(range(0,9),$bn_digits,$row->nid)}}</td>
                                <td>{{str_replace(range(0,9),$bn_digits,$row->phone)}}</td>
                                <td>{{$row->hasBranch->name}}</td>
                                <td>
                                    <a style="margin-top: 0px;"
                                       href="{{ url('admin/member/'.$type.'/'.$row->id.'/details') }}"
                                       class="btn btn-xs btn-info"><i class="fa fa-eye"></i> দেখুন</a>
                                    {{--<a href="{{ url('') }}" class="btn btn-xs btn-info"><i class="fa fa-edit"></i> সংশোধন</a>--}}
                                    @if($type=='new' || $type=='block')
                                        <a style="margin-top: 0px;"
                                           href="{{ url('/admin/member/'.$type.'/'.$row->id.'/approved') }}"
                                           class="btn btn-xs btn-success"><i class="fa fa-check"></i> অনুমোদন</a>
                                    @endif
                                    @if($type=='new')
                                        <a style="margin-top: 0px;"
                                           href="{{ url('/admin/member/'.$type.'/'.$row->id.'/reject') }}"
                                           class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> বাতিল</a>
                                    @elseif($type=='approved')
                                        <a style="margin-top: 0px;"
                                           href="{{ url('/admin/member/'.$type.'/'.$row->id.'/block') }}"
                                           class="btn btn-xs btn-accent-dark"><i class="fa fa-ban"></i> ব্লক করুন</a>
                                    @endif

                                    @if($type=='New')
                                        @if($row->status==7)
                                            <a href="{{ url('/admin/member_admission/'.$row->id) }}" style="margin-top: 0px;"
                                               class="btn btn-xs btn-success"><i
                                                        class="fa fa-plus"></i> সদস্য ভর্তি করুন</a>
                                        @elseif($row->status==6)
                                            <a data-toggle="modal" data-target="#empModal{{$row->id}}"
                                               style="margin-top: 0px; cursor: pointer"
                                               class="btn btn-xs btn-primary"><i
                                                        class="fa fa-user"></i> কর্মচারী নিযুক্ত করুন</a>
                                        @endif

                                    @endif
                                </td>
                            </tr>
                            <!-----------------------------------------------
                             * assign member to field worker modal
                             *----------------------------------------------->
                            @if($row->status==6)
                                <div class="modal fade" id="empModal{{$row->id}}" tabindex="-1"
                                     role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header padding">
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close"><span
                                                            aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myModalLabel"><i
                                                            class="fa fa-indent"></i> কর্মচারী নিযুক্ত করণ</h4>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ url('/admin/member/assign/employee') }}" method="post">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="member_id" value="{{$row->id}}">
                                                    <div class="form-group {{ $errors->has('name')?'has-error':'' }}">
                                                        <label for="name">কর্মচারী নাম</label>
                                                        <select readonly name="emp_id"
                                                                class="form-control-select emp">
                                                            @if(empty($employees))
                                                                <option value="">কর্মচারী নেই</option>
                                                            @else
                                                                @foreach($employees as $emp)
                                                                    <option value="{{ $emp->id }}">{{ $emp->name.'('.str_replace(range(0,9),$bn_digits,$emp->mobile).')' }}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-success btn-sm"><i
                                                                    class="fa fa-database"></i> নিযুক্ত করুন
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- /end modal for store branch -->
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('specifiedJs')
    <script type="text/javascript" src="{{url('public')}}/js/libs/selectize/selectize.min.js"></script>
    <script type="text/javascript" src="{{url('public')}}/js/libs/datatable/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="{{url('public')}}/js/libs/datatable/dataTables.bootstrap.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#dynamicTable').DataTable({
                "ordering": false
            });

            $('.emp').selectize();
        });
    </script>
@endsection
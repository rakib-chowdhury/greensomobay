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
                <div class="alert alert-callout alert-success "><b class="text-lg">রিপোর্ট</b>
                </div>
                <div class="row">
                    <form action="{{url('admin/report/list/0')}}" method="post">
                        {{csrf_field()}}
                        <div class="col-md-12 form-group">
                            <div class="col-md-3 form-group {{ $errors->has('d_date')?'has-error':'' }}" style="padding-left: 0px; padding-right: 0px;">
                                <label for="startDate" class="col-sm-2" style="padding-top: 9px">তারিখ</label>
                                <div class="col-sm-10">
                                    <input type="text" name="d_date" value="{{$d_date}}" id="d_date"
                                           class="form-control" readonly required />
                                    @include('errors.formValidateError',['inputName' => 'd_date','msg'=>'আবশ্যক'])
                                </div>
                            </div>
                            <div class="col-md-3 form-group {{ $errors->has('branch_id')?'has-error':'' }}" style="padding-right: 0px">
                                <label for="branch" class="col-sm-2" style="padding-top: 10px">শাখা</label>
                                <div class="col-sm-10">
                                    <select required class="form-control-select select-class" name="branch_id" id="branch_id">
                                        @if(empty($branchList))
                                            <option value="">No branch</option>
                                        @else
                                            @foreach($branchList as $branch)
                                                <option @if(old('branch')==$branch->id){{'selected'}}@endif value="{{ $branch->id }}">{{ $branch->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @include('errors.formValidateError',['inputName' => 'branch_id','msg'=>'আবশ্যক'])
                                </div>
                            </div>
                            <div class="col-md-3 form-group {{ $errors->has('emp_id')?'has-error':'' }}"  style="padding-left: 0px; padding-right: 0px;">
                                <label for="branch" class="col-sm-3" style="padding-top: 10px">কর্মচারী</label>
                                <div class="col-sm-9">
                                    <select required class="form-control-select select-class" name="emp_id" id="emp_id">
                                        @if(empty($employeeList))
                                            <option value="">No employee</option>
                                        @else
                                            @foreach($employeeList as $emp)
                                                <option @if(old('emp')==$emp->id){{'selected'}}@endif value="{{ $emp->id }}">{{ $emp->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @include('errors.formValidateError',['inputName' => 'branch','msg'=>'আবশ্যক'])
                                </div>
                            </div>
                            <div class="col-sm-1 form-group ">
                                <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-search"></i>
                                    অনুসন্ধান
                                </button>
                            </div>
                            <div class="col-sm-2 form-group text-center">
                                <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-file-pdf-o"></i>
                                    পি.ডি.এফ
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <tr>
                            <th>সঞ্চয় আদায়</th>
                            <th>ঋণ আদায়</th>
                            <th>সার্ভিস চার্জ আদায় </th>
                            <th>ঋণ বীমা আদায়</th>
                            <th>মোট</th>
                        </tr>
                        <tr>
                            <td>
                                <a href="{{url('admin/report/depositReceived/'.session('emp_id'))}}">{{str_replace(range(0,9),$bn_digits,$deposit)}}</a>
                            </td>
                            <td>
                                <a href="{{url('admin/report/loanReceived/'.session('emp_id'))}}">{{str_replace(range(0,9),$bn_digits,$loan)}}</a>
                            </td>
                            <td>
                                <a href="{{url('admin/report/serviceChargeReceived/'.session('emp_id'))}}">{{str_replace(range(0,9),$bn_digits,$service_charge)}}</a>
                            </td>
                            <td>
                                <a href="{{url('admin/report/insuranceReceived/'.session('emp_id'))}}">{{str_replace(range(0,9),$bn_digits,$insurance)}}</a>
                            </td>
                            <td>
                                {{str_replace(range(0,9),$bn_digits,$total)}}
                            </td>
                        </tr>
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
    </script>
@endsection
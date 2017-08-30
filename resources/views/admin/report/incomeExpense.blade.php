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
                <div class="alert alert-callout alert-success "><b class="text-lg">জমা/খরচ</b>
                </div>
                <div class="row">
                    <form action="{{url('admin/report/incomeExpense')}}" method="post">
                        {{csrf_field()}}
                        <div class="col-md-12 form-group">
                            <div class="col-md-5 form-group {{ $errors->has('d_date')?'has-error':'' }}">
                                <label for="startDate" class="col-sm-2" style="padding-top: 9px">তারিখ</label>
                                <div class="col-sm-10">
                                    <input type="text" name="d_date" value="{{$d_date}}" id="d_date"
                                           class="form-control" placeholder="তারিখ শুরু"/>
                                    @include('errors.formValidateError',['inputName' => 'startDate','msg'=>'আবশ্যক'])
                                </div>
                            </div>
                            <div class="col-md-4 form-group {{ $errors->has('branch_id')?'has-error':'' }}">
                                <label for="branch" class="col-sm-2" style="padding-top: 10px">শাখা</label>
                                <div class="col-sm-10">
                                    <select required class="form-control-select select-class" name="branch_id" id="branch_id">
                                        @if(empty($branchList))
                                            <option value="">No branch</option>
                                        @else
                                            @foreach($branchList as $branch)
                                                <option @if($branch_id==$branch->id){{'selected'}}@endif value="{{ $branch->id }}">{{ $branch->name }}</option>
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
                            <th colspan="6" style="text-align: center">জমা</th>
                            <th colspan="6" style="text-align: center">খরচ</th>
                        </tr>
                        <tr>
                            <th colspan="1">#</th>
                            <th colspan="3">বিস্তারিত</th>
                            <th colspan="2">পরিমান</th>
                            <th colspan="1">#</th>
                            <th colspan="3">বিস্তারিত</th>
                            <th colspan="2">পরিমান</th>
                        </tr>
                        <tr>
                            <td colspan="1">1</td>
                            <td colspan="3">jfghjdf</td>
                            <td colspan="2">20</td>
                            <td colspan="1">1</td>
                            <td colspan="3">jfghjdf</td>
                            <td colspan="2">20</td>

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
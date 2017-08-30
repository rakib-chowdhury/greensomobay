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
                <div class="alert alert-callout alert-success "><b class="text-lg">ঋণ রিপোর্ট</b>
                </div>
                <div class="row">
                    <div class="col-sm-4 form-group {{ $errors->has('startDate')?'has-error':'' }}">
                        <label for="startDate" class="col-sm-2" style="padding-top: 9px">তারিখ</label>
                        <div class="col-sm-10">
                            <input type="text" name="startDate" value="01/01/2015 - 01/31/2015" id="startDate"
                                   placeholder="তারিখ শুরু"/>
                            @include('errors.formValidateError',['inputName' => 'startDate','msg'=>'আবশ্যক'])
                        </div>
                    </div>
                    <div class="col-sm-3 form-group {{ $errors->has('prokolpo')?'has-error':'' }}">
                        <label for="prokolpo" class="col-sm-2"
                               style="padding-top: 9px;">প্রকল্প</label>
                        <div class="col-sm-10">
                            <select required name="prokolpo" class="form-control-select select-class"
                                    id="prokolpo">
                                @if(empty($prokolpo))
                                    <option value="">No prokolpo</option>
                                @else
                                    @foreach($prokolpo as $row)
                                        <option @if(old('prokolpo')==$row->id) {{'selected'}} @endif value="{{ $row->id }}">{{ $row->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-3 form-group {{ $errors->has('startDate')?'has-error':'' }}">
                        <label style="padding-top: 9px" class="col-sm-2">ধরণ</label>
                        <div class="col-sm-10">
                            <input class="radio-inline" checked type="radio" name="optradio" value="all">সর্বপ্রকার
                            <input class="radio-inline" type="radio" name="optradio" value="">ঋণ খেলাপী
                        </div>
                    </div>
                    <div class="col-sm-2 form-group ">
                        <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-database"></i>
                            অনুসন্ধান
                        </button>
                    </div>

                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <tr>
                            <th>#</th>
                            <th>নাম</th>
                            <th>ঠিকানা</th>
                            <th>মোবাইল নং</th>
                            <th>প্রকল্প</th>
                            <th>মোট ঋণ গ্রহণ</th>
                            <th>ঋণ পরিশোধের পরিমান</th>
                            <th>বকেয়া</th>
                            <th >মোট সার্ভিস চার্জ</th>
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
            $('input[name="startDate"]').daterangepicker();

            $(".select-class").selectize();
        });
    </script>
@endsection
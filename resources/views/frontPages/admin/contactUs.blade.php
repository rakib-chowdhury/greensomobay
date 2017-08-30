@extends('layouts.app')

@section('specifiedCss')
@endsection

@section('content')
    <section>
        <div class="card">
            <div class="card-body">
                @include('includes.flashMessage')
                @if(empty($page_info) || $page_info == null)
                    <div class="card alert alert-callout alert-success">
                        যোগাযোগ তথ্য :
                    </div>
                    <form action="{{ url('admin/front/contact_us/post') }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('name')? 'has-error':'' }}">
                                    <label for="">ঠিকানা</label>
                                    <input type="text" name="name" required class="form-control">
                                    @include('errors.formValidateError',['inputName' => 'name','msg'=>'আবশ্যক'])
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('email')? 'has-error':'' }}">
                                    <label for="">ইমেইল</label>
                                    <input type="email" name="email" required class="form-control">
                                    @include('errors.formValidateError',['inputName' => 'email','msg'=>'আবশ্যক'])
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('phone')? 'has-error':'' }}">
                                    <label for="">ফোন</label>
                                    <input type="text" name="phone" required class="form-control">
                                    @include('errors.formValidateError',['inputName' => 'phone','msg'=>'আবশ্যক'])
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('mobile')? 'has-error':'' }}">
                                    <label for="">মোবাইল</label>
                                    <input type="text" name="mobile" required class="form-control">
                                    @include('errors.formValidateError',['inputName' => 'mobile','msg'=>'আবশ্যক'])
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group" style="text-align: center">
                                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> সংযোজন করুন
                                </button>
                            </div>
                        </div>
                    </form>
                @else
                    <div class="card alert alert-callout alert-success">
                        যোগাযোগ তথ্য :
                    </div>
                    <form action="{{ url('admin/front/update/contact_us') }}" method="POST"
                          enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="update_id" value="{{$page_info->id}}">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('address')? 'has-error':'' }}">
                                    <label for="">ঠিকানা</label>
                                    <input value="{{$page_info->address}}" type="text" name="address" required class="form-control">
                                    @include('errors.formValidateError',['inputName' => 'address','msg'=>'আবশ্যক'])
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('email')? 'has-error':'' }}">
                                    <label for="">ইমেইল</label>
                                    <input value="{{$page_info->email}}" type="email" name="email" required class="form-control">
                                    @include('errors.formValidateError',['inputName' => 'email','msg'=>'আবশ্যক'])
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('phone')? 'has-error':'' }}">
                                    <label for="">ফোন</label>
                                    <input value="{{$page_info->tnt}}" type="text" name="phone" required class="form-control">
                                    @include('errors.formValidateError',['inputName' => 'phone','msg'=>'আবশ্যক'])
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('mobile')? 'has-error':'' }}">
                                    <label for="">মোবাইল</label>
                                    <input value="{{$page_info->mobile}}" maxlength="11" min="11" type="text" name="mobile" required class="form-control">
                                    @include('errors.formValidateError',['inputName' => 'mobile','msg'=>'আবশ্যক'])
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group" style="text-align: center">
                                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> সংশোধন করুন
                                </button>
                            </div>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </section>
@endsection

@section('specifiedJs')

@endsection
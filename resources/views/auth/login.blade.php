@extends('layouts.public')

@section('content')
    <!-- Info Content - Boxes Services-->
    <div class="content_info">
        <div class="padding-top padding-bottom-mini">
            <!-- Container Area - Boxes Services -->
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="panel panel-default">
                            <div class="panel-heading"><i class="fa fa-sign-in"></i> লগইন</div>
                            <div class="panel-body">
                                <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
                                    {{ csrf_field() }}
                                    <div class="text-center">
                                        <p style="color: peru">( অনুগ্রহপূর্বক মোবাইল নম্বর ও পাসওয়ার্ড ইংরেজিতে প্রদান করুন )</p>
                                    </div>

                                    <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                        <label for="phone" class="col-md-4 control-label">মোবাইল নম্বর</label>

                                        <div class="col-md-6">
                                            <input id="phone" type="text" class="form-control" name="phone" value="{{ old('phone') }}" required autofocus>

                                            @if ($errors->has('phone'))
                                                <span class="help-block">
                                        <strong>{{ 'মোবাইল নম্বর অথবা পাসওয়ার্ড সঠিক নয়' }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                        <label for="password" class="col-md-4 control-label">পাসওয়ার্ড</label>

                                        <div class="col-md-6">
                                            <input id="password" type="password" class="form-control" name="password" required>

                                            @if ($errors->has('password'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-8 col-md-offset-4">
                                            <button type="submit" class="btn btn-primary">
                                                লগইন
                                            </button>

                                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                                পাসওয়ার্ড পুনরুদ্ধার
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Container Area - Boxes Services -->
        </div>
    </div>
@endsection

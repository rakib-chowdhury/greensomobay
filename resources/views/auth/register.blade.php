@extends('layouts.public')

@section('content')
    <!-- Info Content - Boxes Services-->
    <div class="content_info">
        <div class="padding-top padding-bottom-mini">
            <!-- Container Area - Boxes Services -->
            <div class="container">
                <div class="row">
                    <div class="col-md-5">
                        <img src="images/gallery/3.jpg" alt="" class="img-responsive">
                    </div>

                    <div class="col-md-7">
                        <div class="panel panel-default">
                            <div class="panel-heading"><i class="fa fa-sign-in"></i> SignUP</div>
                            <div class="panel-body">
                                <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
                                    {{ csrf_field() }}

                                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                        <label for="name" class="col-md-4 control-label">Name</label>

                                        <div class="col-md-6">
                                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                            @if ($errors->has('name'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                        <label for="phone" class="col-md-4 control-label">E-Mail Address</label>

                                        <div class="col-md-6">
                                            <input id="phone" type="number" class="form-control" name="phone" value="{{ old('phone') }}" required>

                                            @if ($errors->has('phone'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                        <label for="password" class="col-md-4 control-label">Password</label>

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
                                        <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                                        <div class="col-md-6">
                                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-6 col-md-offset-4">
                                            <button type="submit" class="btn btn-primary">
                                                Register
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Col boxes-services -->
                    <div class="col-md-12 padding-top">
                        <!-- boxes-services -->
                        <div class="row boxes-services">
                            <!-- item-boxe-services -->
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                                <div class="item-boxed-service">
                                    <h4>Loan <br>Request</h4>
                                    <span>Helping to fulfill your dreams.</span>
                                    <a href="#"><i class="fa fa-plus-circle"></i> View more</a>
                                </div>
                            </div>
                            <!-- End item-boxe-services -->

                            <!-- item-boxe-services -->
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                                <div class="item-boxed-service">
                                    <h4>I want to save or <br>invest</h4>
                                    <span>Advise your decisions</span>
                                    <a href="#"><i class="fa fa-plus-circle"></i> View more</a>
                                </div>
                            </div>
                            <!-- End item-boxe-services -->

                            <!-- item-boxe-services -->
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                                <div class="item-boxed-service">
                                    <h4>Request items <br>online</h4>
                                    <span>We offer you tools</span>
                                    <a href="#"><i class="fa fa-plus-circle"></i> View more</a>
                                </div>
                            </div>
                            <!-- End item-boxe-services -->
                        </div>
                        <!-- End boxes-services -->
                    </div>
                    <!-- End Col boxes-services -->
                </div>
            </div>
            <!-- End Container Area - Boxes Services -->
        </div>
    </div>
@endsection

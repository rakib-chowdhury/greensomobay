@extends('layouts.public')

@section('content')

        <!-- Info Content - Boxes Services-->
<div class="content_info">
    <div class="padding-bottom-mini">
        <!-- Container Area - Boxes Services -->
        <div class="container">
            <div class="row">
                <div class="form-group ">
                    <h2 class="text-center">যোগাযোগ করুন</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5 col-xs-12 table-responsive">
                    <table class="table table-bordered">
                        <tr class="info-table-row">
                            <td class="info-table-icon"><i class="fa fa-long-arrow-right"></i></td>
                            <td class="info-table-content">
                                @if(!empty($page_info))
                                    {{$page_info->name}}
                                @endif
                            </td>
                        </tr>
                        <tr class="info-table-row">
                            <td class="info-table-icon"><i class="fa fa-map-marker"></i></td>
                            <td class="info-table-content">
                                @if(!empty($page_info))
                                    {{$page_info->address}}
                                @endif
                            </td>
                        </tr>
                        <tr class="info-table-row">
                            <td class="info-table-icon"><i class="fa fa-phone"></i></td>
                            <td class="info-table-content">
                                @if(!empty($page_info))
                                    {{$page_info->tnt}}
                                @endif
                            </td>
                        </tr>
                        <tr class="info-table-row">
                            <td class="info-table-icon"><i class="fa fa-mobile-phone"></i></td>
                            <td class="info-table-content">
                                @if(!empty($page_info))
                                    {{$page_info->mobile}}
                                @endif
                            </td>
                        </tr>
                        <tr class="info-table-row">
                            <td class="info-table-icon"><i class="fa fa-envelope"></i></td>
                            <td class="info-table-content">
                                @if(!empty($page_info))
                                    {{$page_info->email}}
                                @endif
                            </td>
                        </tr>
                        <tr class="info-table-row">
                            <td class="info-table-icon"><i class="fa fa-globe"></i></td>
                            <td class="info-table-content">
                                @if(!empty($page_info))
                                    <a style=" text-decoration: none;" target="_blank" href="http://www.{{$page_info->website}}">{{$page_info->website}}</a>
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="col-md-7">

                    {{--<iframe width="100%" height="200px" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d826.9267651420964!2d90.35653596188746!3d23.76597533802975!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c0a1cc97641f%3A0x4f65892b3aa2e2ef!2sRd+No.+1%2C+Dhaka!5e0!3m2!1sen!2sbd!4v1488082926730"></iframe>--}}
                    <iframe width="100%" height="200px" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d28606.921940331038!2d88.53881820883981!3d26.33086273640467!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39e48be2f9a09cd7%3A0xd52634303d09e6f!2sPanchagarh%2C+Bangladesh!5e0!3m2!1sen!2s!4v1490873135206" ></iframe>
                    <!-- Contact form -->
                    <div class="row"> @include('includes.flashMessage')</div>
                    <div class="row" style="margin-top: 40px;">

                        <form class="" method="post" action="{{url('contact/send_mail')}}">

                            {{csrf_field()}}
                            <div class="form-group col-md-6 col-xs-12">
                                <input id="name" name="name" class="form-control" type="text" placeholder="Name" required>
                            </div>
                            <div class="form-group col-md-6 col-xs-12">
                                <input class="form-control" id="email" name="email" type="email" placeholder="Email" required>
                            </div>
                            <div class="form-group col-md-12 col-xs-12">
                                <input class="form-control" id="subject" name="subject" type="text" placeholder="Subject" required>
                            </div>
                            <div class="form-group col-md-12 col-xs-12">
                                <textarea class="form-control" id="message" name="message" rows="5" placeholder="Message" required></textarea>
                            </div>
                            <div class="form-group col-xs-12 col-md-12" style="text-align: center">
                                <input type="submit" class="btn btn-success btn-rounded btn-raised btn-md" value="Submit">
                            </div>
                            <div class="text-center spinner col-md-12 hidden"><i class="fa fa-spinner fa-pulse"></i></div>
                            <div class="info col-md-12"></div>
                        </form>
                    </div>
                    <!-- /Contact form -->
                </div>
            </div>
        </div>
        <!-- End Container Area - Boxes Services -->
    </div>
</div>
<!-- End Info Content - Boxes Services-->
@endsection
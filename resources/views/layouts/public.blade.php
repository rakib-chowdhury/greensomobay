<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Basic -->
    <meta charset="utf-8">
    <title>{{  config('app.name') }} | co-operative society </title>
    <meta name="keywords" content="co operative socity"/>
    <meta name="description" content="Green co-operative society">
    <meta name="author" content="green">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Theme CSS -->
    <link href="{{url('public')}}/css/style.css" rel="stylesheet" media="screen">
    <!-- Responsive CSS -->
    <link href="{{url('public')}}/css/theme-responsive.css" rel="stylesheet" media="screen">

    <!-- Favicons -->
    <link rel="shortcut icon" href="{{url('public')}}/images/icons/favicon.ico">
    <link rel="apple-touch-icon" href="{{url('public')}}/images/icons/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="{{url('public')}}/images/icons/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="{{url('public')}}/images/icons/apple-touch-icon-114x114.png">
    <!-- font awesome -->
    <script src="https://use.fontawesome.com/c77a9921a0.js"></script>
    @yield('customCss')
            <!-- Head Libs -->
    <script src="{{url('public')}}/js/libs/modernizr.js"></script>
    <!--[if IE]>
    <link rel="stylesheet" href="{{url('public')}}/css/ie/ie.css">
    <![endif]-->
    <!--[if lte IE 8]>
    <script src="{{url('public')}}/js/responsive/html5shiv.js"></script>
    <script src="{{url('public')}}/js/responsive/respond.js"></script>
    <![endif]-->
</head>
<body>
<!--Preloader-->
<div class="preloader">
    <div class="status">&nbsp;</div>
</div>
<!--End Preloader-->

<!-- layout-->
<div id="layout" class="layout-semiboxed">
    <!-- fond-header-->
    <div id="fond-header" class="fond-header pattern-header-01"></div>
    <!-- End fond-header-->

    <!-- Header Area -->
    <header id="header">
        <div class="row">
            <!-- Logo Area -->
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-5">
                <div class="logo">
                    <a href="{{ url('/') }}">
                        <img src="{{url('public')}}/images/logo.png" class="img-responsive" alt="green">
                        <div class="logo_text">গ্রীন<span>মাল্টিপারপাস কো - অপারেটিভ সোসাইটি </span></div>
                    </a>
                </div>
            </div>
            <!-- End Logo Area -->

            <!-- Login Area -->
            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-7">
                <div class="info-login">
                    <div class="head-info-login">
                        <p><b>কর্মকর্তা/কর্মচারী লগইন</b></p>
                        <span><a href="{{ asset('/login') }}"> লগইন করুন </a></span>
                    </div>
                    <div class="form-theme">
                        <form class="form-horizontal" id="head_login" role="form" method="POST"
                              action="{{ route('login') }}">
                            {{ csrf_field() }}
                            <input type="text" name="phone" placeholder="ফোন/মোবাইল নম্বর " maxlength="11"
                                   minlength="11">
                            <input type="password" name="password" placeholder="পাসওয়ার্ড">
                            <button type="submit" class="btn">লগইন</button>
                            @if ($errors->has('phone'))
                                <span class="help-block">
                                        <strong style="color: white">{{ 'মোবাইল নম্বর অথবা পাসওয়ার্ড সঠিক নয়' }}</strong>
                                    </span>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
            <!-- End Login Area -->
        </div>
    </header>
    <!-- End Header Area -->

    <!-- content-central-->
    <div class="content-central">
        <!-- Nav-->
        <nav id="menu">
            <div class="navbar yamm navbar-default">
                <div class="container">
                    <div class="row">
                        <div class="navbar-header">
                            <button type="button" data-toggle="collapse" data-target="#navbar-collapse-1"
                                    class="navbar-toggle">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div id="navbar-collapse-1" class="navbar-collapse collapse">
                            <!-- Nav Bar Items -->
                            <ul class="nav navbar-nav">
                                <!-- Home Nav Items -->
                                <li class="dropdown">
                                    <a href="{{ url('/') }}">
                                        হোম
                                    </a>
                                </li>
                                <!-- End Home Nav Items -->

                                <!-- Gallery Nav Item -->
                                <li class="dropdown">
                                    <a href="{{url('gallery')}}">
                                        তথ্য ও ছবি
                                    </a>
                                </li>
                                <!-- End Gallery Nav Item -->

                                <!-- Services Nav Item -->
                                <li class="dropdown">
                                    <a href="{{url('/achievement/details')}}">
                                        অর্জন
                                    </a>
                                </li>
                                <!-- End Services Nav Item -->

                                <!-- Portfolio Nav Item -->
                                <li class="dropdown">
                                    <a href="{{url('/current_work/details')}}">
                                        চলমান কার্যক্রম
                                    </a>
                                </li>
                                <!-- End Portfolio Nav Item -->

                                <!-- News Nav Item -->
                                <li class="dropdown">
                                    <a href="{{url('/rules/details')}}">
                                        সমবায় নীতি
                                    </a>
                                </li>
                                <!-- End News Nav Item -->

                                <!-- Features Nav Item -->
                                <li class="dropdown yamm-fw">
                                    <a href="{{url('/about_us/details')}}">
                                        আমাদের কথা
                                    </a>
                                </li>
                                <!-- End Features Nav Item -->

                                <!-- Contact Us Nav Item -->
                                <li class="dropdown">
                                    <a href="{{url('contact_us')}}">
                                        যোগাযোগ করুন
                                    </a>
                                </li>
                                <!-- End Contact Us Nav Item -->
                            </ul>
                            <!-- End Nav Bar Items -->

                            <!-- Search Form -->
                            {{--<ul class="nav navbar-nav navbar-right">--}}
                            {{--<!-- Forms -->--}}
                            {{--<li class="dropdown">--}}
                            {{--<a href="#" data-toggle="dropdown" class="dropdown-toggle" aria-expanded="false">--}}
                            {{--<b class="glyphicon glyphicon-search"></b>--}}
                            {{--</a>--}}
                            {{--<ul class="dropdown-menu">--}}
                            {{--<li>--}}
                            {{--<div class="yamm-content">--}}
                            {{--<form class="search-Form" action="#">--}}
                            {{--<div class="input-group">--}}
                            {{--<span class="input-group-addon">--}}
                            {{--<i class="fa fa-search-plus"></i>--}}
                            {{--</span>--}}
                            {{--<input class="form-control" placeholder="খুঁজুন" name="search"  type="text" required="required">--}}
                            {{--</div>--}}
                            {{--</form>--}}
                            {{--</div>--}}
                            {{--</li>--}}
                            {{--</ul>--}}
                            {{--</li>--}}
                            {{--</ul>--}}
                                    <!-- End Search Form -->
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <!-- End Nav-->

        <!-- content info extent -->
        @yield('content')
                <!-- end content info extent -->

    </div>
    <!-- End content-central-->

    <!-- Sponsors Container-->
    <div class="container wow fadeInUp">
        <div class="row">
            <div class="col-md-12">
                <!-- Sponsors Zone-->
                <ul class="owl-carousel carousel-sponsors tooltip-hover" id="carousel-sponsors">
                    <li data-toggle="tooltip" title data-original-title="Name Sponsor">
                        <a href="#" class="tooltip_hover" title="Name Sponsor"><img
                                    src="{{url('public')}}/images/sponsors/1.png" alt="Image"></a>
                    </li>
                    <li data-toggle="tooltip" title data-original-title="Name Sponsor">
                        <a href="#" class="tooltip_hover" title="Name Sponsor"><img
                                    src="{{url('public')}}/images/sponsors/2.png" alt="Image"></a>
                    </li>
                    <li data-toggle="tooltip" title data-original-title="Name Sponsor">
                        <a href="#" class="tooltip_hover" title="Name Sponsor"><img
                                    src="{{url('public')}}/images/sponsors/3.png" alt="Image"></a>
                    </li>
                    <li data-toggle="tooltip" title data-original-title="Name Sponsor">
                        <a href="#" class="tooltip_hover" title="Name Sponsor"><img
                                    src="{{url('public')}}/images/sponsors/4.png" alt="Image"></a>
                    </li>
                    <li data-toggle="tooltip" title data-original-title="Name Sponsor">
                        <a href="#" class="tooltip_hover" title="Name Sponsor"><img
                                    src="{{url('public')}}/images/sponsors/5.png" alt="Image"></a>
                    </li>
                    <li data-toggle="tooltip" title data-original-title="Name Sponsor">
                        <a href="#" class="tooltip_hover" title="Name Sponsor"><img
                                    src="{{url('public')}}/images/sponsors/6.png" alt="Image"></a>
                    </li>
                    <li data-toggle="tooltip" title data-original-title="Name Sponsor">
                        <a href="#" class="tooltip_hover" title="Name Sponsor"><img
                                    src="{{url('public')}}/images/sponsors/7.png" alt="Image"></a>
                    </li>
                    <li data-toggle="tooltip" title data-original-title="Name Sponsor">
                        <a href="#" class="tooltip_hover" title="Name Sponsor"><img
                                    src="{{url('public')}}/images/sponsors/8.png" alt="Image"></a>
                    </li>
                </ul>
                <!-- End Sponsors Zone-->
            </div>
        </div>
    </div>
    <!-- End Sponsors Container-->

    <!-- footer-->
    <footer id="footer">

        <!-- Testimonials Container-->
        <div class="container">
            <div class="col-md-12 testimonials_area">
                <!-- title-vertical-line-->
                <div class="title-vertical-line">
                    <h2><span>সম্মানিতদের বাণী</span></h2>
                    <p class="lead">আমাদের সাহসী সহযোদ্ধা</p>
                </div>
                <!-- End title-vertical-line-->

                <ul id="testimonials" class="testimonials padding-top">
                    <li>
                        <blockquote><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque rutrum
                                pellentesque!.</p>
                            <img src="{{url('public')}}/images/testimonials/1.jpg" alt="">
                            <strong>Federic Gordon</strong><a href="#">@iwthemes</a></blockquote>
                    </li>
                    <li>
                        <blockquote><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque rutrum
                                pellentesque!.</p>
                            <img src="{{url('public')}}/images/testimonials/2.jpg" alt="">
                            <strong>Federic Gordon</strong><a href="#">@iwthemes</a></blockquote>
                    </li>
                    <li>
                        <blockquote><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque rutrum
                                pellentesque!.</p>
                            <img src="{{url('public')}}/images/testimonials/3.jpg" alt="">
                            <strong>Federic Gordon</strong><a href="#">@iwthemes</a></blockquote>
                    </li>
                    <li>
                        <blockquote><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque rutrum
                                pellentesque!.</p>
                            <img src="{{url('public')}}/images/testimonials/4.jpg" alt="">
                            <strong>Federic Gordon</strong><a href="#">@iwthemes</a></blockquote>
                    </li>
                </ul>
            </div>
        </div>
        <!-- End Testimonials Container-->

        <!-- Items Footer -->
        <div class="container">
            <div class="row paddings-mini">
                <!-- contact Items Footer -->
                <div class="col-sm-6 col-md-3">
                    <div class="border-right txt-right">
                        <img style="margin: 0 auto;" src="{{url('public')}}/images/logo.png" class="img-responsive"
                             alt="logo">

                    </div>
                </div>
                <!-- End contact items Footer -->

                <!-- Recent Links Items Footer -->
                <div class="col-sm-6 col-md-3">
                    <div class="border-right border-right-none">
                        <h4>জরুরি তথ্য লিংক </h4>
                        <ul class="list-styles">
                            <li><i class="fa fa-check"></i> <a href="{{url('/')}}">হোম</a></li>
                            <li><i class="fa fa-check"></i> <a href="{{url('gallery')}}">তথ্য ও ছবি</a></li>
                            <li><i class="fa fa-check"></i> <a href="{{url('/about_us/details')}}">আমাদের কথা</a></li>
                            <li><i class="fa fa-check"></i> <a href="{{url('/rules/details')}}"> সমবায় নীতি </a></li>
                            <li><i class="fa fa-check"></i> <a href="{{url('contact_us')}}"> যোগাযোগ করুন </a></li>
                        </ul>
                    </div>
                </div>
                <!-- End Recent Links Items Footer -->

                <!-- Recent Newsletter Footer -->
                <div class="col-sm-6 col-md-4">
                    <div class="border-right txt-right">
                        <h4>নিউজলেটার</h4>
                        <p>আপনার ই-মেইল লিখুন এবং আমাদের নিউজলেটার সাবস্ক্রাইব করুন.</p>
                        <form id="" class="newsletterForm" action="{{'/newsletter'}}" method="post">
                            {{csrf_field()}}
                            <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-envelope"></i>
                                        </span>
                                <input class="form-control" placeholder="আপনার ইমেইল লিখুন " name="email" type="email"
                                       required="required">
                                <span class="input-group-btn">
                                            <button class="btn btn-primary" type="submit" name="subscribe">
                                                সাবস্ক্রাইব!
                                            </button>
                                        </span>
                            </div>
                        </form>
                        <div id="result-newsletter">@include('includes.flashMessage')</div>
                    </div>
                </div>
                <!-- End Newsletter Footer -->

                <!-- Follow Items Footer -->
                <div class="col-sm-6 col-md-2">
                    <div class="border-right-none">
                        <h4>আমাদের সাথে থাকুন </h4>
                        <ul class="social">
                            <li class="facebook"><span><i class="fa fa-facebook"></i></span><a href="#">Facebook</a>
                            </li>
                            <li class="twitter"><span><i class="fa fa-twitter"></i></span><a href="#">Twitter</a></li>
                            <li class="google"><span><i class="fa fa-google"></i></span><a href="#">Google</a></li>
                        </ul>
                    </div>
                </div>
                <!-- End Follow Items Footer -->
            </div>
        </div>
        <!-- End Items Footer -->

        <!-- footer Down-->
        <div class="footer-down">
            <div class="container">
                <div class="row">
                    <div class="col-md-7">
                        powered by <img src="{{url('public')}}/images/gnt.png" alt="gnt">
                    </div>
                    <div class="col-md-5">
                        <p>&copy; 2015 Green Co-operative society. All Rights Reserved</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- footer Down-->
    </footer>
    <!-- End footer-->
</div>
<input type="hidden" name="baseurl" id="baseurl" value="{{url('')}}">
<!-- End layout-->

<!-- ======================= JQuery libs =========================== -->
<!-- jQuery local-->
<script type="text/javascript" src="{{url('public')}}/js/libs/jquery/jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="{{url('public')}}/js/libs/totop/jquery.ui.totop.js"></script>
<script type="text/javascript" src="{{url('public')}}/js/libs/carousel/owl.carousel.min.js"></script>
<script type="text/javascript" src="{{url('public')}}/js/libs/parallax/parallax.min.js"></script>
<script type="text/javascript" src="{{url('public')}}/js/libs/bootstrap/bootstrap.min.js"></script>
<script type="text/javascript" src="{{url('public')}}/js/main.js"></script>
<!-- ======================= End JQuery libs =========================== -->
<script>
    var base_url = $('#baseurl').val();
    var finalEnlishToBanglaNumber = {
        '0': '০',
        '1': '১',
        '2': '২',
        '3': '৩',
        '4': '৪',
        '5': '৫',
        '6': '৬',
        '7': '৭',
        '8': '৮',
        '9': '৯'
    };
    var finalBanglaToEnlishNumber = {
        '০': '0',
        '১': '1',
        '২': '2',
        '৩': '3',
        '৪': '4',
        '৫': '5',
        '৬': '6',
        '৭': '7',
        '৮': '8',
        '৯': '9'
    };
    String.prototype.getDigitBanglaFromEnglish = function () {
        var retStr = this;
        for (var x in finalEnlishToBanglaNumber) {
            retStr = retStr.replace(new RegExp(x, 'g'), finalEnlishToBanglaNumber[x]);
        }
        return retStr;
    };
    String.prototype.getDigitEnglishFromBangla = function () {
        var retStr = this;
        for (var x in finalBanglaToEnlishNumber) {
            retStr = retStr.replace(new RegExp(x, 'g'), finalBanglaToEnlishNumber[x]);
        }
        return retStr;
    };
</script>
@yield('customJs')
</body>
</html>
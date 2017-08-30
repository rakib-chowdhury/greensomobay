<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{  config('app.name') }} | co-operative society </title>

    <!-- BEGIN META -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="your,keywords">
    <meta name="description" content="Short explanation about this website">

    <!-- Favicons -->
    <link rel="shortcut icon" href="{{url('public')}}/images/icons/favicon.ico">
    <link rel="apple-touch-icon" href="{{url('public')}}/images/icons/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="{{url('public')}}/images/icons/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="{{url('public')}}/images/icons/apple-touch-icon-114x114.png">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- END META -->
    <!-- http://felicianoprochera.com/simple-task-app-with-laravel-5-3-and-vuejs/ -->
    <!-- BEGIN STYLESHEETS -->
    {{--<link href='http://fonts.googleapis.com/css?family=Roboto:300italic,400italic,300,400,500,700,900' rel='stylesheet' type='text/css'/>--}}
    <link type="text/css" rel="stylesheet" href="{{url('public')}}/css/fontawesome/font-awesome.min.css"/>
    <link type="text/css" rel="stylesheet" href="{{url('public')}}/css/bootstrap/bootstrap.css"/>
    <link type="text/css" rel="stylesheet" href="{{url('public')}}/css/materialadmin.css"/>
    @yield('specifiedCss')
            <!-- END STYLESHEETS -->
    <!-- Head Libs -->
    <script type="text/javascript" src="{{url('public')}}/js/libs/modernizr.js"></script>
    <!--[if IE]>
    <link rel="stylesheet" href="{{url('public')}}/css/ie/ie.css">
    <![endif]-->
    <!--[if lte IE 8]>
    <script src="{{url('public')}}js/responsive/html5shiv.js"></script>
    <script src="{{url('public')}}js/responsive/respond.js"></script>
    <![endif]-->
    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body class="menubar-hoverable header-fixed  menubar-pin">
<!-- BEGIN HEADER-->
@include('includes.authHeader');
<!-- END HEADER-->

<!-- BEGIN BASE-->
<div id="base">
    <!-- BEGIN OFFCANVAS LEFT -->
    <div class="offcanvas"></div>
    <!-- END OFFCANVAS LEFT -->

    <!-- BEGIN CONTENT-->
    <div id="content">
        @yield('content')
    </div>
    <!-- END CONTENT -->

    <!-- BEGIN MENUBAR-->
    @include('includes.authMenu')
            <!-- END MENUBAR -->

    <!-- BEGIN OFFCANVAS RIGHT -->
    @include('includes.authOffcanvas')
            <!-- END OFFCANVAS RIGHT -->

</div>
<!-- END BASE -->

<!-- BEGIN JAVASCRIPT -->
<script src="{{url('public')}}/js/libs/jquery/jquery-1.11.2.min.js"></script>
{{--<script src="{{ asset('/js/app.js') }}"></script>--}}
<script src="{{url('public')}}/js/libs/jquery/jquery-migrate-1.2.1.min.js"></script>
<script src="{{url('public')}}/js/libs/bootstrap/bootstrap.min.js"></script>
<script src="{{url('public')}}/js/libs/spin.js/spin.min.js"></script>
<script src="{{url('public')}}/js/libs/autosize/jquery.autosize.min.js"></script>
<script src="{{url('public')}}/js/libs/nanoscroller/jquery.nanoscroller.min.js"></script>
<script src="{{url('public')}}/js/libs/jquery-knob/jquery.knob.js"></script>
<script src="{{url('public')}}/js/core/source/App.js"></script>
<script src="{{url('public')}}/js/core/source/AppNavigation.js"></script>
<script src="{{url('public')}}/js/core/source/AppOffcanvas.js"></script>
<script src="{{url('public')}}/js/core/source/AppCard.js"></script>
<script src="{{url('public')}}/js/core/source/AppForm.js"></script>
<script src="{{url('public')}}/js/core/source/AppNavSearch.js"></script>
<script src="{{url('public')}}/js/core/source/AppVendor.js"></script>
<script src="{{url('public')}}/js/core/demo/Demo.js"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script>
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
@yield('specifiedJs')
        <!-- END JAVASCRIPT -->

</body>
</html>
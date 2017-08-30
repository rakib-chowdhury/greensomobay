@extends('layouts.public')

@section('customCss')
    <link rel="stylesheet" href="{{url('public')}}/css/responsive/responsiveslides.css">
    @endsection


    @section('content')
            <!-- Slide and tabs -->
    <div class="content_info">
        <!-- SLIDES CONTENT-->
        <div class="slides_area">
            <ul class="slides">
                <li>
                    <img src="{{url('public')}}/images/slide/slide-01.jpg" alt="" title=""/>
                    <div class="caption">
                        <h2>গ্রীন</h2>
                        <p>মাল্টিপারপাস কো - অপারেটিভ সোসাইটি </p>
                    </div>
                </li>
                <li>
                    <img src="{{url('public')}}/images/slide/slide-02.jpg" alt="" title=""/>
                    <div class="caption">
                        <h2>গ্রীন</h2>
                        <p>মাল্টিপারপাস কো - অপারেটিভ সোসাইটি </p>
                    </div>
                </li>
                <li>
                    <img src="{{url('public')}}/images/slide/slide-03.jpg" alt="" title=""/>
                    <div class="caption">
                        <h2>গ্রীন</h2>
                        <p>মাল্টিপারপাস কো - অপারেটিভ সোসাইটি </p>
                    </div>
                </li>
                <li>
                    <img src="{{url('public')}}/images/slide/slide-04.jpg" alt="" title=""/>
                    <div class="caption">
                        <h2>গ্রীন</h2>
                        <p>মাল্টিপারপাস কো - অপারেটিভ সোসাইটি </p>
                    </div>
                </li>
            </ul>
        </div>
        <!-- END SLIDES  -->
    </div>
    <!-- End - Slide -->

    <!-- Info Content - Boxes Services-->
    <div class="content_info">
        <div class="padding-top padding-bottom-mini">
            <!-- Container Area - Boxes Services -->
            <div class="container">
                <div class="row">
                    <!-- Col boxes-services -->
                    <section class="col-md-9">
                        <!-- boxes-services -->
                        <div class="row boxes-services">
                            <!-- item-boxe-services -->
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                                <div class="item-boxed-service">
                                    <h4>সদস্য <span>ভর্তি ফর্ম </span></h4>
                                    <a href="{{ url('/member_admission') }}">বিস্তারিত</a>
                                </div>
                            </div>
                            <!-- End item-boxe-services -->

                            <!-- item-boxe-services -->
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                                <div class="item-boxed-service">
                                    <h4>ঋণ <span> আবেদন ফর্ম</span></h4>
                                    <a style="cursor: pointer;" onclick="check_member('loan')">বিস্তারিত</a>
                                    {{--<a href="{{ url('loanApplicant') }}">বিস্তারিত</a>--}}
                                </div>
                            </div>
                            <!-- End item-boxe-services -->

                            <!-- item-boxe-services -->
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                                <div class="item-boxed-service">
                                    <h4>শেয়ার <span> সার্টিফিকেটই ফর্ম </span></h4>
                                    <a href="#"> বিস্তারিত</a>
                                </div>
                            </div>
                            <!-- End item-boxe-services -->

                            <!-- item-boxe-services -->
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                                <div class="item-boxed-service">
                                    <h4>আংশিক সঞ্চয় <span>গ্রহণের আবেদন</span></h4>
                                    <a style="cursor: pointer;" onclick="check_member('partial')">বিস্তারিত</a>
                                    {{--<a href="{{ url('/partialSavings') }}">বিস্তারিত</a>--}}
                                </div>
                            </div>
                            <!-- End item-boxe-services -->

                            <!-- item-boxe-services -->
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                                <div class="item-boxed-service">
                                    <h4>সদস্য পদ <span> পত্যাহার ফর্ম </span></h4>
                                    <a style="cursor: pointer;" onclick="check_member('resignation')">বিস্তারিত</a>
                                    {{--<a href="{{ url('/membersRecall') }}">বিস্তারিত</a>--}}
                                </div>
                            </div>
                            <!-- End item-boxe-services -->

                            <!-- item-boxe-services -->
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                                <div class="item-boxed-service">
                                    <h4>পাশবই</h4>
                                    <a href="#">বিস্তারিত</a>
                                </div>
                            </div>
                            <!-- End item-boxe-services -->
                        </div>
                        <!-- End boxes-services -->
                    </section>
                    <!-- End Col boxes-services -->

                    <!--Aside - mini and full boxes -->
                    <aside class="col-md-3 contact_area">
                        <h4>সর্বশেষ নোটিশ </h4>

                        <!-- contact form -->
                        <ul class="contact-list">
                            <li>
                                <h4>সদস্যদের নিকট থেকে আদায়কৃত শেয়ার ও সঞ্চয়ের</h4>
                                <div class="">
                                    <a href="" class=""><i class="fa fa-download"></i></a>
                                    <a href="" class="btn btn-success btn-xs">বিস্তারিত <i
                                                class="fa fa-long-arrow-right"></i></a>
                                </div>
                            </li>
                            <hr>
                            <li>
                                <h4>সদস্যদের নিকট থেকে আদায়কৃত শেয়ার ও সঞ্চয়ের</h4>
                                <div class="">
                                    <a href="" class=""><i class="fa fa-download"></i></a>
                                    <a href="" class="btn btn-success btn-xs">বিস্তারিত <i
                                                class="fa fa-long-arrow-right"></i></a>
                                </div>
                            </li>
                            <hr>
                            <li>
                                <h4>সদস্যদের নিকট থেকে আদায়কৃত শেয়ার ও সঞ্চয়ের</h4>
                                <div class="">
                                    <a href="" class=""><i class="fa fa-download"></i></a>
                                    <a href="" class="btn btn-success btn-xs">বিস্তারিত <i
                                                class="fa fa-long-arrow-right"></i></a>
                                </div>
                            </li>
                        </ul>
                    </aside>
                    <!-- End Aside - mini and full boxes -->
                </div>
            </div>
            <!-- End Container Area - Boxes Services -->
        </div>
    </div>
    <!-- End Info Content - Boxes Services-->

    <!-- Info Content  - Clients Downloads Area -->
    <div class="parallax-window" data-parallax="scroll"
         data-image-src="{{url('public')}}/images/parallax-img/parallax-04.jpg">
        <!-- Content Parallax-->
        <div class="opacy_bg_02 paddings">
            <div class="container">
                <div class="row">
                    <!-- title-downloads -->
                    <h1 class="title-downloads">
                        <span class="logo-clients">গ্রীন</span> সমবায় সমিতির সম্মানিত সদস্য
                        <span class="responsive-numbers">
                                        <span>২</span>
                                        ,
                                        <span>৩</span>
                                        <span>৮</span>
                                        <span>৯</span>
                                        ,
                                        <span>৫</span>
                                        <span>১</span>
                                        <span>৮</span>
                                    </span>
                        জন
                    </h1>
                    <!-- End title-downloads -->

                    <!-- subtitle-downloads -->
                    <div class="subtitle-downloads">
                        <h4>মডেল বাংলাদেশ গড়ার প্রত্যয় <i class="fa fa-heart"></i></h4>
                    </div>
                    <!-- End subtitle-downloads -->

                    <!-- Image Clients Downloads -->
                    <ul class="image-clients-downloads">
                        <li><img src="{{url('public')}}/images/clients-downloads/1.jpg" alt=""></li>
                        <li><img src="{{url('public')}}/images/clients-downloads/2.jpg" alt=""></li>
                        <li><img src="{{url('public')}}/images/clients-downloads/3.jpg" alt=""></li>
                        <li><img src="{{url('public')}}/images/clients-downloads/4.jpg" alt=""></li>
                        <li><img src="{{url('public')}}/images/clients-downloads/5.jpg" alt=""></li>
                        <li><img src="{{url('public')}}/images/clients-downloads/6.jpg" alt=""></li>
                        <li><img src="{{url('public')}}/images/clients-downloads/7.jpeg" alt=""></li>
                        <li><img src="{{url('public')}}/images/clients-downloads/8.jpg" alt=""></li>
                    </ul>
                    <!-- End Image Clients Downloads -->
                </div>
            </div>
        </div>
        <!-- End Content Parallax-->
    </div>
    <!-- End Info Content  - Clients Downloads Area -->

    <!-- Info Content Process-->
    <div class="content_info">
        <!-- title-vertical-line-->
        <div class="title-vertical-line">
            <h2><span>গ্রীন প্রকল্পসমূহ</span></h2>
            <p class="lead">সমবায় ভিত্তিক কার্যক্রমের মাধ্যমে দারিদ্র্য বিমোচন ও আর্থ-সামাজিক অবস্থার উন্নয়ন</p>
        </div>
        <!-- End title-vertical-line-->

        <!-- Info Resalt-->
        <div class="paddings">
            <!-- Container Area - services-process -->
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <!-- services-process -->
                        <div class="services-process">
                            <!-- item-service-process -->
                            <div class="item-service-process color-bg-1">
                                <div class="head-service-process">
                                    <i class="fa fa-cubes"></i>
                                    <h3>মুনাফা</h3>
                                </div>
                                <div class="divisor-service-process">
                                    <span class="circle-top">1</span>
                                    <span class="circle"></span>
                                </div>
                                <div class="info-service-process">
                                    <h3>সঞ্চয় মুনাফা</h3>
                                    <p>একজন সদস্য বার্ষিক ৫% হারে মুনাফা অর্জন করেন</p>
                                </div>
                            </div>
                            <!-- End item-service-process -->

                            <!-- item-service-process -->
                            <div class="item-service-process color-bg-2">
                                <div class="head-service-process">
                                    <i class="fa fa-diamond"></i>
                                    <h3>ফান্ড</h3>
                                </div>
                                <div class="divisor-service-process">
                                    <span class="circle-top">2</span>
                                    <span class="circle"></span>
                                </div>
                                <div class="info-service-process">
                                    <h3>শেয়ার ফান্ড</h3>
                                    <p style="height: 75px;">গ্রীন মাল্টিপারপাস কো-অপারেটিভ এর সদস্যগণ শেয়ার ক্রয় করে
                                        লাভবান হয়</p>
                                </div>
                            </div>
                            <!-- End item-service-process -->

                            <!-- item-service-process -->
                            <div class="item-service-process color-bg-3">
                                <div class="head-service-process">
                                    <i class="fa fa-bicycle"></i>
                                    <h3>ঋণ</h3>
                                </div>
                                <div class="divisor-service-process">
                                    <span class="circle-top">3</span>
                                    <span class="circle"></span>
                                </div>
                                <div class="info-service-process">
                                    <h3>সুদমুক্ত ঋণ</h3>
                                    <p>ক্ষুদ্র ব্যবসার প্রয়োজনে সদস্যগণ গ্রীন প্রকল্প থেকে সুদমুক্ত ঋণগ্রহণে স্বাবলম্বী
                                        হয়</p>
                                </div>
                            </div>
                            <!-- End item-service-process -->

                            <!-- item-service-process -->
                            <div class="item-service-process color-bg-4">
                                <div class="head-service-process">
                                    <i class="fa fa-hotel"></i>
                                    <h3>ঋণ</h3>
                                </div>
                                <div class="divisor-service-process">
                                    <span class="circle-top">4</span>
                                    <span class="circle"></span>
                                </div>
                                <div class="info-service-process">
                                    <h3>পণ্য ঋণ</h3>
                                    <p>আসবাবপত্র বা অন্য কোনো ক্রয়ের প্রয়োজনে সদস্যগণ গ্রীন প্রকল্প থেকে ঋণ গ্রহণ
                                        করেন</p>
                                </div>
                            </div>
                            <!-- End item-service-process -->
                        </div>
                        <!-- End services-process-->
                    </div>
                </div>
            </div>
            <!-- End Container Area - services-process -->
        </div>
        <!-- End Info Resalt-->
    </div>
    <!-- End Info Content Process-->

    @include('includes.check_member')
@endsection

@section('customJs')
    <script type="text/javascript" src="{{url('public')}}/js/libs/responsive/responsiveslides.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $(".slides").responsiveSlides({
                pager: false,
                nav: true,
                speed: 500,
                prevText: "<i class='fa fa-angle-left'></i>",
                nextText: "<i class='fa fa-angle-right'></i>",
                namespace: "callbacks",
                before: function () {
                    $('.events').append("<li>before event fired.</li>");
                },
                after: function () {
                    $('.events').append("<li>after event fired.</li>");
                }
            });
        });

        function check_member(type) {
            if (type == 'loan') {
                $('#m_title').text('ঋণ আবেদন ফর্ম');
                $('#m_type').val('loan');
            }
            else if (type == 'partial') {
                $('#m_title').text('আংশিক সঞ্চয় গ্রহণ ফর্ম');
                $('#m_type').val('partial');
            }
            else if (type == 'resignation') {
                $('#m_title').text('সদস্যপদ প্রত্যাহার ফর্ম');
                $('#m_type').val('resignation');
            }

            $('#check_member').modal('show');
        }

        function check_member_post() {
            var mb = $('#mb').val().getDigitEnglishFromBangla();
            var reg = $('#reg_no').val().getDigitEnglishFromBangla();
            if (mb == '' || mb == null || reg == '' || reg == null || isNaN(mb) || mb.length != 11) {
                $('#mdlErr').text('অনুগ্রহ করে সঠিক তথ্য প্রদান করুন');
                return false;
            } else {
                $.ajax({
                    url: base_url + '/check_member',
                    type: 'get',
                    data: {
                        mb: mb,
                        reg_no: reg
                    }, success: function (res) {
                        console.log(res);
                        if (res == 1) {
                            return true;
                        } else {
                            $('#mdlErr').text('প্রদানকৃত রেজিস্ট্রেশন নং ও মোবাইল নম্বর দিয়ে কোনো সদস্য পাওয়া যায়নি। অনুগ্রহ করে সঠিক তথ্য প্রদান করুন');
                            return false;
                        }
                    }
                });
            }

        }
    </script>
@endsection
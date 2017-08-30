<div id="menubar" class="">
    <div class="menubar-fixed-panel">
        <div>
            <a class="btn btn-icon-toggle btn-default menubar-toggle" data-toggle="menubar" href="javascript:void(0);">
                <i class="fa fa-bars"></i>
            </a>
        </div>
        <div class="expanded">
            <a href="">
                <span class="text-lg text-bold text-primary ">Green</span>
            </a>
        </div>
    </div>
    <div class="menubar-scroll-panel">

        <!-- BEGIN MAIN MENU -->
        <ul id="main-menu" class="gui-controls">
            <li>
                <a href="{{ url('/home') }}">
                    <div class="gui-icon"><i class="fa fa-dashcube"></i></div>
                    <span class="title">ড্যাশবোর্ড</span>
                </a>
            </li>
            @if(session('role')==1)
                    <!--branch--->
            <li>
                <a href="{{ url('/admin/branches') }}">
                    <div class="gui-icon"><i class="fa fa-briefcase"></i></div>
                    <span class="title">শাখা</span>
                </a>
            </li>
            <!--prokolpo--->
            <li>
                <a href="{{ url('/admin/prokolpos') }}">
                    <div class="gui-icon"><i class="fa fa-subway"></i></div>
                    <span class="title">প্রকল্প</span>
                </a>
            </li>
            @endif
            @if(session('role')==1 || session('role')==2 || session('role')==3)
                    <!---কর্মচারী--->
            <li>
                <a href="{{ url('/admin/employee') }}">
                    <div class="gui-icon"><i class="fa fa-user-secret"></i></div>
                    <span class="title">কর্মচারী</span>
                </a>
            </li>
            <!----সদস্য---->
            <li class="gui-folder">
                <a>
                    <div class="gui-icon"><i class="fa fa-sliders"></i></div>
                    <span class="title">সদস্য</span>
                </a>
                <!--start submenu -->
                <ul>
                    @if(session('role')==1)
                        <li><a href="{{ url('admin/member/lists/new') }}"><span class="title">আবেদনকৃত সদস্য</span></a>
                        </li>
                    @endif
                    <li><a href="{{ url('admin/member/lists/approved') }}"><span
                                    class="title">অনুমোদনকৃত সদস্য</span></a></li>
                    @if(session('role')==2)
                        <li><a href="{{ url('admin/member/lists/New') }}"><span class="title">নতুন সদস্য</span></a>
                        </li>
                    @endif
                    @if(session('role')==1)
                        <li><a href="{{ url('admin/member/lists/reject') }}"><span
                                        class="title">বাতিলকৃত সদস্য</span></a>
                        </li>
                        <li><a href="{{ url('admin/member/lists/block') }}"><span class="title">ব্লককৃত সদস্য</span></a>
                        </li>
                    @endif
                </ul><!--end /submenu -->
            </li>

            <!---বেতন--->
            <li class="gui-folder">
                <a>
                    <div class="gui-icon"><i class="fa fa-money"></i></div>
                    <span class="title">বেতন</span>
                </a>
                <!--start submenu -->
                <ul>
                    <li>
                        <a href="{{ url('admin/salary') }}"><span class="title">বেতন রিপোর্ট</span></a>
                    </li>
                    <li>
                        <a href="{{ url('admin/advance') }}"><span class="title">অগ্রিম</span></a>
                    </li>
                </ul><!--end /submenu -->
            </li>

            <!--expense--->
            <li>
                <a href="{{ url('/admin/expense') }}">
                    <div class="gui-icon"><i class="fa fa-money"></i></div>
                    <span class="title">ব্যয়</span>
                </a>
            </li>
            <!--income--->
            <li>
                <a href="{{ url('/admin/income') }}">
                    <div class="gui-icon"><i class="fa fa-money"></i></div>
                    <span class="title">আয়</span>
                </a>
            </li>
            @endif

            @if(session('role')==3 || session('role')==2)
                    <!--get share fund--->
            <li>
                <a href="{{ url('/admin/collect_share') }}">
                    <div class="gui-icon"><i class="fa fa-arrow-circle-up"></i></div>
                    <span class="title">শেয়ার ফান্ড গ্রহণ</span>
                </a>
            </li>
            <!--return share fund--->
            <li>
                <a href="{{ url('/admin/return_share') }}">
                    <div class="gui-icon"><i class="fa fa-arrow-circle-down"></i></div>
                    <span class="title">শেয়ার ফান্ড ফেরত</span>
                </a>
            </li>
            @endif

            @if(session('role')==4)
                    <!--deposit collect--->
            <li>
                <a href="{{ url('/admin/collect_deposit') }}">
                    <div class="gui-icon"><i class="fa fa-line-chart"></i></div>
                    <span class="title">সঞ্চয় আদায়</span>
                </a>
            </li>
            <!--loan collect--->
            <li>
                <a href="{{ url('/admin/collect_loan') }}">
                    <div class="gui-icon"><i class="fa fa-balance-scale"></i></div>
                    <span class="title">ঋণ ও সার্ভিস চার্জ আদায়</span>
                </a>
            </li>
            @endif
                    <!--member resignation--->
            <li class="gui-folder">
                <a>
                    <div class="gui-icon"><i class="fa fa-money"></i></div>
                    <span class="title">সদস্য প্রত্যাহার</span>
                </a>
                <!--start submenu -->
                <ul>
                    <li>
                        <a href="{{ url('admin/memberResignation/new') }}"><span
                                    class="title">আবেদনকৃত সদস্য প্রত্যাহার </span></a>
                    </li>
                    <li>
                        <a href="{{ url('admin/memberResignation/approved') }}"><span class="title">অনুমোদনকৃত সদস্য প্রত্যাহার</span></a>
                    </li>
                    <li>
                        <a href="{{ url('admin/memberResignation/reject') }}"><span class="title">বাতিলকৃত সদস্য প্রত্যাহার</span></a>
                    </li>
                </ul><!--end /submenu -->
            </li>

            <!--partial widthdrawal--->
            <li class="gui-folder">
                <a>
                    <div class="gui-icon"><i class="fa fa-money"></i></div>
                    <span class="title">আংশিক সঞ্চয় উত্তোলন</span>
                </a>
                <!--start submenu -->
                <ul>
                    <li>
                        <a href="{{ url('admin/partialDeposit/new') }}"><span
                                    class="title">আবেদনকৃত আংশিক সঞ্চয় উত্তোলন</span></a>
                    </li>
                    <li>
                        <a href="{{ url('admin/partialDeposit/approved') }}"><span class="title">অনুমোদনকৃত আংশিক সঞ্চয় উত্তোলন</span></a>
                    </li>
                    <li>
                        <a href="{{ url('admin/partialDeposit/reject') }}"><span class="title">বাতিলকৃত আংশিক সঞ্চয় উত্তোলন</span></a>
                    </li>
                </ul><!--end /submenu -->
            </li>

            <!--loan--->
            <li class="gui-folder">
                <a>
                    <div class="gui-icon"><i class="fa fa-money"></i></div>
                    <span class="title">ঋণ</span>
                </a>
                <!--start submenu -->
                <ul>
                    <li>
                        <a href="{{ url('admin/loan/new') }}"><span class="title">আবেদনকৃত ঋণ</span></a>
                    </li>
                    <li>
                        <a href="{{ url('admin/loan/approved') }}"><span class="title">অনুমোদনকৃত ঋণ</span></a>
                    </li>
                    <li>
                        <a href="{{ url('admin/loan/reject') }}"><span class="title">বাতিলকৃত ঋণ</span></a>
                    </li>
                </ul><!--end /submenu -->
            </li>

            <!---report--->

            <li class="gui-folder">
                <a>
                    <div class="gui-icon"><i class="fa fa-book"></i></div>
                    <span class="title">রিপোর্ট</span>
                </a>
                <!--start submenu -->
                <ul>
                    <!--loan report--->
                    <li>
                        <a href="{{ url('/admin/loanReport') }}">
                            <span class="title">ঋণ রিপোর্ট</span>
                        </a>
                    </li>
                    <!--deposit report--->
                    <li>
                        <a href="{{ url('/admin/report/depositReport') }}">
                            <span class="title">সঞ্চয় রিপোর্ট</span>
                        </a>
                    </li>
                    @if(session('role')==4)
                        <li>
                            <a href="{{ url('admin/report/list/'.session('emp_id')) }}">
                                <span class="title">রিপোর্ট</span>
                            </a>
                        </li>
                    @endif

                    @if(session('role')==2 || session('role')==3)
                        <li>
                            <a href="{{ url('admin/report/incomeExpense') }}">
                                <span class="title">জমা/খরচ</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('admin/report/showDetails') }}">
                                <span class="title">বিস্তারিত</span></a>
                        </li>
                    @endif

                </ul><!--end /submenu -->
            </li>

            <hr>
            @if(session('role')==1)
                    <!--website--->
            <li class="gui-folder">
                <a>
                    <div class="gui-icon"><i class="fa fa-book"></i></div>
                    <span class="title">ওয়েব সাইট</span>
                </a>
                <!--start submenu -->
                <ul>
                    <li><a href="{{ url('admin/front/achievement/show') }}"><span class="title">অর্জন</span></a>
                    </li>
                    <li><a href="{{ url('admin/front/current_work/show') }}"><span
                                    class="title">চলমান কার্যক্রম</span></a></li>
                    <li><a href="{{ url('admin/front/rules/show') }}"><span class="title">সমবায় নীতি</span></a></li>
                    <li><a href="{{ url('admin/front/about_us/show') }}"><span class="title">আমাদের কথা</span></a>
                    </li>
                    <li><a href="{{ url('admin/front/contact_us') }}"><span class="title">যোগাযোগ তথ্য</span></a>
                    </li>
                    <li><a href="{{ url('admin/front/gallery') }}"><span class="title">তথ্য ও ছবি</span></a></li>
                </ul><!--end /submenu -->
            </li>
            @endif
            {{--<li>--}}
            {{--<a href="{{ url('/admin/notification') }}">--}}
            {{--<div class="gui-icon"><i class="fa fa-bell-o"></i></div>--}}
            {{--<span class="title">Notification</span>--}}
            {{--</a>--}}
            {{--</li>--}}
            {{--tutor menu -- -- -- -- -- -- -- --- -- -- -- -- -- -- --}}

        </ul><!--end .main-menu -->
        <!-- END MAIN MENU -->

        <div class="menubar-foot-panel">
            <small class="no-linebreak hidden-folded">
                <span class="opacity-75">Copyright &copy; 2017</span> <strong><a href="http://geeksntechnology.com"
                                                                                 target="_blank">Geeksntechnology
                        Ltd</a></strong>
            </small>
        </div>
    </div><!--end .menubar-scroll-panel-->
</div><!--end #menubar-->
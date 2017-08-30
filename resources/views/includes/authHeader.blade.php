<header id="header" class="header-inverse">
    {{--class="header-inverse"--}}
    <div class="headerbar">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="headerbar-left">
            <ul class="header-nav header-nav-options">
                <li class="header-nav-brand" >
                    <div class="brand-holder text-center">
                        <a href="{{ url('/')  }}">
                            <img src="{{url('public')}}/images/logo.png" alt="tutorola" class="img-responsive">
                        </a>
                        <h2>গ্রীন মাল্টিপারপাস কোঅপারেটিভ</h2>
                    </div>
                </li>
                <li>
                    <a class="btn btn-icon-toggle menubar-toggle" data-toggle="menubar" href="javascript:void(0);">
                        <i class="fa fa-bars"></i>
                    </a>
                </li>
            </ul>
        </div>
        @if(Request::segment(1)=='home')
        <h2 class="col-md-offset-3 col-md-6 dash-welcome text-center">ড্যাশবোর্ডে আপনাকে স্বাগতম</h2>
        @endif
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="headerbar-right">

            <ul class="header-nav header-nav-profile">
                <li class="dropdown">
                    <a href="javascript:void(0);" class="dropdown-toggle ink-reaction" data-toggle="dropdown">
                        <img src="{{url('public/img/employee/'.session('pic'))}}" alt="" />
                        <span class="profile-info">
                            @if(!Auth::guest())
                                {{ session('name')}}
                            @endif
                        </span>
                    </a>
                    <ul class="dropdown-menu animation-dock">
                        <li><a href="">My profile</a></li>
                        <li><a href="">My Status <span class="badge style-success pull-right">Free</span></a></li>
                        <li class="divider"></li>
                        <li><a href="{{ url('/logout') }}"
                               onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                <i class="fa fa-fw fa-power-off text-danger"></i>
                                Logout
                            </a>
                            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul><!--end .dropdown-menu -->
                </li><!--end .dropdown -->
            </ul><!--end .header-nav-profile -->
        </div><!--end #header-navbar-collapse -->
    </div>
</header>
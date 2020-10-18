
<div id="preloader"></div>

<!--  header-section start  -->
<header class="header-section">
    <div class="header-bottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-2">
                    <a class="site-logo site-title mt-md-4" href="{{url("/club/home")}}">
                        <img class="" src="{{ asset('/images/onbet365.png') }}" alt="OnBet365"/>
                    </a>
                </div>
                <div class="onBetNav @if(Auth::guard("club")->check()) col-lg-6 @else col-lg-5 @endif">

                    <header>
                        <a href="{{url("/club/home")}}">
                            <img class="" src="{{ asset('/images/onbet365.png') }}" alt="OnBet365"/>
                        </a>
                    </header>
                    <a href="#" class="nav-button">Menu</a>
                    <nav class="nav mt-2 text-lg-right">
                        <ul class="navbar-nav">
                            <li><a id="homeMenu" href="{{url("/club/home")}}">Home</a></li>
                            <li><a id="advanceMenu" href="{{ route("club_advance") }}">Advance</a></li>
                            <li class="joinNewClubUserSingle"><a id="addNewUser" href="{{ route("add_new_user") }}">Add New User</a></li>
                            @if(Auth::guard("club")->check())
                                <li class="nav-submenu"><a id="myAccount" href="#">My Account</a>
                                    <ul>
                                        <li><a href="{{ route("club_view_profile") }}">View Profile</a></li>
                                        <li><a href="{{ route("club_follower") }}">Club follower</a></li>
                                        <li><a href="{{ route("club_change_password") }}">Change Password</a></li>
                                    </ul>
                                </li>
                                <li class="nav-submenu"><a id="myWallet" href="#">My Wallet</a>
                                    <ul>
                                        <li><a href="{{ route("club_withdraw") }}">Withdraw</a></li>
                                        <li><a href="{{ route("club_withdraw_history") }}">Withdraw History</a></li>
                                        <li><a href="{{ route("club_income_history") }}">Club History</a></li>
                                    </ul>
                                </li>
                            @endif
                        </ul>
                    </nav>

                    <a href="#" class="nav-close">Close Menu</a>

                </div>
                @guest
                    @if(!Auth::guard("web")->check())
                        <div class="col-md-1">
                            <a class="btn btn-danger mt-md-4 mt-5" href="{{ route("user_registration") }}">Join now</a>
                        </div>
                    @endif
                @endguest
                <div class="col-lg-4 col-sm-12">
                    @if(Auth::guard("club")->check())
                        <div class="userProfileheader">
                            <div class="row">
                                <div class="col-md-4 col-12">
                                    <a class="btn btn-sm btn-danger joinNewClubUser" href="{{ route('add_new_user') }}"> Add New User </a>
                                </div>
                                <div class="col-md-6 col-8">
                                    <div class="bg-success rounded mb-3">
                                        <b class="text-white p-2" style="font-size: 13px;font-weight: 700;text-transform: capitalize;">
                                            Welcome, {{ Auth::guard("club")->user()->username }} <br/>
                                            <img src="{{ asset("/images/coin.png") }}" alt="coins" width="20">
                                            {{ Auth::guard("club")->user()->totalBalance }}
                                        </b>
                                    </div>
                                </div>
                                <div class="col-md-2 col-4">
                                    <form action="{{ route('club.logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-md btn-warning mt-1 mb-3 p-2"> Logout </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div><!-- header-bottom end -->
</header>
<!--  header-section end  -->

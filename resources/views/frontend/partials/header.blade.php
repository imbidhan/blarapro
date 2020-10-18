
<div id="preloader"></div>

<!--  header-section start  -->
<header class="header-section">
    <div class="header-bottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-2">
                    <a class="site-logo site-title mt-md-4" href="{{url("/")}}">
                        <img class="" src="{{ asset('/images/onbet365.png') }}" alt="OnBet365"/>
                    </a>
                </div>
                <div class="onBetNav @if(Auth::guard("web")->check()) col-lg-6 @else col-lg-5 @endif">

                    <header>
                        <a href="{{url("/")}}">
                            <img class="" src="{{ asset('/images/onbet365.png') }}" alt="OnBet365"/>
                        </a>
                    </header>
                    <a href="#" class="nav-button">Menu</a>
                    <nav class="nav mt-2 text-lg-right">
                        <ul class="navbar-nav">
                            <li><a id="homeMenu" href="{{url("/")}}">Home</a></li>
                            <li><a id="advanceMenu" href="{{ route("advance") }}">Advance Bet</a></li>
                            @guest
                                @if(!Auth::guard("web")->check())
                                    <li class="joinNewUserSingle"><a id="userRegistration" href="{{ route("user_registration") }}">Join Now</a></li>
                                @endif
                            @endguest
                            @if(Auth::guard("web")->check())
                                <li class="nav-submenu"><a id="myAccount" href="#">My Account</a>
                                    <ul>
                                        <li><a href="{{ route('view_profile') }}">View Profile</a></li>
                                        <li><a href="{{ route('change_club') }}">Change Club</a></li>
                                        <li><a href="{{ route('my_follower') }}">My follower</a></li>
                                        <li><a href="{{ route('change_password') }}">Change Password</a></li>
                                        <li><a href="{{ route('get_sponsor') }}">Sponsor</a></li>
                                        <li><a href="{{ route('bet_history') }}">Bet History</a></li>
                                        <li><a href="{{ route('user_complain') }}"><span class="badge badge-warning">Complain Box</span></a></li>
                                    </ul>
                                </li>
                                <li class="nav-submenu"><a id="myWallet" href="#">My Wallet</a>
                                <ul>
                                    <li><a href="{{ route('make_deposit') }}">Make Deposit</a></li>
                                    <li><a href="{{ route('deposit_history') }}">Deposit history</a></li>
                                    <li><a href="{{ route('coin_transfer') }}">Coin Transfer</a></li>
                                    <li><a href="{{ route('coin_transfer_history') }}">Coin Transfer History</a></li>
                                    <li><a href="{{ route('withdraw') }}">Withdraw</a></li>
                                    <li><a href="{{ route('withdraw_history') }}">Withdraw History</a></li>
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
                            <a class="btn btn-danger joinNewUser" href="{{ route("user_registration") }}">Join now</a>
                        </div>
                    @endif
                @endguest
                <div class="col-lg-4 col-sm-12">
                    <div class="row">
                        <div class="col-md-12">
                            @if(!Auth::guard("web")->check())
                                <div class="frontendCustomLogin">
                                    <form action="{{ route('login') }}" method="POST">
                                        @csrf
                                        <input type="text" name="username" placeholder="Username" value="{{ old('username') }}" required />
                                        <label>
                                            <input type="password" name="password" placeholder="Password" required   autocomplete="off" />
                                        </label>
                                        <input class="cusLogIn" type="submit" value="Log In"/>
                                        <a href="{{ route("user_registration") }}" class="btn btn-sm btn-danger mobileCusJoin">Join Now</a>
                                    </form>
                                    @error('username') <p class="text-danger text-left">{{ $errors->has('username') ? $errors->first('username') : ' ' }}</p> @enderror
                                    @error('password') <p class="text-danger text-left">{{ $errors->has('password') ? $errors->first('password') : ' ' }}</p> @enderror
                                    @if(Session::get('error'))
                                        <p class="text-danger text-left">{{ Session::get('error') }}</p>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                    @if(Auth::guard("web")->check())
                        <div class="userProfileheader">
                            <div class="row">
                                <div class="col-md-7 offset-md-1 col-8">
                                    <div class="bg-success rounded mb-3">
                                        <b class="text-white p-2" style="font-size: 13px;text-transform: capitalize;">
                                            Welcome, {{ Auth::guard("web")->user()->username }} <a href="{{ route("user_registration") }}"></a><br/>
                                            <img src="{{ asset("/images/coin.png") }}" alt="coins" width="20">
                                            <span style="font-size:12px;" id="userNewBalance">{{ Auth::guard("web")->user()->totalBalance }}</span>
                                                <button style="border-radius: 2px;padding:0px 6px 0px 2px" class="text-dark bg-danger" id="refreshBalance" > &nbsp;<i class="fa fa-refresh"></i></button>
                                            <a style="border-radius: 2px;padding:0px 5px;" class="text-dark bg-warning" href="{{ route("make_deposit") }}">Deposit</a>
                                        </b>
                                    </div>
                                </div>
                                <div class="col-md-3 col-4">
                                    <form action="{{ route('user.logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-md btn-warning mt-md-1 mt-1 p-2"> Logout </button>
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

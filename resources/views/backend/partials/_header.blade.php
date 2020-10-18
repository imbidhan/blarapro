<nav class="site-navbar navbar navbar-default navbar-fixed-top navbar-mega" role="navigation">

    <div class="navbar-header">
        <button type="button" class="navbar-toggler hamburger hamburger-close navbar-toggler-left hided"
                data-toggle="menubar">
            <span class="sr-only">Toggle navigation</span>
            <span class="hamburger-bar"></span>
        </button>
        <button type="button" class="navbar-toggler collapsed" data-target="#site-navbar-collapse"
                data-toggle="collapse">
            <i class="icon wb-more-horizontal" aria-hidden="true"></i>
        </button>
        <div class="navbar-brand navbar-brand-center">
            <img class="navbar-brand-logo" src="{{ asset('/images/logo.png') }}" title="proBet">
            <span class="navbar-brand-text hidden-xs-down"> onBet365</span>
        </div>
        <button type="button" class="navbar-toggler collapsed" data-target="#site-navbar-search"
                data-toggle="collapse">
            <span class="sr-only">Toggle Search</span>
            <i class="icon wb-search" aria-hidden="true"></i>
        </button>
    </div>

    <div class="navbar-container container-fluid">
        <!-- Navbar Collapse -->
        <div class="collapse navbar-collapse navbar-collapse-toolbar" id="site-navbar-collapse">
            <!-- Navbar Toolbar -->
            <ul class="nav navbar-toolbar">
                <li class="nav-item hidden-float" id="toggleMenubar">
                    <a class="nav-link" data-toggle="menubar" href="#" role="button">
                        <i class="icon hamburger hamburger-arrow-left">
                            <span class="sr-only">Toggle menubar</span>
                            <span class="hamburger-bar"></span>
                        </i>
                    </a>
                </li>
                <li class="nav-item hidden-sm-down" id="toggleFullscreen">
                    <a class="nav-link icon icon-fullscreen" data-toggle="fullscreen" href="#" role="button">
                        <span class="sr-only">Toggle fullscreen</span>
                    </a>
                </li>
                <li class="nav-item hidden-float">
                    <a class="nav-link icon wb-search" data-toggle="collapse" href="#" data-target="#site-navbar-search"
                       role="button">
                        <span class="sr-only">Toggle Search</span>
                    </a>
                </li>

            </ul>
            <!-- End Navbar Toolbar -->

            <!-- Navbar Toolbar Right -->
            <ul class="nav navbar-toolbar navbar-right navbar-toolbar-right">
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="javascript:void(0)" data-animation="scale-up"
                       aria-expanded="false" role="button">
                        <span class="flag-icon flag-icon-bd"></span>
                    </a>
                    <div class="dropdown-menu" role="menu">
                        <a class="dropdown-item" href="javascript:void(0)" role="menuitem">
                            <span class="flag-icon flag-icon-gb"></span> English</a>
                        <a class="dropdown-item" href="javascript:void(0)" role="menuitem">
                            <span class="flag-icon flag-icon-fr"></span> French</a>
                        <a class="dropdown-item" href="javascript:void(0)" role="menuitem">
                            <span class="flag-icon flag-icon-cn"></span> Chinese</a>
                        <a class="dropdown-item" href="javascript:void(0)" role="menuitem">
                            <span class="flag-icon flag-icon-de"></span> German</a>
                        <a class="dropdown-item" href="javascript:void(0)" role="menuitem">
                            <span class="flag-icon flag-icon-nl"></span> Dutch</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link navbar-avatar" data-toggle="dropdown" href="#" aria-expanded="false" data-animation="scale-up" role="button">
                        <span class="avatar avatar-online">
                          @if(Auth::guard("admin")->user()->image == null)
                                <img src="{{ asset('backend/uploads/users/default.jpg') }}" alt="profile image">
                            @else
                                <img src="{{ asset( Auth::guard("admin")->user()->image ) }}" alt="profile image">
                            @endif
                          <i></i>
                        </span>
                    </a>
                    <div class="dropdown-menu" role="menu">
                        <a class="dropdown-item" href="{{ route('dashboard_user_profile') }}" role="menuitem"><i class="icon wb-user" aria-hidden="true"></i> Profile</a>
                        @if(Auth::guard("admin")->user()->userRole->name == 'supperAdmin' && Auth::guard("admin")->user()->type == 0)
                            <a class="dropdown-item" href="{{ route('access_level_create') }}" role="menuitem"><i class="icon wb-settings" aria-hidden="true"></i> Settings</a>
                        @endif
                        <div class="dropdown-divider" role="presentation"></div>
                        <a class="dropdown-item" href="{{ route('admin.logout') }}" role="menuitem"><i class="icon wb-power" aria-hidden="true"></i> Logout</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="javascript:void(0)" title="Notifications"
                       aria-expanded="false" data-animation="scale-up" role="button">
                        <i class="icon icon-2x wb-bell text-success" aria-hidden="true"></i>
                        <span class="badge badge-pill badge-danger up">@if($userDeposits->count() > 0){{ $userDeposits->count() }} @endif</span>
                    </a>
                    @if($userDeposits->count() > 0)
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-media" role="menu">
                            <div class="dropdown-menu-header">
                                <h5>REQUEST</h5>
                                <span class="badge badge-round badge-danger">New {{ $userDeposits->count() }}</span>
                            </div>

                            <div class="list-group">
                                <div data-role="container">
                                    <div data-role="content">
                                        @foreach($userDeposits as $userDeposit)
                                            <a class="list-group-item dropdown-item" href="{{ route("request_online_deposit") }}" role="menuitem">
                                                <div class="media">
                                                    <div class="pr-10">
                                                        <i class="icon wb-user bg-green-600 white icon-circle" aria-hidden="true"></i>
                                                    </div>
                                                    <div class="media-body">
                                                        <h6 class="media-heading"><span class="text-success"> {{  $userDeposit->userCreated->username }} </span> request for coin </h6>
                                                        <time class="media-meta" datetime="2018-06-11T18:29:20+08:00">
                                                            <?php
                                                                $db_time = DateTime::createFromFormat('Y-m-d H:i:s', $userDeposit->created_at, new DateTimeZone("UTC"));
                                                                echo $db_time->setTimeZone(new DateTimeZone("Asia/Dhaka"))->format('d M Y h:i:s A');
                                                            ?>
                                                        </time>
                                                    </div>
                                                </div>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="dropdown-menu-footer">
                                <a class="dropdown-item" href="{{ route("request_online_deposit") }}" role="menuitem">
                                    See All Deposit
                                </a>
                            </div>
                        </div>
                    @endif
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="javascript:void(0)" title="Withdraw"
                       aria-expanded="false" data-animation="scale-up" role="button">
                        <i class="icon icon-2x wb-payment text-warning" aria-hidden="true"></i>
                        <span class="badge badge-pill badge-warning up">@if($userWithdraws->count() > 0){{ $userWithdraws->count() }}@endif</span>
                    </a>
                    @if($userWithdraws->count() > 0)
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-media" role="menu">
                        <div class="dropdown-menu-header" role="presentation">
                            <h5>Withdraw</h5>
                            <span class="badge badge-round badge-warning">New {{ $userWithdraws->count() }}</span>
                        </div>
                        <div class="list-group">
                            <div data-role="container">
                                <div data-role="content">
                                    @foreach($userWithdraws as $userWithdraw)
                                        <a class="list-group-item dropdown-item" href="{{ route("user_new_withdraw_view") }}" role="menuitem">
                                            <div class="media">
                                                <div class="pr-10">
                                                    <i class="icon wb-envelope-open bg-yellow-600 white icon-circle" aria-hidden="true"></i>
                                                </div>
                                                <div class="media-body">
                                                    <h6 class="media-heading"><span class="text-warning"> {{  $userWithdraw->user->username }} </span> send withdraw</h6>
                                                    <time class="media-meta" datetime="2018-06-11T18:29:20+08:00">
                                                        <?php
                                                        $db_time = DateTime::createFromFormat('Y-m-d H:i:s', $userWithdraw->created_at, new DateTimeZone("UTC"));
                                                        echo $db_time->setTimeZone(new DateTimeZone("Asia/Dhaka"))->format('d M Y h:i A');
                                                        ?>
                                                    </time>
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="dropdown-menu-footer" role="presentation">
                            <a class="dropdown-item" href="{{ route("user_new_withdraw_view")}}" role="menuitem">
                                See all withdraw
                            </a>
                        </div>
                    </div>
                    @endif
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="javascript:void(0)" title="Messages"
                       aria-expanded="false" data-animation="scale-up" role="button">
                        <i class="icon icon-2x wb-envelope text-danger" aria-hidden="true"></i>
                        <span class="badge badge-pill badge-primary up">@if($userComplains->count() > 0){{ $userComplains->count() }}@endif</span>
                    </a>
                    @if($userComplains->count() > 0)
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-media" role="menu">
                        <div class="dropdown-menu-header" role="presentation">
                            <h5>MESSAGES</h5>
                            <span class="badge badge-round badge-danger">New {{ $userComplains->count() }}</span>
                        </div>
                        <div class="list-group">
                            <div data-role="container">
                                <div data-role="content">
                                    @foreach($userComplains as $userComplain)
                                        <a class="list-group-item dropdown-item" href="{{ route("new_complain_from_user")}}" role="menuitem">
                                            <div class="media">
                                                <div class="pr-10">
                                                    <i class="icon wb-envelope-open bg-danger white icon-circle" aria-hidden="true"></i>
                                                </div>
                                                <div class="media-body">
                                                    <h6 class="media-heading"><span class="text-danger"> {{  $userComplain->user->username }} </span> send message</h6>
                                                    <time class="media-meta" datetime="2018-06-11T18:29:20+08:00">
                                                        <?php
                                                            $db_time = DateTime::createFromFormat('Y-m-d H:i:s', $userComplain->created_at, new DateTimeZone("UTC"));
                                                            echo $db_time->setTimeZone(new DateTimeZone("Asia/Dhaka"))->format('d M Y h:i A');
                                                        ?>
                                                    </time>
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="dropdown-menu-footer" role="presentation">
                            <a class="dropdown-item" href="{{ route("new_complain_from_user")}}" role="menuitem">
                                See all messages
                            </a>
                        </div>
                    </div>
                    @endif
                </li>

            </ul>
            <!-- End Navbar Toolbar Right -->
        </div>
        <!-- End Navbar Collapse -->

        <!-- Site Navbar Seach -->
        <div class="collapse navbar-search-overlap" id="site-navbar-search">
            <form role="search">
                <div class="form-group">
                    <div class="input-search">
                        <i class="input-search-icon wb-search" aria-hidden="true"></i>
                        <input type="text" class="form-control" name="site-search" placeholder="Search...">
                        <button type="button" class="input-search-close icon wb-close" data-target="#site-navbar-search"
                                data-toggle="collapse" aria-label="Close"></button>
                    </div>
                </div>
            </form>
        </div>
        <!-- End Site Navbar Seach -->
    </div>

</nav>

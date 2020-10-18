<div class="site-menubar">

    <div class="site-menubar-body">
        <div>
            <div>
                <ul  style="margin-top:20px;" class="site-menu" data-plugin="menu">
                    @if(Auth::guard("admin")->user()->type == 3)
                        <li id="depositMasterManage" class="site-menu-item has-sub">
                                <a href="javascript:void(0)">
                                    <i class="site-menu-icon wb-folder" aria-hidden="true"></i>
                                    <span class="site-menu-title">Mst: Deposit & Withdraw</span>
                                    <span class="site-menu-arrow"></span>
                                </a>
                                <ul class="site-menu-sub">

                                    <li id="totalSearch" class="site-menu-item">
                                        <a class="animsition-link" href="{{ route("total_system_search") }}">
                                            <span class="site-menu-title badge badge-pill badge-warning">Search</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        <li id="userdeposit" class="site-menu-item has-sub">
                            <a href="javascript:void(0)">
                                <i class="site-menu-icon wb-folder" aria-hidden="true"></i>
                                <span class="site-menu-title">User Deposit</span>
                                <span class="site-menu-arrow"></span>
                            </a>
                            <ul class="site-menu-sub">
                                <li id="getMoney" class="site-menu-item">
                                    <a class="animsition-link" href="{{ route('get_money_deposit') }}">
                                        <span class="site-menu-title">Get Money</span>
                                    </a>
                                </li>
                            </ul>
                            <ul class="site-menu-sub">
                                <li id="getCoinToCoin" class="site-menu-item">
                                    <a class="animsition-link" href="{{ route('get_coin_to_coin_deposit') }}">
                                        <span class="site-menu-title">Get Coin to Coin</span>
                                    </a>
                                </li>
                            </ul>
                            <ul class="site-menu-sub">
                                <li id="unpaid" class="site-menu-item">
                                    <a class="animsition-link" href="{{ route('get_unpaid_deposit') }}">
                                        <span class="site-menu-title">Unpaid</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li id="withdrawManage" class="site-menu-item has-sub">
                        <a href="javascript:void(0)">
                            <i class="site-menu-icon wb-folder" aria-hidden="true"></i>
                            <span class="site-menu-title">Withdraw</span>
                            <span class="site-menu-arrow"></span>
                        </a>
                        <ul class="site-menu-sub">
                            <li id="withdrawUserRequest" class="site-menu-item">
                                <a class="animsition-link" href="{{ route("user_new_withdraw_view") }}">
                                    <span class="site-menu-title">User New Withdraw</span>
                                </a>
                            </li>
                            <li id="withdrawUserRequestCancel" class="site-menu-item">
                                <a class="animsition-link" href="{{ route("user_cancel_withdraw_view") }}">
                                    <span class="site-menu-title">User Cancel Withdraw</span>
                                </a>
                            </li>
                            <li id="withdrawUserRequestAccept" class="site-menu-item">
                                <a class="animsition-link" href="{{ route("user_accept_withdraw_view") }}">
                                    <span class="site-menu-title">User Accept Withdraw</span>
                                </a>
                            </li>
                            <li id="withdrawClubRequest" class="site-menu-item">
                                <a class="animsition-link" href="{{ route("club_new_withdraw_view") }}">
                                    <span class="site-menu-title">Club New Withdraw</span>
                                </a>
                            </li>
                            <li id="withdrawClubRequestCancel" class="site-menu-item">
                                <a class="animsition-link" href="{{ route("club_cancel_withdraw_view") }}">
                                    <span class="site-menu-title">Club Cancel Withdraw</span>
                                </a>
                            </li>
                            <li id="withdrawClubRequestAccept" class="site-menu-item">
                                <a class="animsition-link" href="{{ route("club_accept_withdraw_view") }}">
                                    <span class="site-menu-title">Club Accept Withdraw</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                        <li id="configManage" class="site-menu-item has-sub">
                        <a href="javascript:void(0)">
                            <i class="site-menu-icon wb-folder" aria-hidden="true"></i>
                            <span class="site-menu-title">Configuration</span>
                            <span class="site-menu-arrow"></span>
                        </a>
                        <ul class="site-menu-sub">
                            <li id="configManageChildLi" class="site-menu-item">
                                <a class="animsition-link" href="{{ route("config_manage") }}">
                                    <span class="site-menu-title">Config</span>
                                </a>
                            </li>
                            <li id="bkashManageChildLi" class="site-menu-item">
                                <a class="animsition-link" href="{{ route("bkash_manage") }}">
                                    <span class="site-menu-title">Bkash</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    @endif
                    
                    @if(Auth::guard("admin")->user()->type != 3)
                    @if(Auth::guard("admin")->user()->userRole->name == 'supperAdmin')
                        <li id="sportsManage" class="site-menu-item has-sub">
                            <a href="javascript:void(0)">
                                <i class="site-menu-icon wb-folder" aria-hidden="true"></i>
                                <span class="site-menu-title">Sports</span>
                                <span class="site-menu-arrow"></span>
                            </a>
                            <ul class="site-menu-sub">
                                <li id="sportsManageChildLi" class="site-menu-item">
                                    <a class="animsition-link" href="{{ route('sports_manage') }}">
                                        <span class="site-menu-title">Sports Manage</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li id="depositMasterManage" class="site-menu-item has-sub">
                                <a href="javascript:void(0)">
                                    <i class="site-menu-icon wb-folder" aria-hidden="true"></i>
                                    <span class="site-menu-title">Mst: Deposit & Withdraw</span>
                                    <span class="site-menu-arrow"></span>
                                </a>
                                <ul class="site-menu-sub">

                                    <li id="totalSearch" class="site-menu-item">
                                        <a class="animsition-link" href="{{ route("total_system_search") }}">
                                            <span class="site-menu-title badge badge-pill badge-warning">Search</span>
                                        </a>
                                    </li>
                                    <li id="depositMasterManageChildLi" class="site-menu-item">
                                        <a class="animsition-link" href="{{ route("master_deposit_manage") }}">
                                            <span class="site-menu-title badge badge-pill badge-success">Master Balance</span>
                                        </a>
                                    </li>
                                    @if(Auth::guard("admin")->user()->userRole->name == 'supperAdmin' && Auth::guard("admin")->user()->type == 0)
                                    <li id="siteSummaryLi" class="site-menu-item">
                                        <a class="animsition-link" href="{{ route("site_summary") }}">
                                            <span class="site-menu-title badge badge-pill badge-primary">Site Summary</span>
                                        </a>
                                    </li>
                                    @endif
                                    <li id="depositMasterDetailManageChildLi" class="site-menu-item">
                                        <a class="animsition-link" href="{{ route("master_deposit_detail_manage") }}">
                                            <span class="site-menu-title">Master Deposit</span>
                                        </a>
                                    </li>
                                    <li id="withdrawMasterManageChildLi" class="site-menu-item">
                                        <a class="animsition-link" href="{{ route("master_withdraw_manage") }}">
                                            <span class="site-menu-title">Master Withdraw</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        <li id="userdeposit" class="site-menu-item has-sub">
                            <a href="javascript:void(0)">
                                <i class="site-menu-icon wb-folder" aria-hidden="true"></i>
                                <span class="site-menu-title">User Deposit</span>
                                <span class="site-menu-arrow"></span>
                            </a>
                            <ul class="site-menu-sub">
                                <li id="getMoney" class="site-menu-item">
                                    <a class="animsition-link" href="{{ route('get_money_deposit') }}">
                                        <span class="site-menu-title">Get Money</span>
                                    </a>
                                </li>
                            </ul>
                            <ul class="site-menu-sub">
                                <li id="getCoinToCoin" class="site-menu-item">
                                    <a class="animsition-link" href="{{ route('get_coin_to_coin_deposit') }}">
                                        <span class="site-menu-title">Get Coin to Coin</span>
                                    </a>
                                </li>
                            </ul>
                            <ul class="site-menu-sub">
                                <li id="unpaid" class="site-menu-item">
                                    <a class="animsition-link" href="{{ route('get_unpaid_deposit') }}">
                                        <span class="site-menu-title">Unpaid</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li id="usercomplain" class="site-menu-item has-sub">
                            <a href="javascript:void(0)">
                                <i class="site-menu-icon wb-folder" aria-hidden="true"></i>
                                <span class="site-menu-title">User complain</span>
                                <span class="site-menu-arrow"></span>
                            </a>
                            <ul class="site-menu-sub">
                                <li id="complainlist" class="site-menu-item">
                                    <a class="animsition-link" href="{{ route('get_user_complain') }}">
                                        <span class="site-menu-title">User complain</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endif
                    @if(Auth::guard("admin")->user()->userRole->name == 'supperAdmin' || Auth::guard("admin")->user()->userRole->name == 'mainAdmin')
                    <li id="slidesManage" class="site-menu-item has-sub">
                                <a href="javascript:void(0)">
                                    <i class="site-menu-icon wb-folder" aria-hidden="true"></i>
                                    <span class="site-menu-title">Slides</span>
                                    <span class="site-menu-arrow"></span>
                                </a>
                                <ul class="site-menu-sub">
                                    <li id="slidesManageChildLi" class="site-menu-item">
                                        <a class="animsition-link" href="{{ route("slides_manage") }}">
                                            <span class="site-menu-title">Manage slides</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                    <li id="configManage" class="site-menu-item has-sub">
                        <a href="javascript:void(0)">
                            <i class="site-menu-icon wb-folder" aria-hidden="true"></i>
                            <span class="site-menu-title">Configuration</span>
                            <span class="site-menu-arrow"></span>
                        </a>
                        <ul class="site-menu-sub">
                            <li id="configManageChildLi" class="site-menu-item">
                                <a class="animsition-link" href="{{ route("config_manage") }}">
                                    <span class="site-menu-title">Config</span>
                                </a>
                            </li>
                            <li id="bkashManageChildLi" class="site-menu-item">
                                <a class="animsition-link" href="{{ route("bkash_manage") }}">
                                    <span class="site-menu-title">Bkash</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    @endif
                    <li id="teamManage" class="site-menu-item has-sub">
                        <a href="javascript:void(0)">
                            <i class="site-menu-icon wb-folder" aria-hidden="true"></i>
                            <span class="site-menu-title">Teams</span>
                            <span class="site-menu-arrow"></span>
                        </a>
                        <ul class="site-menu-sub">
                            <li id="teamManageChildLi" class="site-menu-item">
                                <a class="animsition-link" href="{{ route('team_manage') }}">
                                    <span class="site-menu-title">Teams Manage</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li id="tournamentManage" class="site-menu-item has-sub">
                        <a href="javascript:void(0)">
                            <i class="site-menu-icon wb-folder" aria-hidden="true"></i>
                            <span class="site-menu-title">Tournaments</span>
                            <span class="site-menu-arrow"></span>
                        </a>
                        <ul class="site-menu-sub">
                            <li id="tournamentManageChildLi"class="site-menu-item">
                                <a class="animsition-link" href="{{ route('tournaments_manage') }}">
                                    <span class="site-menu-title">Tournaments Manage</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    @if(Auth::guard("admin")->user()->userRole->name == 'supperAdmin')
                    <li id="OnlineUserManage" class="site-menu-item has-sub">
                        <a href="javascript:void(0)">
                            <i class="site-menu-icon wb-folder" aria-hidden="true"></i>
                            <span class="site-menu-title">Online User Manage</span>
                            <span class="site-menu-arrow"></span>
                        </a>
                        <ul class="site-menu-sub">
                            <li id="OnlineUserManageChild" class="site-menu-item">
                                <a class="animsition-link" href="{{ route("online_user_manage")  }}">
                                    <span class="site-menu-title">Online User Manage</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li id="clubManage" class="site-menu-item has-sub">
                        <a href="javascript:void(0)">
                            <i class="site-menu-icon wb-folder" aria-hidden="true"></i>
                            <span class="site-menu-title">Club</span>
                            <span class="site-menu-arrow"></span>
                        </a>
                        <ul class="site-menu-sub">
                            <li id="clubManageChildLi" class="site-menu-item">
                                <a class="animsition-link" href="{{ route("club_manage") }}">
                                    <span class="site-menu-title">Manage club</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    @endif
                        @if(Auth::guard("admin")->user()->userRole->name == 'supperAdmin' || Auth::guard("admin")->user()->userRole->name == 'mainAdmin')
                    <li id="betoptionsManage" class="site-menu-item has-sub">
                        <a href="javascript:void(0)">
                            <i class="site-menu-icon wb-folder" aria-hidden="true"></i>
                            <span class="site-menu-title">Bet Options</span>
                            <span class="site-menu-arrow"></span>
                        </a>
                        <ul class="site-menu-sub">
                            <li  id="betoptionsManageChildLi" class="site-menu-item">
                                <a class="animsition-link" href="{{ route('betoptions_manage') }}">
                                    <span class="site-menu-title">Bet Options</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                        @endif
                    <li id="matchManage" class="site-menu-item has-sub">
                        <a href="javascript:void(0)">
                            <i class="site-menu-icon wb-folder" aria-hidden="true"></i>
                            <span class="site-menu-title">Matches</span>
                            <span class="site-menu-arrow"></span>
                        </a>
                        <ul class="site-menu-sub">
                            <li id="matchIp" class="site-menu-item">
                                <a class="animsition-link" href="{{ route('check_ip_address') }}">
                                    <span class="site-menu-title">Check Ip</span>
                                </a>
                            </li>
                            <li id="matchManageChildLi" class="site-menu-item">
                                <a class="animsition-link" href="{{ route('matches_manage') }}">
                                    <span class="site-menu-title">Matches Manage</span>
                                </a>
                            </li>
                            @if(Auth::guard("admin")->user()->userRole->name == 'supperAdmin')
                            <li id="matchFinishLi" class="site-menu-item">
                                <a class="animsition-link" href="{{ route('complete_matches_manage') }}">
                                    <span class="site-menu-title">Finish Matches</span>
                                </a>
                            </li>
                            @endif
                            @if(Auth::guard("admin")->user()->userRole->name == 'supperAdmin' && Auth::guard("admin")->user()->type == 0)
                            <li id="matchCloseLi" class="site-menu-item">
                                <a class="animsition-link" href="{{ route('close_matches_manage') }}">
                                    <span class="site-menu-title">Close Matches</span>
                                </a>
                            </li>

                            @endif

                        </ul>
                    </li>
                    
                    @if(Auth::guard("admin")->user()->userRole->name == 'supperAdmin')
                    <li id="withdrawManage" class="site-menu-item has-sub">
                        <a href="javascript:void(0)">
                            <i class="site-menu-icon wb-folder" aria-hidden="true"></i>
                            <span class="site-menu-title">Withdraw</span>
                            <span class="site-menu-arrow"></span>
                        </a>
                        <ul class="site-menu-sub">
                            <li id="withdrawUserRequest" class="site-menu-item">
                                <a class="animsition-link" href="{{ route("user_new_withdraw_view") }}">
                                    <span class="site-menu-title">User New Withdraw</span>
                                </a>
                            </li>
                            <li id="withdrawUserRequestCancel" class="site-menu-item">
                                <a class="animsition-link" href="{{ route("user_cancel_withdraw_view") }}">
                                    <span class="site-menu-title">User Cancel Withdraw</span>
                                </a>
                            </li>
                            <li id="withdrawUserRequestAccept" class="site-menu-item">
                                <a class="animsition-link" href="{{ route("user_accept_withdraw_view") }}">
                                    <span class="site-menu-title">User Accept Withdraw</span>
                                </a>
                            </li>
                            <li id="withdrawClubRequest" class="site-menu-item">
                                <a class="animsition-link" href="{{ route("club_new_withdraw_view") }}">
                                    <span class="site-menu-title">Club New Withdraw</span>
                                </a>
                            </li>
                            <li id="withdrawClubRequestCancel" class="site-menu-item">
                                <a class="animsition-link" href="{{ route("club_cancel_withdraw_view") }}">
                                    <span class="site-menu-title">Club Cancel Withdraw</span>
                                </a>
                            </li>
                            <li id="withdrawClubRequestAccept" class="site-menu-item">
                                <a class="animsition-link" href="{{ route("club_accept_withdraw_view") }}">
                                    <span class="site-menu-title">Club Accept Withdraw</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    @endif
                    
                    @if(Auth::guard("admin")->user()->userRole->name == 'supperAdmin' && Auth::guard("admin")->user()->type == 0)
                        <li id="coinTransferManage" class="site-menu-item has-sub">
                            <a href="javascript:void(0)">
                                <i class="site-menu-icon wb-folder" aria-hidden="true"></i>
                                <span class="site-menu-title">Coin Transfer</span>
                                <span class="site-menu-arrow"></span>
                            </a>
                            <ul class="site-menu-sub">
                                <li id="coinTransferManageLi" class="site-menu-item">
                                    <a class="animsition-link" href="{{ route("cointransfer_manage") }}">
                                        <span class="site-menu-title">User Coin Transfer</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endif
                    @endif
                </ul>
            </div>
        </div>
    </div>

    <div class="site-menubar-footer">
        <a target="_blank" href="{{ url("/") }}" class="fold-show" data-placement="top" data-toggle="tooltip"
            data-original-title="Website">
            <span class="fa fa-globe" aria-hidden="true"></span>
        </a>
        <a href="{{ url("/admin/home") }}" data-placement="top" data-toggle="tooltip" data-original-title="Dashboard">
            <span class="fa fa-dashboard" aria-hidden="true"></span>
        </a>
        <a href="{{ route('admin.logout') }}" data-placement="top" data-toggle="tooltip" data-original-title="Logout">
            <span class="icon wb-power" aria-hidden="true"></span>
        </a>
    </div>

</div>

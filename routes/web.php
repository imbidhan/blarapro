<?php

    /* Default route*/
    Auth::routes();
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/user/logout', 'Auth\LoginController@userLogoutRedirect');
    Route::post('/user/logout', 'Auth\LoginController@userLogout')->name('user.logout');

    /*Guest User*/
    Route::group(['middleware' => 'logout_users'], function () {
        Route::get('/test', "FrontendController@test");
        Route::get('/', "FrontendController@index");
        Route::get('/live/data', "FrontendController@HomeTabRefresh"); #For home page ajax tab refresh for 6 seconds
        /*Route::get('/inplay/tab/refresh', "FrontendController@InPlayTabRefresh");*/ #For inPlay page ajax tab refresh for 6 seconds
        Route::get('/show/single/bet/detail/{id}', "FrontendController@showSingleBetDetails"); #click button and show single bet detail to pop up modal
        Route::post('/store/place/bet', "FrontendController@storeSingleUserBet"); #store single user bet
        Route::get('/single/match/details/{id}', "FrontendController@singleMatchDetails")->name("single_match_details");
        /*Route::get('/inplay', "FrontendController@inplay")->name("in_play");*/
        Route::get('/advance', "FrontendController@advance")->name("advance");
        Route::get('/user/registration', "FrontendController@userRegistration")->name("user_registration");
        Route::post('/user/registration', "FrontendController@onlineUserStore")->name("online_user_store");
    });

    Route::group(['middleware' => ['auth:web','logout_users']], function () {
        Route::get('/user/info/', 'FrontendController@userLoginHistory');
        Route::get('/view/profile',"FrontendController@myProfile")->name("view_profile");
        Route::get('/edit/profile',"FrontendController@editProfile")->name("edit_profile");
        Route::post('/update/profile/{username}',"FrontendController@updateProfile")->name("update_profile");
        Route::get('/change/club',"FrontendController@changeClub")->name("change_club");
        Route::post('/update/club/{username}',"FrontendController@updateClub")->name("update_club");
        Route::get('/my/follower',"FrontendController@myFollower")->name("my_follower");
        Route::get('/change/password',"FrontendController@chnagePassword")->name("change_password");
        Route::post('/update/password',"FrontendController@updatePassword")->name("update_online_user_password");
        Route::get('/bet/history',"FrontendController@betHistory")->name("bet_history");
        Route::get('/user/complain',"UserComplainController@userComplain")->name("user_complain");
        Route::post('/user/complain/store',"UserComplainController@userComplainStore")->name("user_complain_store");
        Route::get('/get/sponsor',"FrontendController@getSponsor")->name("get_sponsor");

        Route::get('/make/deposit',"UserdepositController@makeDeposit")->name("make_deposit");
        Route::get('/deposit/number/refresh/',"UserdepositController@depositNumberRefresh");

        Route::post('/user/online/deposit',"UserdepositController@userOnlineDeposit")->name("user_online_deposit");
        Route::get('/deposit/history',"UserdepositController@depositHistory")->name("deposit_history");

        Route::get('/coin/transfer',"CointransferController@coinTransfer")->name("coin_transfer");
        Route::post('/store/coin/transfer',"CointransferController@storeCoinTransfer")->name("store_coin_transfer");
        Route::get('/coin/transfer/history',"CointransferController@coinTransferHistory")->name("coin_transfer_history");

        Route::get('/my/withdraw',"UserwithdrawController@withdraw")->name("withdraw");
        Route::post('/user/withdraw/store',"UserwithdrawController@userWithdrawStore")->name("user_withdraw_store");
        Route::get('/my/withdraw/history',"UserwithdrawController@withdrawHistory")->name("withdraw_history");
        Route::get('/user/withdraw/cancel/{id}',"UserwithdrawController@userWithdrawCancel")->name("user_withdraw_cancel");
        Route::get('/refresh/user/main/balance/', "FrontendController@refreshUserMainBalance"); #click button and show latest user balance

    });

    /* Club Guest Route before login*/
    Route::namespace('Club')->name('club.')->group(function () {
        Route::get('/club/login',  'ClubAuthController@clubGetLogin')->name('login');
        Route::post('/club/login', 'ClubAuthController@clubPostLogin')->name('login');
        Route::get('/club/logout', 'ClubAuthController@clubLogoutRedirect');
        Route::post('/club/logout', 'ClubAuthController@clubLogout')->name('logout');
    });


    /* Club Route after login*/
    Route::group(['middleware' => ['auth:club','logout_clubs']], function () {
        Route::get('/club/home', 'ClubBackendController@index')->name('club.home');
        /*Route::get('/club/inplay',"ClubDashboardController@clubInplay")->name("club_inplay");*/
        Route::get('/club/advance',"ClubDashboardController@clubAdvance")->name("club_advance");
        Route::get('/club/single/match/details/{id}', "FrontendController@clubSingleMatchDetails")->name("club_single_match_details");
        Route::get('/club/view/profile',"ClubDashboardController@clubProfile")->name("club_view_profile");
        Route::get('/club/follower',"ClubDashboardController@clubFollower")->name("club_follower");
        Route::get('/club/change/password',"ClubDashboardController@clubChangePassword")->name("club_change_password");
        Route::post('/club/update/password',"ClubDashboardController@clubUpdatePassword")->name("club_update_password");
        Route::get('/add/new/user',"ClubDashboardController@addNewUser")->name("add_new_user");
        Route::get('/club/withdraw',"ClubDashboardController@clubWithdraw")->name("club_withdraw");
        Route::post('/club/withdraw/store',"ClubDashboardController@clubWithdrawStore")->name("club_withdraw_store");
        Route::get('/club/withdraw/cancel/{id}',"ClubDashboardController@clubWithdrawCancel")->name("club_withdraw_cancel");
        Route::get('/club/withdraw/history',"ClubDashboardController@clubWithdrawHistory")->name("club_withdraw_history");
        Route::get('/club/income/history',"ClubDashboardController@clubIncomeHistory")->name("club_income_history");
    });

    /* Admin Route Here*/
    Route::namespace('Admin')->name('admin.')->group(function () {
        Route::get('/xYz/hOnesT/bAngLa/lOgIn/admin',  'AdminAuthController@getLogin')->name('login');
        Route::post('/xYz/hOnesT/bAngLa/lOgIn/admin', 'AdminAuthController@postLogin')->name('login');
        Route::get('/logout', 'AdminAuthController@postLogout')->name('logout');
    });
    Route::group(['middleware' => ['auth:admin','logout_admins']], function () {
        Route::get('/admin/home', 'backendController@index')->name('admin.home');
    });

    /*Route::get('/ethical/hacked', 'FrontendController@ethicalHacking');*/

    /*Dashboard route*/
    Route::group(['middleware' => ['auth:admin','logout_admins','super_admin']], function () {
        Route::get('/admin/request/user/online/deposit',"UserdepositController@userOnlineDepositRequestView")->name("request_online_deposit");
        Route::post('/admin/approve/user/online/deposit/request/{id}',"UserdepositController@approveUserOnlineDepositRequest")->name("approve_user_online_deposit_request");

        Route::get('/admin/get/money/deposit',"UserdepositController@getMoneyDeposit")->name("get_money_deposit");
        Route::get('/admin/accepted/user/deposit/refund/for/getmoney/{id}',"UserdepositController@acceptedUserDepositRefundForGetMoney")->name("accepted_user_deposit_refund_for_getmoney");
        Route::get('/admin/get/coin/to/coin/deposit',"UserdepositController@getCoinToCoinDeposit")->name("get_coin_to_coin_deposit");
        Route::get('/admin/accepted/user/deposit/refund/for/cointocoin/{id}',"UserdepositController@acceptedUserDepositRefundForCoinToCoin")->name("accepted_user_deposit_refund_for_cointocoin");
        Route::get('/admin/get/unpaid/deposit',"UserdepositController@getUnpaidDeposit")->name("get_unpaid_deposit");
        Route::get('/admin/accepted/user/deposit/refund/unpaid/{id}',"UserdepositController@acceptedUserDepositRefundForUnpaid")->name("accepted_user_deposit_refund_for_unpaid");

        Route::get('/admin/user/new/withdraw',"UserwithdrawController@userNewWithdrawView")->name("user_new_withdraw_view");
        Route::get('/admin/user/edit/withdraw/{id}',"UserwithdrawController@userNewWithdrawEdit")->name("user_new_withdraw_edit");
        Route::get('/admin/user/withdraw/cancel/{id}',"UserwithdrawController@adminUserWithdrawCancel")->name("admin_user_withdraw_cancel");
        Route::get('/admin/user/cancel/withdraw',"UserwithdrawController@userCancelWithdrawView")->name("user_cancel_withdraw_view");
        Route::post('/admin/user/accept/withdraw/{id}',"UserwithdrawController@userNewWithdrawAccept")->name("user_new_withdraw_accept");
        Route::get('/admin/user/accept/withdraw',"UserwithdrawController@userAcceptWithdrawView")->name("user_accept_withdraw_view");

        Route::get('/admin/club/new/withdraw',"ClubDashboardController@clubNewWithdrawView")->name("club_new_withdraw_view");
        Route::get('/admin/club/cancel/withdraw',"ClubDashboardController@clubCancelWithdrawView")->name("club_cancel_withdraw_view");
        Route::post('/admin/club/accept/withdraw/{id}',"ClubDashboardController@clubNewWithdrawAccept")->name("club_new_withdraw_accept");
        Route::get('/admin/club/accept/withdraw/',"ClubDashboardController@clubAcceptWithdrawView")->name("club_accept_withdraw_view");


        Route::get('/admin/new/complain/from/user',"UserComplainController@newComplainFromUser")->name("new_complain_from_user");
        Route::get('/admin/new/complain/accept/{id}',"UserComplainController@complainAccept")->name("complain_accept");
        Route::get('/admin/get/complain/user',"UserComplainController@getUserComplain")->name("get_user_complain");

        Route::get('admin/cointransfer/manage', 'UserwithdrawController@coinTransferRecords')->name('cointransfer_manage')->middleware('auth');
    });

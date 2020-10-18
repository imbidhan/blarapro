<?php

    Route::group(['prefix' => 'admin/sports', 'middleware' => ['auth:admin','logout_admins','super_admin']], function () {
        Route::get('/manage', 'SportsController@index')->name('sports_manage')->middleware('auth');
        Route::get('/create', 'SportsController@create')->name('sport_create')->middleware('auth');
        Route::post('/store', 'SportsController@store')->name('sport_store')->middleware('auth');
        /*Route::get('/edit/{id}', 'SportsController@edit')->name('sports_edit')->middleware('auth');
        Route::post('/update/{id}', 'SportsController@update')->name('sport_update')->middleware('auth');
        Route::get('/delete/{id}', 'SportsController@destroy')->name('sport_delete')->middleware('auth');*/
    });

    Route::group(['prefix' => 'admin/teams', 'middleware' => ['auth:admin','logout_admins']], function () {
        Route::get('/manage', 'TeamController@index')->name('team_manage')->middleware('auth');
        Route::get('/create', 'TeamController@create')->name('team_create')->middleware('auth');
        Route::post('/store', 'TeamController@store')->name('team_store')->middleware('auth');
        Route::get('/edit/{id}', 'TeamController@edit')->name('team_edit')->middleware('auth');
        Route::post('/update/{id}', 'TeamController@update')->name('team_update')->middleware('auth');
        Route::get('/delete/{id}', 'TeamController@destroy')->name('team_delete')->middleware('auth');
    });

    Route::group(['prefix' => 'admin/tournaments', 'middleware' => ['auth:admin','logout_admins']], function () {
        Route::get('/manage', 'TournamentController@index')->name('tournaments_manage')->middleware('auth');
        Route::get('/create', 'TournamentController@create')->name('tournaments_create')->middleware('auth');
        Route::post('/store', 'TournamentController@store')->name('tournaments_store')->middleware('auth');
        Route::get('/edit/{id}', 'TournamentController@edit')->name('tournaments_edit')->middleware('auth');
        Route::post('/update/{id}', 'TournamentController@update')->name('tournaments_update')->middleware('auth');
        Route::get('/delete/{id}', 'TournamentController@destroy')->name('tournaments_delete')->middleware('auth');
    });

    Route::group(['prefix' => 'admin/matches', 'middleware' => ['auth:admin','logout_admins']], function () {
        Route::get('/check/ip', 'MatchesController@checkAdminIp')->name('check_ip_address')->middleware('auth');
        Route::get('/matches/manage', 'MatchesController@index')->name('matches_manage')->middleware('auth');
        Route::get('/complete/matches/manage', 'MatchesController@completeMatchesManage')->name('complete_matches_manage')->middleware('auth');

        Route::get('/close/matches/manage', 'MatchesController@closeMatchesManage')->name('close_matches_manage')->middleware('auth');
        Route::get('/detail/close/{id}', 'MatchesController@matchesDetailClose')->name('matches_detail_close')->middleware('auth');
        Route::post('/match/details/close/action/{id}', 'MatchesController@matchDetailsCloseAction')->name('match_details_close_action')->middleware('auth');

        Route::get('/create', 'MatchesController@create')->name('matches_create')->middleware('auth');
        Route::get('/change/sports/{id}', 'MatchesController@changeSports')->name('change_sports')->middleware('auth');
        Route::post('/store', 'MatchesController@store')->name('matches_store')->middleware('auth');
        Route::get('/edit/{id}', 'MatchesController@edit')->name('matches_edit')->middleware('auth');
        Route::post('/update/{id}', 'MatchesController@update')->name('matches_update')->middleware('auth');
        Route::get('/detail/{id}', 'MatchesController@matchDetail')->name('matches_detail')->middleware('auth');
        Route::get('/detail/complete/{id}', 'MatchesController@matchesDetailComplete')->name('matches_detail_complete')->middleware('auth');

        Route::get('/matches/unpublished/list/{id}', 'MatchesController@matchUnpublishedList')->name('matches_unpublished_list')->middleware(['auth','super_admin']);
        Route::post('/bet/unpublished/reset', 'MatchesController@betUnpublished')->name('bet_unpublished_reset')->middleware(['auth','super_admin']);

        Route::post('/match/details/action/{id}', 'MatchesController@matchDetailsAction')->name('match_details_action')->middleware('auth');
        Route::post('/match/details/vanish/action/{id}', 'MatchesController@matchDetailsVanishAction')->name('match_details_vanish_action')->middleware('auth');
        Route::post('/betsetup/{id}', 'MatchesController@matchesBetSetup')->name('matches_betsetup')->middleware('auth');
        Route::post('/betsetup/live/{id}', 'MatchesController@matchesBetSetupLive')->name('matches_betsetup_live')->middleware('auth');
        Route::post('/update/single/betoption/{id}', 'MatchesController@updateSingleBetOption')->name('update_single_bet_option')->middleware('auth');
        Route::post('total/question/bet/rate/update', 'MatchesController@totalQuestionBetRateUpdate')->name('total_question_bet_rate_update')->middleware('auth');
        Route::get('/single/bet/delete/{id}', 'MatchesController@singleBetDelete')->name('single_bet_delete')->middleware('auth');

        #betAction Tab
        Route::post('/total/match/bet/off/{matchId}', 'MatchesController@totalMatchBetOnOff')->name('total_match_bet_on_off')->middleware('auth');
        Route::get('/bet/action/off/{matchId}/{betOptionId}', 'MatchesController@betActionOff')->name('bet_action_off')->middleware('auth');
        Route::get('/bet/action/on/{matchId}/{betOptionId}', 'MatchesController@betActionOn')->name('bet_action_on')->middleware('auth');
        Route::get('/bet/action/hide/form/user/page/{matchId}/{betOptionId}', 'MatchesController@betActionHideFormUserPage')->name('bet_action_hide_form_user_page')->middleware('auth');
        Route::get('/bet/action/delete/{matchId}/{betOptionId}', 'MatchesController@betActionDelete')->name('bet_action_delete')->middleware('auth');
        Route::get('/user/bet/return/{betplaceid}', 'MatchesController@userBetReturn')->name('user_bet_return')->middleware('auth');
        Route::get('/user/bet/delete/{betplaceid}', 'MatchesController@userBetDelete')->name('user_bet_delete')->middleware('auth');
        Route::post('/bet/win/or/lost', 'MatchesController@betWinLost')->name('bet_win_lost')->middleware('auth');
        Route::get('/bet/partial/one/{rate}/{matchId}/{betOptionId}', 'MatchesController@partialOne')->name('partial_one')->middleware('auth');
        Route::get('/bet/partial/two/{rate}/{matchId}/{betOptionId}', 'MatchesController@partialTwo')->name('partial_two')->middleware('auth');

        Route::get('/live/matches/betrate/view/{id}/{score_id}', 'MatchesController@liveMatchBetRateView')->name('live_matches_betrate_view')->middleware('auth');
        Route::post('/live/matches/betrate/update/{id}', 'MatchesController@liveMatchUpdateBetRate')->name('live_matches_betrate_update')->middleware('auth');

    });
    #Score route
    Route::group(['prefix' => 'admin/score', 'middleware' => ['auth:admin','logout_admins']], function () {
        Route::get('/live/matches/view/{id}', 'ScoreController@matchesLiveScoreView')->name('matches_live_score_view')->middleware('auth');
        Route::post('/live/matches/update/{id}', 'ScoreController@matchesLiveScoreUpdate')->name('matches_live_score_update')->middleware('auth');
    });

    Route::group(['prefix' => 'admin/betoptions', 'middleware' => ['auth:admin','logout_admins']], function () {
        Route::get('/manage', 'BetoptionController@index')->name('betoptions_manage')->middleware('auth');
        Route::get('/create', 'BetoptionController@create')->name('betoptions_create')->middleware('auth');
        Route::post('/store', 'BetoptionController@store')->name('betoptions_store')->middleware('auth');
        Route::get('/edit/{id}', 'BetoptionController@edit')->name('betoptions_edit')->middleware('auth');
        Route::post('/update/{id}', 'BetoptionController@update')->name('betoptions_update')->middleware('auth');
        Route::get('/delete/{id}', 'BetoptionController@destroy')->name('betoptions_delete')->middleware('auth');
    });



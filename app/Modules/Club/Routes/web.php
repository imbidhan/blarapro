<?php
Route::group(['prefix' => 'admin/club', 'middleware' => ['auth:admin','logout_admins','super_admin']], function () {
    Route::get('/manage', 'ClubController@index')->name('club_manage')->middleware('auth');
    Route::get('/create', 'ClubController@create')->name('club_create')->middleware('auth');
    Route::post('/store', 'ClubController@store')->name('club_store')->middleware('auth');
    Route::get('/edit/{id}', 'ClubController@edit')->name('club_edit')->middleware('auth');
    Route::get('/club/user/password/change/{id}', 'ClubController@clubUserPasswordChange')->name('club_user_password_change')->middleware('auth');
    Route::post('/club/user/password/update/{id}', 'ClubController@clubUserPasswordUpdate')->name('club_user_password_update')->middleware('auth');
    Route::post('/update/{id}', 'ClubController@update')->name('club_update')->middleware('auth');
    Route::post('/club/status/change',"ClubController@clubStatusChange")->name("club_status_change")->middleware("auth");
    Route::get('/every/club/total/user/list/{id}',"ClubController@everyClubTotalUseList")->name("every_club_total_user_list")->middleware("auth");
});

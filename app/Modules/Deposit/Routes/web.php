<?php

Route::group(['prefix' => 'admin/masterdeposit', 'middleware' => ['auth:admin','logout_admins','super_admin']], function () {
    Route::get('/manage', 'MasterdepositController@mainBalance')->name('master_deposit_manage')->middleware('auth');
    Route::get('/site/summary', 'MasterdepositController@siteSummary')->name('site_summary')->middleware('auth');
    Route::get('/total/system/search', 'MasterdepositController@totalSystemSearch')->name('total_system_search')->middleware('auth');
    Route::get('/total/deposit/withdraw', 'MasterdepositController@totalDepositWithdraw')->name('total_deposit_withdraw')->middleware('auth');
});

Route::group(['prefix' => 'admin/masterdepositdetails', 'middleware' => ['auth:admin','logout_admins','super_admin']], function () {
    Route::get('/manage', 'MasterdepositController@index')->name('master_deposit_detail_manage')->middleware('auth');
    Route::get('/create', 'MasterdepositController@create')->name('master_deposit_detail_create')->middleware('auth');
    Route::post('/store', 'MasterdepositController@store')->name('master_deposit_detail_store')->middleware('auth');
});

Route::group(['prefix' => 'admin/masterwithdraw', 'middleware' => ['auth:admin','logout_admins','super_admin']], function () {
    Route::get('/manage', 'MasterwithdrawController@index')->name('master_withdraw_manage')->middleware('auth');
    Route::get('/create', 'MasterwithdrawController@create')->name('master_withdraw_create')->middleware('auth');
    Route::post('/store', 'MasterwithdrawController@store')->name('master_withdraw_store')->middleware('auth');
});

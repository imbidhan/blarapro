<?php
Route::group(['prefix' => 'admin/configs', 'middleware' => ['auth:admin','logout_admins']], function () {
    Route::get('/manage', 'ConfigController@index')->name('config_manage')->middleware('auth');
    Route::get('/edit/{id}', 'ConfigController@edit')->name('config_edit')->middleware('auth');
    Route::post('/update/{id}', 'ConfigController@update')->name('config_update')->middleware('auth');
});

Route::group(['prefix' => 'admin/bkash', 'middleware' => ['auth:admin','logout_admins']], function () {
    Route::get('/manage', 'BkashController@index')->name('bkash_manage')->middleware('auth');
    Route::get('/create', 'BkashController@create')->name('bkash_create')->middleware('auth');
    Route::post('/store', 'BkashController@store')->name('bkash_store')->middleware('auth');
    Route::get('/edit/{id}', 'BkashController@edit')->name('bkash_edit')->middleware('auth');
    Route::post('/update/{id}', 'BkashController@update')->name('bkash_update')->middleware('auth');
    Route::get('/delete/{id}', 'BkashController@destroy')->name('bkash_delete')->middleware('auth');
});

<?php

Route::group(['prefix' => 'admin/slide', 'middleware' => ['auth:admin','logout_admins']], function () {
    Route::get('/manage', 'SlideController@index')->name('slides_manage')->middleware('auth');
    Route::get('/create', 'SlideController@create')->name('slides_create')->middleware('auth');
    Route::post('/store', 'SlideController@store')->name('slides_store')->middleware('auth');
    Route::get('/edit/{id}', 'SlideController@edit')->name('slides_edit')->middleware('auth');
    Route::post('/update/{id}', 'SlideController@update')->name('slides_update')->middleware('auth');
    Route::get('/delete/{id}', 'SlideController@destroy')->name('slides_delete')->middleware('auth');
});

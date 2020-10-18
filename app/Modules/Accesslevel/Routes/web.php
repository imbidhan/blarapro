<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your module. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/


Route::group(['prefix' => 'admin/settings/access-level', 'middleware' => ['auth:admin','super_admin']], function () {
    Route::get('/', 'AccessLevelController@create')->name('access_level_create')->middleware('auth');
    Route::post('store', 'AccessLevelController@store')->name('access_level_store')->middleware('auth');
    Route::get('edit/{id}', 'AccessLevelController@edit')->name('access_level_edit')->middleware('auth');
    Route::post('update', 'AccessLevelController@update')->name('access_level_update')->middleware('auth');
});

Route::group(['prefix' => 'admin/settings/roles', 'middleware' => ['auth:admin','super_admin']], function () {
    Route::get('/', 'RoleController@index')->name('role')->middleware('auth');
    Route::get('create', 'RoleController@create')->name('role_create')->middleware('auth');
    Route::post('store', 'RoleController@store')->name('role_store')->middleware('auth');
    Route::get('edit/{id}', 'RoleController@edit')->name('role_edit')->middleware('auth');
    Route::post('update/{id}', 'RoleController@update')->name('role_update')->middleware('auth');
    Route::get('delete/{id}', 'RoleController@destroy')->name('role_delete')->middleware('auth');
});

Route::group(['prefix' => 'admin/settings/users', 'middleware' => ['auth:admin','super_admin']], function () {
    Route::get('/', 'UserController@index')->name('user')->middleware('auth');
    Route::get('create', 'UserController@create')->name('user_create_access_level')->middleware('auth');
    Route::post('store', 'UserController@store')->name('user_store_access_level')->middleware('auth');
    Route::get('password/{id}', 'UserController@password')->name('user_password')->middleware('auth');
    Route::post('password/{id}/update', 'UserController@updatePassword')->name('update_password')->middleware('auth');
    Route::get('role/{id}', 'UserController@userRole')->name('user_role')->middleware('auth');
    Route::post('role/{id}/update', 'UserController@updateUserRole')->name('update_user_role')->middleware('auth');
    Route::get('edit/{id}', 'UserController@edit')->name('user_edit_access_level')->middleware('auth');
    Route::post('update/{id}', 'UserController@update')->name('user_update_access_level')->middleware('auth');
    Route::post('change/status', 'UserController@adminUserChangeStatus')->name('admin_user_status_change')->middleware('auth');
    // Route::get('delete/{id}', 'UserController@destroy')->name('user_destroy_access_level')->middleware('auth');
});
Route::group(['prefix' => 'admin/settings/users/profile/', 'middleware' => ['auth:admin']], function () {
    Route::get('/', 'UserController@dashboardUserProfile')->name('dashboard_user_profile')->middleware('auth');
    Route::post('/update', 'UserController@dashboardUserProfileUpdate')->name('dashboard_user_profile_update')->middleware('auth');
    Route::get('/change/admin/user/password', 'UserController@changeAdminUserPassword')->name('change_admin_user_password')->middleware('auth');
    Route::post('/update/admin/user/password', 'UserController@updateAdminUserPassword')->name('update_admin_user_password')->middleware('auth');

});

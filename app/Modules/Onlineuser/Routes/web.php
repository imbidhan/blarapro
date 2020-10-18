<?php


Route::group(['prefix' => 'admin/online/user', 'middleware' => ['auth:admin','logout_admins','super_admin']], function () {

    Route::get('/manage',"OnlineuserController@onlineUserManage")->name("online_user_manage")->middleware("auth");
    Route::get('/online/user/password/change/{id}',"OnlineuserController@onlineUserPasswordChange")->name("online_user_password_change")->middleware("auth");
    Route::get('/online/user/bet/history{id}',"OnlineuserController@onlineUserBetHistory")->name("online_user_bet_history")->middleware("auth");
    Route::post('/update/online/user/password/{id}',"OnlineuserController@updateOnlineUserPassword")->name("update_online_user_password_from_admin")->middleware("auth");
    Route::post('/status/change',"OnlineuserController@onlineUserStatusChange")->name("online_user_status_change")->middleware("auth");

});

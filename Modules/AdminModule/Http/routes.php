<?php

Route::group(['prefix' => 'admin', 'middleware' => 'adminAuth', 'as' => 'admin_', 'namespace' => 'Modules\AdminModule\Http\Controllers'], function () {
    Route::any('destroyFinally', 'CommonController@deleteCommonWithAjax')->name('destroyFinally');
    Route::post('lockUser', 'CommonController@lockUser')->name('lockUser');
    Route::any('adminprofile', 'AdminProfileController@index')->name('adminprofile');
    Route::any('adminprofile/save', 'AdminProfileController@save')->name('adminprofile_save');
    Route::any('adminprofile/changepassword', 'AdminProfileController@changepassword')->name('adminprofile_changepassword');
    Route::get('normalusermanagementjson', 'NormalUserManagementController@json')->name('normalusermanagementjson');
	Route::get('usermanagementjson', 'UserManagementController@json')->name('usermanagementjson');
    Route::resource('usermanagement', 'UserManagementController');
    Route::resource('normalusermanagement', 'NormalUserManagementController');

    Route::any('mainTransaction', 'MainTransactionController@index')->name('mainTransaction');
    Route::any('mainTransactionJson', 'MainTransactionController@json')->name('mainTransactionJson');
    Route::any('mainTransactionAddEdit', 'MainTransactionController@addEdit')->name('mainTransactionAddEdit');

    Route::get('/home', 'HomeController@index')->name('home');
});

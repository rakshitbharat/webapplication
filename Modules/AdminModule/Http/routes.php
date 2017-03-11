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
    Route::any('mainTransactionDeleteByTransactionCode', 'MainTransactionController@deleteByTransactionCode')->name('mainTransactionDeleteByTransactionCode');

    Route::any('accountType', 'AccountTypeController@index')->name('accountType');
    Route::any('accountTypeJson', 'AccountTypeController@json')->name('accountTypeJson');
    Route::any('accountTypeAddEdit', 'AccountTypeController@addEdit')->name('accountTypeAddEdit');

    Route::any('account', 'AccountController@index')->name('account');
    Route::any('accountJson', 'AccountController@json')->name('accountJson');
    Route::any('accountAddEdit', 'AccountController@addEdit')->name('accountAddEdit');

    Route::any('contact', 'ContactController@index')->name('contact');
    Route::any('contactJson', 'ContactController@json')->name('contactJson');
    Route::any('contactAddEdit', 'ContactController@addEdit')->name('contactAddEdit');

    Route::get('/home', 'HomeController@index')->name('home');
});

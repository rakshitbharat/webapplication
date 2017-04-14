<?php

Route::group(['prefix' => 'admin', 'middleware' => 'adminAuth', 'as' => 'admin_', 'namespace' => 'Modules\SidbarBuilder\Http\Controllers'], function() {
    Route::get('routeName', 'SidbarBuilderController@routeName')->name('mainRouteRouteName');
});

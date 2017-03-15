<?php

Route::group(['as' => 'front_', 'namespace' => 'Modules\FrontModule\Http\Controllers'], function () {
    Route::get('/', 'FrontMainController@index')->name('home');
    Route::any('/contactUsSave', 'FrontMainController@contactUsSave')->name('contactUsSave');
});
<?php

Route::group(['middleware' => 'web', 'namespace' => 'Modules\Location\Http\Controllers'], function() {

    Route::any('location', 'LocationController@index')->name('location');

    Route::any('locationListAddEditDelete', function (Illuminate\Http\Request $request) {
        return Modules\Location\Models\Location::dataOperation($request);
    })->name('locationListAddEditDelete');
});

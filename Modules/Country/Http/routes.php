<?php

Route::group(['middleware' => 'web', 'namespace' => 'Modules\Country\Http\Controllers'], function() {

    Route::any('country', 'CountryController@index')->name('country');

    Route::any('countryListAddEditDelete', function (Illuminate\Http\Request $request) {
        return Modules\Country\Models\Country::dataOperation($request);
    })->name('countryListAddEditDelete');
});

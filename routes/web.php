<?php

use Illuminate\Http\Request;

Route::get('admin', function () {
    return Redirect::route('admin_login');
});
Route::group(['prefix' => 'admin', 'as' => 'admin_'], function () {
    $this->get('login', 'AdminAuth\LoginController@showLoginForm')->name('login');
    $this->post('login', 'AdminAuth\LoginController@login')->name('submit_login');
    $this->post('logout', 'AdminAuth\LoginController@logout')->name('logout');

// Password Reset Routes...
    $this->get('password/reset', 'AdminAuth\ForgotPasswordController@showLinkRequestForm')->name('password_reset_get');
    $this->post('password/email', 'AdminAuth\ForgotPasswordController@sendResetLinkEmail')->name('password_email');
    $this->get('password/reset/{token}', 'AdminAuth\ResetPasswordController@showResetForm')->name('password_email_token');
    $this->post('password/reset', 'AdminAuth\ResetPasswordController@reset')->name('password_reset_post');
});

// Registration Routes...
$this->get('admin/register', 'AdminAuth\RegisterController@showRegistrationForm');
$this->post('admin/register', 'AdminAuth\RegisterController@register');

Route::get('register/verify/{confirmationCode}', [
    'as' => 'confirmation_path',
    'uses' => 'Auth\RegisterController@confirm'
]);

// usage inside a laravel route
Route::get('/liveImageCompression', function(Request $request) {
    try {
        $img = Image::make($request->path)->resize(1500, 500);
        return $img->response('jpg');
    } catch (Exception $e) {
        echo $e;
    }
})->name('liveImageCompression');

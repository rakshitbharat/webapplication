@extends('admin.auth.adminAuthLayout.layout')
@section('content')
<form class="login-form securityForm" role="form" method="POST" action="{!! route('admin_submit_login') !!}">
    {{ csrf_field() }}
    <h3 class="form-title">Login to your account</h3>
    @include('admin.flashMessage')
    @if (count($errors) > 0)
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
        {{ $error }}
        <br>
        @endforeach
    </div>
    @endif
    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
        <label class="control-label visible-ie8 visible-ie9">Username</label>
        <input class="form-control form-control-solid placeholder-no-fix" id="email" type="email" autocomplete="off" placeholder="Email" name="email" value="{{ old('email') }}" required /> 
    </div>
    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
        <label class="control-label visible-ie8 visible-ie9">Password</label>
        <input class="form-control form-control-solid placeholder-no-fix"  id="password" type="password" autocomplete="off" placeholder="Password"  name="password" required/>
    </div>
    <div class="form-actions">
        <label class="rememberme mt-checkbox mt-checkbox-outline">
            <input type="checkbox" name="remember"/> Keep Me Logged In
            <span></span>
        </label>
        <button type="submit" class="btn green pull-right"> Login </button>
        <h4><a href="{!! route('admin_password_reset_get') !!}" style="color: white;">Forgot password ?</a></h4>
    </div>
</form>
@endsection
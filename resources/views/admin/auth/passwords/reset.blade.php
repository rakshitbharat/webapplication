@extends('admin.auth.adminAuthLayout.layout')
@section('content')
<form role="form" class='securityForm' method="POST" action="{!! route('admin_password_reset_post') !!}">
    {{ csrf_field() }}
    <h3 class="form-title">Reset Password</h3>
    @include('admin.flashMessage')
    @if (count($errors) > 0)
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
        {{ $error }}
        <br>
        @endforeach
    </div>
    @endif
    <input type="hidden" name="token" value="{{ $token }}">

    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        <input id="email" type="email" class="form-control form-control-solid placeholder-no-fix" name="email" value="{{ $email or old('email') }}" placeholder='Email' required autofocus>
    </div>
    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
        <input class="form-control placeholder-no-fix" id="password" type="password" name="password" required autocomplete="off" placeholder="Password">
    </div>
    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
        <input class="form-control placeholder-no-fix" id="password-confirm" type="password" name="password_confirmation" required autocomplete="off" placeholder="Confirm Password">
    </div>
    <div class="form-actions">
        <button type="submit" class="btn green uppercase">Change Password</button>
    </div>
</form>
@endsection
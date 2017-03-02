@extends('admin.auth.adminAuthLayout.layout')
@section('content')
<form class="form-horizontal securityForm" role="form" method="POST" action="{!! route('admin_password_email') !!}" novalidate="novalidate" style="display: block;">
    {{ csrf_field() }}
    <h3 class="">Forget Password ?</h3>
    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif
    @if (count($errors) > 0)
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
        {{ $error }}
        <br>
        @endforeach
    </div>
    @endif
    <p> Enter your e-mail address below to reset your password. </p>
    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        <input id="email" type="email" class="form-control placeholder-no-fix" name="email" value="{{ old('email') }}" placeholder='Email' required>
    </div>
    <div class="form-actions">
        <!--<a href="{{ url('/password/reset') }}" id="forget-password-new" class="forget-password">Forgot Password?</a>-->
        <a href="{!! route('admin_login') !!}" id="back-btn" class="btn green btn-outline">Login</a>
        <button type="submit" class="btn btn-success uppercase pull-right">Submit</button>
    </div>
</form>
@endsection
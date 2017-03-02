@extends('admin.auth.adminAuthLayout.layout')
@section('content')
            <form method="post" action="{{ url('admin/register') }}" novalidate="novalidate">
                {{ csrf_field() }}
                <h3 class="font-green">Add Admin Account</h3>
                @include('admin.flashMessage')
                <p class="hint"> Enter your personal details below: </p>
                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label class="control-label visible-ie8 visible-ie9">Full Name</label>
                    {{ Form::text('name', null, ['class' => 'form-control placeholder-no-fix','placeholder' => 'Full Name']) }}
                    {{-- <input class="form-control placeholder-no-fix" type="text" placeholder="Full Name" name="name" value="{{ old('name') }}"> --}}
                </div>
                <input type="hidden" name="role" value="admin">
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                    <label class="control-label visible-ie8 visible-ie9">Email</label>
                    <input class="form-control placeholder-no-fix" id="email" type="email" placeholder='Email' name="email" value="{{ old('email') }}" required>
                </div>
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label class="control-label visible-ie8 visible-ie9">Password</label>
                    <input class="form-control placeholder-no-fix" id="password" type="password" name="password" required autocomplete="off" placeholder="Password">
                </div>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">Re-type Your Password</label>
                    <input class="form-control placeholder-no-fix" id="password-confirm" type="password" name="password_confirmation" required autocomplete="off" placeholder="Re-type Your Password"> </div>
                <div class="form-actions">
                    <a href="{!! route('admin_login') !!}" id="register-back-btn" class="btn green btn-outline">Login</a>
                    <button type="submit" id="register-submit-btn" class="btn btn-success uppercase pull-right">Submit</button>
                </div>
            </form>
@endsection
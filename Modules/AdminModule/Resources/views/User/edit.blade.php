@extends('admin.adminLayout')
@section('content')
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN SAMPLE FORM PORTLET-->
        <div class="box">
            <div class="box-header">
                <span class="caption-subject font-dark sbold uppercase"><strong>Edit {{ $title }}</strong></span>
            </div>
            <div class="box-body">
                <div class="tab-content">
                    <div class="form">
                        {{ Form::open(['route'=>['admin_usermanagement.update',$user->id],'role'=>'form','id'=>'myform','method' => 'PUT','novalidate'=>'novalidate','enctype'=>'multipart/form-data']) }}
                        <div class="form-body">
                            @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                            <div id="form-errors"></div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name='name' id="name" value='@if(old('name') == ''){{ $user->name }}@else{{ old('name') }}@endif'>
                                               <label for="form_control_1">Name</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name='email' id="email" value='@if(old('email') == ''){{ $user->email }}@else{{ old('email') }}@endif'>
                                               <label for="form_control_1">Email</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="password" class="form-control" name='password' id="password" value='{{ old('password') }}'>
                                        <label for="form_control_1">Password</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="password" class="form-control" name='password_confirmation' id="password-confirm">
                                        <label for="form_control_1">Confirm Password</label>
                                    </div>
                                </div>
                                <input type="hidden" id="confirmed" name='confirmed' value="{{ $user->confirmed }}">
                                <input type="hidden" id="role" name='role' value="admin">
                            </div>
                        </div>
                    </div>
                    <div class="form-actions noborder">
                        <button type="submit" class="btn blue">Save</button>
                        <a href="{!! route('admin_usermanagement.index') !!}" class="btn default">
                            <button type="button" class="btn btn-primary">Back</button>
                        </a>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
    <!-- END SAMPLE FORM PORTLET-->
</div>
@endsection
@section('javascript')
<script type="text/javascript">
    $(document).ready(function () {

        $('form#myform').validate({
            rules: {},
            messages: {},
            errorPlacement: function (error, element) {
                error.insertAfter(element);
            },
            submitHandler: function (form) {
                $.ajax({
                    type: "PUT",
                    url: "{{ route('admin_usermanagement.update', ['id' => $user->id]) }}",
                    data: $(form).serialize(),
                    success: function (data) {
                        window.location.href = "{!! route('admin_usermanagement.index') !!}";
                    },
                    error: function (jqXhr) {
                        if (jqXhr.status === 401)
                            $(location).prop('pathname', 'auth/login');
                        if (jqXhr.status === 422) {
                            var errors = jqXhr.responseJSON;
                            errorsHtml = '<div class="alert alert-danger"><ul>';
                            $.each(errors, function (key, value) {
                                errorsHtml += '<li>' + value[0] + '</li>';
                            });
                            errorsHtml += '</ul></di>';
                            $('#form-errors').html(errorsHtml);
                        } else {
                            $('#form-errors').html('');
                        }
                    }
                });
                return false;
            }
        });
    });
</script>
@endsection
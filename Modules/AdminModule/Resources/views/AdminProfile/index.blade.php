@extends('admin.adminLayout')
@section('content')
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN PROFILE CONTENT -->
        <div class="profile-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="portlet light ">
                        <div class="portlet-title tabbable-line">
                            <div class="caption caption-md">
                                <i class="icon-globe theme-font hide"></i>
                                <span class="caption-subject font-blue-madison bold uppercase">Edit Profile</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="tab-content">
                                {{ Form::open(['route'=>['admin_adminprofile_save'],'role'=>'form','id'=>'updateProfile','method' => 'POST','novalidate'=>'novalidate','enctype'=>'multipart/form-data']) }}
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
                                    <div id="form-errors-updateProfile"></div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group form-md-line-input form-md-floating-label has-success">
                                                <input type="text" class="form-control" name='name' id="name" value='{{ Auth::User()->name }}'>
                                                <label for="form_control_1">Name</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group form-md-line-input form-md-floating-label has-success">
                                                <input type="text" class="form-control" name='email' id="email" readonly="true" value='{{ Auth::User()->email }}'>
                                                <label for="form_control_1">Email</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="margiv-top-10">
                                    <button type="submit" class="btn green">Update</button>
                                </div>
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="portlet light ">
                        <div class="portlet-title tabbable-line">
                            <div class="caption caption-md">
                                <i class="icon-globe theme-font hide"></i>
                                <span class="caption-subject font-blue-madison bold uppercase">Change Password</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="tab-content">
                                {{ Form::open(['route'=>['admin_adminprofile_changepassword'],'role'=>'form','id'=>'changePassword','method' => 'POST','novalidate'=>'novalidate','enctype'=>'multipart/form-data']) }}
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
                                    <div id="form-errors-changePassword"></div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group form-md-line-input form-md-floating-label has-success">
                                                <input type="password" class="form-control" name='old_password' id="old_password" value=''>
                                                <label for="form_control_1">Old Password</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group form-md-line-input form-md-floating-label has-success">
                                                <input type="password" class="form-control" name='password' id="password" value=''>
                                                <label for="form_control_1">Password</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group form-md-line-input form-md-floating-label has-success">
                                                <input type="password" class="form-control" name='password_confirmation' id="password-confirm">
                                                <label for="form_control_1">Confirm Password</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="margiv-top-10">
                                    <button type="submit" class="btn green">Submit</button>
                                </div>
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END PROFILE CONTENT -->
        </div>
    </div>
    @endsection
    @section('javascript')
    <script type="text/javascript">
        $(document).ready(function () {
            $('form#changePassword').validate({
                rules: {},
                messages: {},
                errorPlacement: function (error, element) {
                    error.insertAfter(element);
                },
                submitHandler: function (form) {
                    $.ajax({
                        type: "POST",
                        url: $('form#changePassword').attr("action"),
                        data: $(form).serialize(),
                        success: function (data) {
                            $('#form-errors-changePassword').html('');
                            flashMessage('success', data['success']);
                            $('#changePassword')[0].reset();
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
                                $('#form-errors-changePassword').html(errorsHtml);
                            } else {
                                $('#form-errors-changePassword').html('');
                            }
                        }
                    });
                    return false;
                }
            });
            $('form#updateProfile').validate({
                rules: {},
                messages: {},
                errorPlacement: function (error, element) {
                    error.insertAfter(element);
                },
                submitHandler: function (form) {
                    $.ajax({
                        type: "POST",
                        url: $('form#updateProfile').attr("action"),
                        data: $(form).serialize(),
                        success: function (data) {
                            flashMessage('success', data['success']);
                            $('#form-errors-updateProfile').html('');
                            $('.LoggedInUserName').html(data.data['name']);
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
                                $('#form-errors-updateProfile').html(errorsHtml);
                            } else {
                                $('#form-errors-updateProfile').html('');
                            }
                        }
                    });
                    return false;
                }
            });
        });
    </script>
    @endsection

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>{{ config('app.name') }}</title>
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="{{asset('public/theme/assets/global/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('public/theme/assets/global/css/components.min.css')}}" rel="stylesheet" id="style_components" type="text/css" />
        <link href="{{asset('public/theme/assets/pages/css/login-4.min.css')}}" rel="stylesheet" type="text/css" />
        <link rel="shortcut icon" href="favicon.ico" />
        <style>
            span { 
                color: #e61405 !important;
            }
        </style>
    </head>
    <body class=" login">
        <div class="logo" style="margin: 60px auto 20px; padding: 15px; text-align: center; font-size: xx-large; color: azure;">
            {{ config('app.name') }}
        </div>
        <div class="content">
            @yield('content')
            <div class="copyright">{{ config('app.longName') }}</div>
        </div>
        <script src="{{asset('public/theme/assets/global/plugins/jquery.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('public/theme/assets/global/plugins/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('public/theme/assets/global/plugins/jquery-validation/js/jquery.validate.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('public/theme/assets/global/scripts/app.min.js')}}" type="text/javascript"></script>
        <script type="text/javascript">
$(function () {
    $('.securityForm').validate({
        errorClass: "authError",
        errorElement: "span",
        rules: {
            "email": {
                "required": true,
            },
            "password": {
                "required": true,
            }
        },
        messages: {
            "email": {
                "required": "Please enter email.",
            },
            "password": {
                "required": "Please enter password.",
            },
            "password_confirmation": {
                "required": "Please enter password confirmation.",
            }
        }
    });
});
        </script>
    </body>

</html>
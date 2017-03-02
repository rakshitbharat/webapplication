<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>dynamicTitle | @yield('title')</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        @include('admin.cssLink')
    </head>
    <body class="skin-blue fixed" data-spy="scroll" data-target="#scrollspy">
        <div class="wrapper">
            @include('admin.header')            
            @include('admin.sidebar') 
            <div class="content-wrapper">
                <div class="container">
                    <div class="content body">
                        @yield('content')
                    </div>
                </div>
            </div>
            @include('admin.footer')
        </div>
        @include('admin.jsLink')
    </body>
</html>
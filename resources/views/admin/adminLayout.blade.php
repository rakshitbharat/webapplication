<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>dynamicTitle | @yield('title')</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        @include('admin.cssLink')
    </head>
    <body class="skin-blue sidebar-mini" style="height: auto;">
        <div class="wrapper" style="height: auto;">
            @include('admin.header')        
            @include('admin.sidebar')       
            <div class="content-wrapper" style="min-height: 916px;">
                @yield('content')
            </div>
            @include('admin.footer')       
        </div>
        <div class="jvectormap-label"></div>
        @include('admin.jsLink')
    </body>
</html>
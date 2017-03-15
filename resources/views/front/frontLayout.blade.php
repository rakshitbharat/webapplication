<!DOCTYPE html>
<!--[if IE 8 ]><html class="no-js oldie ie8" lang="en"> <![endif]-->
<!--[if IE 9 ]><html class="no-js oldie ie9" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html class="no-js" lang="en"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <title>Timestart Infotech</title>
        <meta name="description" content="">  
        <meta name="author" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        @include('front.cssLink')
    </head>
    <body id="top">
        @include('front.header')
        @yield('content')
        @include('front.footer')
        @include('front.jsLink')
    </body>
</html>
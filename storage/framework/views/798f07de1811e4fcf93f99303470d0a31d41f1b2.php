<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>AdminLTE 2 | Log in</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="stylesheet" href="<?php echo e(asset('public/adminAsset/bootstrap/css/bootstrap.min.css')); ?>" >
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css " >
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css" >
        <link rel="stylesheet" href="<?php echo e(asset('public/adminAsset/dist/css/AdminLTE.min.css')); ?>" >
        <link rel="stylesheet" href="<?php echo e(asset('public/adminAsset/dist/css/skins/_all-skins.min.css')); ?>" >
        <link rel="stylesheet" href="<?php echo e(asset('public/adminAsset/style.css')); ?>" >
        <link rel="stylesheet" href="<?php echo e(asset('public/adminAsset/plugins/iCheck/square/blue.css')); ?>">
    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
            <?php echo $__env->yieldContent('content'); ?>
        </div>
        
        <script src="<?php echo e(asset('public/adminAsset/plugins/jQuery/jquery-2.2.3.min.js')); ?>" ></script>
        <script src="<?php echo e(asset('public/adminAsset/bootstrap/js/bootstrap.min.js')); ?>" ></script>
        <script src="<?php echo e(asset('public/adminAsset/plugins/fastclick/fastclick.min.js')); ?>" ></script>
        <script src="<?php echo e(asset('public/adminAsset/dist/js/app.min.js')); ?>" ></script>
        <script src="<?php echo e(asset('public/adminAsset/plugins/slimScroll/jquery.slimscroll.min.js')); ?>" ></script>
        <script src="<?php echo e(asset('public/adminAsset/plugins/iCheck/icheck.min.js')); ?>" ></script>
        
        <script>
            $(function () {
                $('input').iCheck({
                    checkboxClass: 'icheckbox_square-blue',
                    radioClass: 'iradio_square-blue',
                    increaseArea: '20%' // optional
                });
            });
        </script>
    </body>
</html>
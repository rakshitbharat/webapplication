<?php $__env->startSection('content'); ?>
<form class="login-form securityForm" role="form" method="POST" action="<?php echo route('admin_submit_login'); ?>">
    <?php echo e(csrf_field()); ?>

    <h3 class="form-title">Login to your account</h3>
    <?php echo $__env->make('admin.flashMessage', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php if(count($errors) > 0): ?>
    <div class="alert alert-danger">
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
        <?php echo e($error); ?>

        <br>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
    </div>
    <?php endif; ?>
    <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
        <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
        <label class="control-label visible-ie8 visible-ie9">Username</label>
        <input class="form-control form-control-solid placeholder-no-fix" id="email" type="email" autocomplete="off" placeholder="Email" name="email" value="<?php echo e(old('email')); ?>" required /> 
    </div>
    <div class="form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
        <label class="control-label visible-ie8 visible-ie9">Password</label>
        <input class="form-control form-control-solid placeholder-no-fix"  id="password" type="password" autocomplete="off" placeholder="Password"  name="password" required/>
    </div>
    <div class="form-actions">
        <label class="rememberme mt-checkbox mt-checkbox-outline">
            <input type="checkbox" name="remember"/> Keep Me Logged In
            <span></span>
        </label>
        <button type="submit" class="btn green pull-right"> Login </button>
        <h4><a href="<?php echo route('admin_password_reset_get'); ?>" style="color: white;">Forgot password ?</a></h4>
    </div>
</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.auth.adminAuthLayout.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
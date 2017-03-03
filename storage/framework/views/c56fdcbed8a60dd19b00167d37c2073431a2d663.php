<?php $__currentLoopData = session()->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>

<?php if($key == 'error'): ?>
<div class="msgBoxCont">
    <div class="alert alert-danger">
        <span><?php echo e($value); ?></span>
        <button class="close" data-close="alert"></button>
    </div>
</div>
<?php endif; ?>

<?php if($key == 'success'): ?>
<div class="msgBoxCont">
    <div class="alert alert-success" style="background-color: #6daf6d; color: #ffffff;">
        <span><?php echo e($value); ?></span>
        <button class="close" data-close="alert"></button>
    </div>
</div>
<?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
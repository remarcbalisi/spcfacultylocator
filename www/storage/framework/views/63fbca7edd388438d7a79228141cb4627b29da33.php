<?php $__env->startSection('content'); ?>
<div class="body"></div>

<div class="grad"></div>
<div class="header">
    <div>SPC<span> Faculty<br>Locator</span></div>
</div>
<br>
<div class="login">

    <?php if( Session::has( 'info' )): ?>
        <div class="alert-danger">
             <?php echo e(Session::get( 'info' )); ?> <!-- here to 'withWarning()' -->
        </div>

    <?php elseif($errors): ?>

        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
            <div class="alert-danger">
                <?php echo e($error); ?>

            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>

    <?php endif; ?>

    <form class="" method="post" action="<?php echo e(route('auth.login')); ?>">
        <?php echo e(csrf_field()); ?>

        <input type="text" placeholder="username" name="username"><br>
        <input type="password" placeholder="password" name="password"><br>
        <button type="submit" name="button">Login</button>
    </form>
    <!-- <a href="<?php echo e(route('index.create')); ?>"><button type="submit" name="button">I am a student!</button> </a> -->
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.login_base', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
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

    <?php elseif( Session::has( 'success' )): ?>
        <div class="alert-success">
             <?php echo e(Session::get( 'success' )); ?> <!-- here to 'withWarning()' -->
        </div>

    <?php elseif($errors): ?>

        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
            <div class="alert-danger">
                <?php echo e($error); ?>

            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>

    <?php endif; ?>

    <form class="" method="post" action="<?php echo e(route('index.store')); ?>">
        <?php echo e(csrf_field()); ?>

        <input type="text" placeholder="name" name="name"><br>
        <input type="text" placeholder="username" name="username"><br>
        <input type="text" placeholder="email" name="email"><br>
        <input type="password" placeholder="password" name="password"><br>
        <input type="hidden" name="type" value="student">
        <select name="department">
            <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                <option value="<?php echo e($department->id); ?>"><?php echo e($department->name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
        </select><br>
        <button type="submit" name="button">Send Registration Request</button>
    </form>
    <a href="<?php echo e(url('/')); ?>"><button type="submit" name="button">Back</button></a>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.login_base', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->startSection('content'); ?>

<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>FORMS <span class="glyphicon glyphicon-chevron-right"></span> ADD STUDENT</h2>
        </div>

        <!-- Input -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            STUDENT UPDATE
                            <small>Update user</small>
                        </h2>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">more_vert</i>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="javascript:void(0);">Action</a></li>
                                    <li><a href="javascript:void(0);">Another action</a></li>
                                    <li><a href="javascript:void(0);">Something else here</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="body">

                        <?php if( Session::has( 'info' )): ?>
                            <div class="alert alert-success alert-dismissible">
                                <strong>Well done!</strong> <?php echo e(Session::get( 'info' )); ?>

                            </div>

                        <?php elseif($errors): ?>

                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                <div class="alert alert-danger">
                                    <strong>Oh snap!</strong> <?php echo e($error); ?>

                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>

                        <?php endif; ?>

                        <?php if( old('name') ): ?>
                        <form class="" action="<?php echo e(route('admin::user.update', ['username'=>Auth::user()->username, 'id'=>$user->id])); ?>" method="post">
                            <?php echo e(csrf_field()); ?>

                            <?php echo method_field('put'); ?>

                            <input name="type" type="hidden" value="student">
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input name="name" type="text" value="<?php echo e(old('name')); ?>" class="form-control">
                                            <label class="form-label">Name</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input name="username" type="text" value="<?php echo e(old('username')); ?>" class="form-control">
                                            <label class="form-label">Username</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input name="email" type="text" value="<?php echo e(old('email')); ?>" class="form-control">
                                            <label class="form-label">Email</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input name="password" type="password" class="form-control">
                                            <label class="form-label">Password</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <select name="department" class="form-control show-tick">
                                        <option value="">-- Please select department --</option>
                                        <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                        <option value="<?php echo e($department->id); ?>"><?php echo e($department->name); ?> (<?php echo e($department->college); ?>)</option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                    </select>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <button class="btn btn-primary" type="submit" name="button">Update</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <?php else: ?>
                        <form class="" action="<?php echo e(route('admin::user.update', ['username'=>Auth::user()->username, 'id'=>$user->id])); ?>" method="post">
                            <?php echo e(csrf_field()); ?>

                            <?php echo method_field('put'); ?>

                            <input name="type" type="hidden" value="student">
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input name="name" type="text" value="<?php echo e($user->name); ?>" class="form-control">
                                            <label class="form-label">Name</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input name="username" type="text" value="<?php echo e($user->username); ?>" class="form-control">
                                            <label class="form-label">Username</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input name="email" type="text" value="<?php echo e($user->email); ?>" class="form-control">
                                            <label class="form-label">Email</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input name="password" type="password" class="form-control">
                                            <label class="form-label">Password</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <select name="department" class="form-control show-tick">
                                        <option value="">-- Please select department --</option>
                                        <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                        <option value="<?php echo e($department->id); ?>"><?php echo e($department->name); ?> (<?php echo e($department->college); ?>)</option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                    </select>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <button class="btn btn-primary" type="submit" name="button">Update</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Input -->

    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin_home_base', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
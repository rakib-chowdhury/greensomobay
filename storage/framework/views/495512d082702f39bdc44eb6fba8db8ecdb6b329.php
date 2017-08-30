<?php $__env->startSection('content'); ?>
    <!-- Info Content - Boxes Services-->
    <div class="content_info">
        <div class="padding-top padding-bottom-mini">
            <!-- Container Area - Boxes Services -->
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="panel panel-default">
                            <div class="panel-heading"><i class="fa fa-sign-in"></i> লগইন</div>
                            <div class="panel-body">
                                <form class="form-horizontal" role="form" method="POST" action="<?php echo e(route('login')); ?>">
                                    <?php echo e(csrf_field()); ?>

                                    <div class="text-center">
                                        <p style="color: peru">( অনুগ্রহপূর্বক মোবাইল নম্বর ও পাসওয়ার্ড ইংরেজিতে প্রদান করুন )</p>
                                    </div>

                                    <div class="form-group<?php echo e($errors->has('phone') ? ' has-error' : ''); ?>">
                                        <label for="phone" class="col-md-4 control-label">মোবাইল নম্বর</label>

                                        <div class="col-md-6">
                                            <input id="phone" type="text" class="form-control" name="phone" value="<?php echo e(old('phone')); ?>" required autofocus>

                                            <?php if($errors->has('phone')): ?>
                                                <span class="help-block">
                                        <strong><?php echo e('মোবাইল নম্বর অথবা পাসওয়ার্ড সঠিক নয়'); ?></strong>
                                    </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <div class="form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
                                        <label for="password" class="col-md-4 control-label">পাসওয়ার্ড</label>

                                        <div class="col-md-6">
                                            <input id="password" type="password" class="form-control" name="password" required>

                                            <?php if($errors->has('password')): ?>
                                                <span class="help-block">
                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                    </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-8 col-md-offset-4">
                                            <button type="submit" class="btn btn-primary">
                                                লগইন
                                            </button>

                                            <a class="btn btn-link" href="<?php echo e(route('password.request')); ?>">
                                                পাসওয়ার্ড পুনরুদ্ধার
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Container Area - Boxes Services -->
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.public', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
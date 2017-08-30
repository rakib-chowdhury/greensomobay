<?php $__env->startSection('specifiedCss'); ?>

<?php $__env->stopSection(); ?>
<?php 
$bn_digits = array('০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯');
 ?>
<?php $__env->startSection('content'); ?>
    <section>
        <div class="card">
            <div class="card-body">
                <?php echo $__env->make('includes.flashMessage', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <div class="alert alert-callout alert-success "><b class="text-lg">প্রকল্প</b>
                    <button type="button" data-toggle="modal" data-target="#addBranch"
                            class="btn btn-sm btn-success pull-right"><i class="fa fa-plus"></i> প্রকল্প সংযোজন করুন
                    </button>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <tr>
                            <th>#</th>
                            <th>নাম</th>
                            <th>ধরণ</th>
                            <th>অবস্থা</th>
                            <th>অ্যাকশন</th>
                        </tr>
                        <?php if(empty($prokolpos)): ?>
                            <h3 class="text-danger">No Branches</h3>
                        <?php else: ?>
                            <?php $number = 0; ?>
                            <?php $__currentLoopData = $prokolpos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prokolpo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e(str_replace(range(0,9),$bn_digits,++$number)); ?></td>
                                    <td class="text-bold"><?php echo e($prokolpo->name); ?></td>
                                    <td>
                                        <?php if($prokolpo->type==1): ?>
                                            <span class="label label-info">সঞ্চয়</span>
                                        <?php else: ?>
                                            <span class="label label-primary">ঋণ / উত্তোলন</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if($prokolpo->status==1): ?>
                                            <span class="label label-success">Active</span>
                                        <?php else: ?>
                                            <span class="label label-danger">Blocked</span>
                                        <?php endif; ?>
                                    </td>

                                    <td>
                                        <a data-toggle="modal" data-target="#editProkolpo<?php echo e($prokolpo->id); ?>"
                                           class="btn btn-xs btn-info"><i class="fa fa-edit"></i> সংশোধন</a>
                                        <a href="<?php echo e(url('/admin/prokolpo/'.$prokolpo->id.'/delete')); ?>"
                                           class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> বাতিল</a>

                                        <!-----------------------------------------------
                                        * prokolpo edit modal
                                        *----------------------------------------------->
                                        <div class="modal fade" id="editProkolpo<?php echo e($prokolpo->id); ?>" tabindex="-1"
                                             role="dialog" aria-labelledby="myModalLabel">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header padding">
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close"><span
                                                                    aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title" id="myModalLabel"><i
                                                                    class="fa fa-indent"></i> প্রকল্প সংশোধন</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="<?php echo e(url('/admin/prokolpo/update')); ?>" method="post">
                                                            <?php echo e(csrf_field()); ?>

                                                            <input type="hidden" name="id" value="<?php echo e($prokolpo->id); ?>">
                                                            <div class="form-group <?php echo e($errors->has('name')?'has-error':''); ?>">
                                                                <label for="name">প্রকল্প নাম</label>
                                                                <input type="text" class="form-control"
                                                                       value="<?php echo e($prokolpo->name); ?>" name="name" id="name"
                                                                       required>
                                                            </div>
                                                            <div class="form-group <?php echo e($errors->has('type')?'has-error':''); ?>">
                                                                <label for="type">ধরণ </label><br>&nbsp;&nbsp;&nbsp;&nbsp;
                                                                <input required <?php if($prokolpo->type==1): ?><?php echo e('checked'); ?><?php endif; ?> type="radio" name="type" value="1">&nbsp;&nbsp;সঞ্চয়&nbsp;&nbsp;&nbsp;&nbsp;
                                                                <input required <?php if($prokolpo->type==2): ?><?php echo e('checked'); ?><?php endif; ?> type="radio" name="type" value="2">&nbsp;&nbsp;ঋণ/উত্তোলন
                                                            </div>
                                                            <div class="form-group">
                                                                <button type="submit" class="btn btn-success btn-sm"><i
                                                                            class="fa fa-database"></i> সংশোধন করুন
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> <!-- /end modal for store branch -->
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </table>
                </div>
                <!-----------------------------------------------
                 * prokolpo Add modal
                 *----------------------------------------------->
                <div class="modal fade" id="addBranch" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header padding">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                            aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-indent"></i> প্রকল্প সংযোজন</h4>
                            </div>
                            <div class="modal-body">
                                <form action="<?php echo e(url('/admin/prokolpo/store')); ?>" method="post">
                                    <?php echo e(csrf_field()); ?>

                                    <div class="form-group <?php echo e($errors->has('name')?'has-error':''); ?>">
                                        <label for="name">প্রকল্প নাম</label>
                                        <input type="text" class="form-control" name="name" id="name" required>
                                    </div>
                                    <div class="form-group <?php echo e($errors->has('type')?'has-error':''); ?>">
                                        <label for="type">ধরণ </label><br>
                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                        <input required type="radio" name="type" value="1">&nbsp;&nbsp;সঞ্চয়&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input required type="radio" name="type" value="2">&nbsp;&nbsp;ঋণ/উত্তোলন
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success btn-sm"><i
                                                    class="fa fa-database"></i> সংযোজন করুন
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div> <!-- /end modal for store branch -->
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('specifiedJs'); ?>
    <script type="text/javascript" src="<?php echo e(url('public')); ?>/js/libs/selectize/selectize.min.js"></script>
    <script type="text/javascript" src="<?php echo e(url('public')); ?>/js/libs/form-validation/validate.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#division').selectize();
            $('#district').selectize();
            $('#subDistrict').selectize();

            $('.division').selectize();
            $('.district').selectize();
            $('.subDistrict').selectize();
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
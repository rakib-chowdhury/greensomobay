<?php $__env->startSection('specifiedCss'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php 
    $bn_digits = array('০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯');
     ?>
    <section>
        <div class="card">
            <div class="card-body">
                <?php echo $__env->make('includes.flashMessage', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <div class="alert alert-callout alert-success "><b class="text-lg">কর্মচারীবৃন্দ</b>
                    <a href="<?php echo e(url('/admin/employee/create')); ?>" class="btn btn-sm btn-success pull-right"><i
                                class="fa fa-plus"></i> কর্মচারী সংযোজন করুন</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <tr>
                            <th>#</th>
                            <th>ছবি</th>
                            <th>আইডি নং</th>
                            <th>নাম</th>
                            
                            <th>মোবাইল নং</th>
                            <th>শাখা</th>
                            <th>পদবী</th>
                            <th style="width: 10%">সফটওয়্যার অ্যাডমিন</th>
                            <th >অ্যাকশন</th>
                        </tr>
                        <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e(str_replace(range(0,9),$bn_digits,($k+1))); ?></td>
                                <td><img style="height: 50px; width: 50px;"
                                         src="<?php echo e(url('public/img/employee/'.$employee->pic)); ?>" alt="no img"></td>
                                <td><?php echo e(str_replace(range(0,9),$bn_digits,$employee->id_card_no)); ?></td>
                                <td><?php echo e($employee->name); ?></td>
                                
                                <td><?php echo e(str_replace(range(0,9),$bn_digits,$employee->mobile)); ?></td>
                                <td><?php echo e($employee->hasBranch->name); ?></td>
                                <td><?php echo e($employee->hasDesignation->name); ?></td>
                                <td style="width: 10%"><?php echo e($employee->hasRole->name); ?></td>
                                <td style="width: 21%">
                                    <a href="<?php echo e(url('admin/employee/'.$employee->id.'/details')); ?>" class="btn btn-xs btn-success"><i class="fa fa-eye"></i> দেখুন</a>
                                    <a href="<?php echo e(url('admin/employee/'.$employee->id.'/edit')); ?>" class="btn btn-xs btn-info"><i class="fa fa-edit"></i> সংশোধন</a>
                                    <a href="<?php echo e(url('/admin/employee/'.$employee->id.'/delete')); ?>"
                                       class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> বাতিল</a>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </table>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('specifiedJs'); ?>
    <script type="text/javascript" src="<?php echo e(url('public')); ?>/js/libs/form-validation/validate.min.js"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
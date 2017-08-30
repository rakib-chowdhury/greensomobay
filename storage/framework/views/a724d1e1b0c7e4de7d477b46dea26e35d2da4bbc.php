<?php $__env->startSection('specifiedCss'); ?>
    <link rel="stylesheet" href="<?php echo e(url('public')); ?>/css/selectize/selectize.css" type="text/css">
    <link rel="stylesheet" href="<?php echo e(url('public')); ?>/css/datepicker/bootstrap-datepicker.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php 
    $bn_digits = array('০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯');
     ?>
    <section>
        <div class="card">
            <div class="card-body">
                <?php echo $__env->make('includes.flashMessage', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <div class="alert alert-callout alert-success "><b class="text-lg">বেতন রিপোর্ট</b>
                    <?php if(session('role')==1): ?>
                        <a href="<?php echo e(url('admin/add_salary')); ?>" class="btn btn-sm btn-success pull-right"><i
                                    class="fa fa-plus"></i> বেতন সংযোজন করুন</a>
                    <?php endif; ?>
                </div>
                <form action="<?php echo e(url('admin/salary')); ?>" method="post">
                    <?php echo e(csrf_field()); ?>

                    <div class="row">
                        <div class="col-sm-4 form-group <?php echo e($errors->has('prokolpo')?'has-error':''); ?>">
                            <label for="branch" class="col-sm-2"
                                   style="padding-top: 9px;">শাখা</label>
                            <div class="col-sm-10">
                                <select required name="branch" class="form-control-select select-class"
                                        id="branch" style="padding-top: 9px">
                                    <?php if(empty($branch)): ?>
                                        <option value="">No Branch</option>
                                    <?php else: ?>
                                        <?php $__currentLoopData = $branch; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option <?php if($crr_brnch==$row->id): ?> <?php echo e('selected'); ?> <?php endif; ?> value="<?php echo e($row->id); ?>"><?php echo e($row->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4 form-group <?php echo e($errors->has('startDate')?'has-error':''); ?>">
                            <label for="startDate" class="col-sm-2" style="padding-top: 9px">মাস</label>
                            <div class="col-sm-10">
                                <input readonly type="text" class=" form-control dateInput" name="startDate"
                                       id="startDate" placeholder="মাস" value="<?php echo e($crr_mnth); ?>">
                                <?php echo $__env->make('errors.formValidateError',['inputName' => 'startDate'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            </div>
                        </div>
                        <div class="col-sm-2 form-group" style="text-align: center">
                            <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-database"></i>
                                অনুসন্ধান
                            </button>
                        </div>
                        <div class="col-sm-2 form-group " style="text-align: center">
                            <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-file-pdf-o"></i>
                                পি.ডি.এফ
                            </button>
                        </div>
                    </div>
                </form>

                <div class="table-responsive">
                    <table class="table table-striped">
                        <tr>
                            <th>#</th>
                            <th>ছবি</th>
                            <th>নাম</th>
                            <th>পদবী</th>
                            <th>মোবাইল নং</th>
                            <th>মূল বেতন</th>
                            <th>উপস্থিতি</th>
                            <th>মোট</th>
                            <th>অ্যাকশন</th>
                        </tr>
                        <?php if(sizeof($page_info)==0): ?>
                            <tr>
                                <td colspan="8">কোনো তথ্য নেই</td>
                            </tr>
                        <?php else: ?>
                            <?php $__currentLoopData = $page_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(sizeof($row->hasEmployee)!=0): ?>
                                    <tr>
                                        <td><?php echo e(str_replace(range(0,9),$bn_digits,$k+1)); ?></td>
                                        <td><img style="height: 50px; width: 50px;"
                                                 src="<?php echo e(url('public/img/employee/'.$row->hasEmployee['pic'])); ?>" alt="">
                                        </td>
                                        <td><?php echo e($row->hasEmployee['name']); ?></td>
                                        <td><?php echo e($row->hasEmployee['name']); ?></td>
                                        <td><?php echo e(str_replace(range(0,9),$bn_digits,$row->hasEmployee['mobile'])); ?></td>
                                        <td><?php echo e(str_replace(range(0,9),$bn_digits,$row->hasEmployee['basic_salary'])); ?></td>
                                        <td><?php echo e(str_replace(range(0,9),$bn_digits,$row->attendence)); ?></td>
                                        <td><?php echo e(str_replace(range(0,9),$bn_digits,$row->attendence)); ?></td>
                                        <td>
                                            <a class="btn btn-xs btn-success"><i class="fa fa-eye"></i> দেখুন</a>
                                            <a class="btn btn-xs btn-info"><i class="fa fa-edit"></i> সংশোধন</a>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </table>
                </div>
                <hr>
            </div>
        </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('specifiedJs'); ?>
    <script type="text/javascript" src="<?php echo e(url('public')); ?>/js/libs/selectize/selectize.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="<?php echo e(url('public')); ?>/js/libs/datepicker/bootstrap-datepicker.js"></script>
    <script>
        $(function () {
            $(".dateInput").datepicker({
                format: "yyyy-mm"
            });
            $('.select-class').selectize();
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
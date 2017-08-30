<?php $__env->startSection('specifiedCss'); ?>
    <link rel="stylesheet" href="<?php echo e(url('public')); ?>/css/selectize/selectize.css" type="text/css">
    <link rel="stylesheet" href="<?php echo e(url('public')); ?>/css/datepicker/bootstrap-datepicker.css">
<?php $__env->stopSection(); ?>
<?php 
$bn_digits = array('০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯');
 ?>
<?php $__env->startSection('content'); ?>
    <section>
        <div class="card">
            <div class="card-body">
                <?php echo $__env->make('includes.flashMessage', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <div class="alert alert-callout alert-success "><b class="text-lg">ঋণ ও সার্ভিস চার্জ আদায়</b>
                </div>
                <form action="<?php echo e(url('admin/collect_loan')); ?>" method="post">
                    <?php echo e(csrf_field()); ?>

                    <div class="row">
                        <div class="col-md-3 form-group">
                            <label for="loan_date">তারিখ</label>
                            <input type="text" name="loan_date" value="<?php echo e(date('m/d/Y')); ?>" id="loan_date"
                                   class="form-control">
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tr>
                                <th>#</th>
                                <th>ছবি</th>
                                <th>নাম</th>
                                <th>ঠিকানা</th>
                                <th>ঋণ</th>
                                <th>সার্ভিস চার্জ</th>
                                <th>ঋণ বীমা</th>
                            </tr>
                            <?php if(sizeof($member)==0): ?>
                                <tr>
                                    <td colspan="7">কোনো তথ্য নেই</td>
                                </tr>
                            <?php else: ?>
                                <?php $__currentLoopData = $member; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <input type="hidden" name="mem_id[]" value="<?php echo e($row->id); ?>">
                                    <tr>
                                        <td><?php echo e(str_replace(range(0,9),$bn_digits,$key+1)); ?></td>
                                        <td><img style="width: 60px; height: 60px;"
                                                 src="<?php echo e(url('public/img/member/'.$row->hasMember->pic)); ?>" alt="">
                                        </td>
                                        <td><?php echo e($row->hasMember->name); ?></td>
                                        <td><?php echo e($row->hasMember->hasMemberDetails->hasCurrDivision->name.', '.$row->hasMember->hasMemberDetails->hasCurrDistrict->bn_name.', '.$row->hasMember->hasMemberDetails->hasCurrUpz->bn_name.', '.$row->hasMember->hasMemberDetails->current_postoffice.', '.$row->hasMember->hasMemberDetails->current_location); ?></td>
                                        <td>
                                            <?php if(sizeof($row->hasMember->hasTransaction)==0): ?>
                                                <input type="text" class="form-control" name="loan_amount[]">
                                            <?php else: ?>
                                                <input type="text" class="form-control" name="loan_amount[]" value="<?php echo e($row->hasMember->hasTransaction[0]->debit); ?>">
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if(sizeof($row->hasMember->hasTransaction)==0): ?>
                                                <input type="text" class="form-control" name="service_charge[]">
                                            <?php else: ?>
                                                <input type="text" class="form-control" name="service_charge[]" value="<?php echo e($row->hasMember->hasTransaction[1]->debit); ?>">
                                            <?php endif; ?>

                                        </td>
                                        <td>
                                            <?php if(sizeof($row->hasMember->hasTransaction)==0): ?>
                                                <input type="text" class="form-control" name="loan_insurance[]">
                                            <?php else: ?>
                                                <input type="text" class="form-control" name="loan_insurance[]" value="<?php echo e($row->hasMember->hasTransaction[2]->debit); ?>">
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </table>
                    </div>
                    <div class="row">
                        <div class="form-group text-center">
                            <button class="btn btn-raised btn-rounded btn-success">সংরক্ষণ করুন</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('specifiedJs'); ?>
    <script type="text/javascript" src="<?php echo e(url('public')); ?>/js/libs/selectize/selectize.min.js"></script>
    <script type="text/javascript" src="<?php echo e(url('public')); ?>/js/libs/datepicker/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="<?php echo e(url('public')); ?>/js/libs/form-validation/validate.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#loan_date').datepicker();
        });

        function check_price(id) {
            var tmp_num = $('#' + id).val().getDigitEnglishFromBangla();
            if (tmp_num == null || isNaN(tmp_num)) {
                var x = document.getElementById(id);
                x.value = x.value.replace(/[^0-9]/, '');
            }
        }
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
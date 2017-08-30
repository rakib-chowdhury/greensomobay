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
                <div class="alert alert-callout alert-success "><b class="text-lg">সঞ্চয় আদায়</b>
                </div>
                <form action="<?php echo e(url('admin/collect_deposit')); ?>" method="post">
                    <?php echo e(csrf_field()); ?>

                    <div class="row">
                        <div class="col-md-3 form-group">
                            <label for="deposit_date">তারিখ</label>
                            <input required readonly type="text" name="deposit_date" id="deposit_date"
                                   class="form-control" value="<?php echo e(date('m/d/Y')); ?>">
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tr>
                                <th>#</th>
                                <th>ছবি</th>
                                <th>নাম</th>
                                <th>ঠিকানা</th>
                                
                                <th>আজকের জমা</th>
                                <th>সঞ্চয় ধরণ</th>
                            </tr>
                            <?php if(sizeof($member)==0): ?>
                                <tr>
                                    <td colspan="7">কোনো তথ্য নেই</td>
                                </tr>
                            <?php else: ?>
                                <?php $__currentLoopData = $member; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e(str_replace(range(0,9),$bn_digits,$key+1)); ?></td>
                                        <td><img style="width: 60px; height: 60px;"
                                                 src="<?php echo e(url('public/img/member/'.$row->hasMember->pic)); ?>" alt="">
                                        </td>
                                        <td><?php echo e($row->hasMember->name); ?></td>
                                        <td><?php echo e($row->hasMember->hasMemberDetails->hasCurrDivision->name.', '.$row->hasMember->hasMemberDetails->hasCurrDistrict->bn_name.', '.$row->hasMember->hasMemberDetails->hasCurrUpz->bn_name.', '.$row->hasMember->hasMemberDetails->current_postoffice.', '.$row->hasMember->hasMemberDetails->current_location); ?></td>
                                        
                                        <td>
                                            <input type="hidden" name="mem_id[]" value="<?php echo e($row->member_id); ?>">
                                            <?php if(sizeof($row->hasMember->hasTransaction)==0): ?>
                                                <input onkeyup="check_price(this.id)" onblur="check_price(this.id)"
                                                       type="text" class="form-control"
                                                       id="deposit_amount_<?php echo e($row->member_id); ?>" name="deposit_amount[]">
                                            <?php else: ?>
                                                <input onkeyup="check_price(this.id)" onblur="check_price(this.id)"
                                                       type="text" class="form-control"
                                                       value="<?php echo e($row->hasMember->hasTransaction[0]->debit); ?>"
                                                       id="deposit_amount_<?php echo e($row->member_id); ?>" name="deposit_amount[]">
                                            <?php endif; ?>

                                        </td>
                                        <td>
                                            <?php $__currentLoopData = $deposit_type; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key2=>$dt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <input
                                                        <?php if (sizeof($row->hasMember->hasTransaction) == 0) {
                                                            if ($key2 == 1) {
                                                                echo 'checked';
                                                            }
                                                        } else {
                                                            if ($row->hasMember->hasTransaction[0]->sub_group_id == $key2 + 1) {
                                                                echo 'checked';
                                                            }
                                                        }?>
                                                        type="radio"
                                                        name="depositType_<?php echo e($row->member_id); ?>"
                                                        value="<?php echo e($dt->id); ?>"> <?php echo e($dt->name); ?>

                                                &nbsp;&nbsp;
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
            $('#deposit_date').datepicker();
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
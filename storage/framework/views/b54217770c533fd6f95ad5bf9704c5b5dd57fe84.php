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
                <div class="alert alert-callout alert-success "><b class="text-lg"><?php echo e($page_title); ?></b>
                </div>
                <div class="">
                    <form action="<?php echo e(url('admin/expense')); ?>" method="post">
                        <?php echo e(csrf_field()); ?>

                        <div class="row">
                            <!--date-->
                            <div class="col-sm-4 form-group <?php echo e($errors->has('share_date')?'has-error':''); ?>">
                                <label for="share_date"><span
                                            style="color: red; font-size: 16px;">* </span>তারিখ</label>

                                <input readonly type="text" class="form-control share_date" name="share_date"
                                       id="date" value="<?php echo e(date('m-d-Y')); ?>" required>
                                <?php echo $__env->make('errors.formValidateError',['inputName' => 'share_date','msg'=>'আবশ্যক'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                            </div>
                            <!--sdmission fee-->
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-sm-offset-0 form-group table-responsive">
                                <table id="member_admission_table" class="table table-bordered">
                                    <tr>
                                        <td style="width: 5%; text-align: center">#</td>
                                        <td style="width: 25%; text-align: center">ধরণ</td>
                                        <td style="text-align: center">বিবরণ</td>
                                        <td style="width: 15%; text-align: center">টাকা</td>
                                        <td style="width:5%">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>১</td>
                                        <td>
                                            <select name="sub_account_group[]" id="sub_account_group_0" class="form-control-select select-class" required>
                                                <?php if(sizeof($sub_acc_type)==0): ?>
                                                    <option value="">কোনো তথ্য নেই</option>
                                                <?php else: ?>
                                                    <?php $__currentLoopData = $sub_acc_type; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($row->id); ?>"><?php echo e($row->name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>
                                            </select>
                                        </td>
                                        <td>
                                            <textarea name="description[]" required class="form-control"></textarea>
                                        </td>
                                        <td>
                                            <input onkeyup="checkPrice(this.id)" onblur="checkPrice(this.id)" type="text" name="amount[]" id="amount_0" class="form-control" required>
                                        </td>
                                        <td>
                                            <button type="button" id="add_other_fee" class="btn btn-success btn-raised"><span
                                                        class="fa fa-plus-circle"></span>
                                            </button>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-database"></i> সংযোজন
                                করুন
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('specifiedJs'); ?>
    <script type="text/javascript" src="<?php echo e(url('public')); ?>/js/libs/selectize/selectize.min.js"></script>
    <script type="text/javascript" src="<?php echo e(url('public')); ?>/js/libs/datepicker/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="<?php echo e(url('public')); ?>/js/libs/form-validation/validate.min.js"></script>
    <script>
        var childNum = 0;
        var indexC = 1;

        function checkPrice(id) {
            var tmp_num = $('#' + id).val().getDigitEnglishFromBangla();
            if (tmp_num == null || isNaN(tmp_num)) {
                var x = document.getElementById(id);
                x.value = x.value.replace(/[^0-9.]/, '');
            }
        }

        function reorderTable() {
            $('#member_admission_table tr').each(function (i,v) {
                if(i!=0){
                    $(this).find('td:nth-child(1)').text((i+'').getDigitBanglaFromEnglish());
                }
            });
        }

        function rmv(id) {
            $('#' + id).remove();
            indexC--;
            reorderTable();
        }

        $(document).ready(function () {
            $('.share_date').datepicker();

            $('.select-class').selectize();

            $('#amount').keyup(function () {
                checkPrice('amount');
            }).blur(function () {
                checkPrice('amount');
            });

            $('#add_other_fee').click(function () {
                childNum++; indexC++;
                var trow = '<tr id="' + childNum + '">'
                        + '<td>'+(indexC+'').getDigitBanglaFromEnglish()+'</td>'
                        + '<td><select required id="sub_account_group_' + childNum + '" type="text" name="sub_account_group[]" class="select-class form-control">'
                        + '<?php if (sizeof($sub_acc_type) == 0) {
                            echo '<option value="">কোনো তথ্য নেই</option>';
                        } else {
                            foreach ($sub_acc_type as $row) {
                                echo '<option value="' . $row->id . '">' . $row->name . '</option>';
                            }
                        }?></select></td>'
                        + '<td><textarea required name="description[]" class="form-control"></textarea></td>'
                        + '<td><input required onkeyup="checkPrice(this.id)" onblur="checkPrice(this.id)" id="amount_' + childNum + '" type="text" name="amount[]" class="form-control"></td>'
                        + '<td><button onclick="rmv(' + childNum + ')" class="btn btn-danger btn-rounded">-</button></td>'
                        + '</tr>';
                $('#member_admission_table tr:last').after(trow);

                $('#sub_account_group_'+childNum).selectize();
            });
        });

    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
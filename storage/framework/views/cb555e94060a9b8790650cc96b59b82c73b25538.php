<?php $__env->startSection('specifiedCss'); ?>
    <link rel="stylesheet" href="<?php echo e(url('public')); ?>/css/selectize/selectize.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css"/>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php 
    $bn_digits = array('০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯');
     ?>
    <section>
        <div class="card">
            <div class="card-body">
                <?php echo $__env->make('includes.flashMessage', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <div class="alert alert-callout alert-success "><b class="text-lg">সঞ্চয় রিপোর্ট</b>
                </div>
                <div class="row">
                    <form action="<?php echo e(url('admin/report/depositReportPdf')); ?>" method="post">
                        <?php echo e(csrf_field()); ?>

                        <div class="col-sm-3 form-group <?php echo e($errors->has('d_date')?'has-error':''); ?>"
                             style="padding-left: 0px; padding-right: 0px;">
                            <label for="d_date" class="col-sm-2" style="padding-top: 9px">তারিখ</label>
                            <div class="col-sm-10">
                                <input type="text" name="d_date" value="<?php echo e($d_date); ?>" id="d_date"
                                       placeholder="তারিখ শুরু" class="form-control"/>
                                <?php echo $__env->make('errors.formValidateError',['inputName' => 'd_date','msg'=>'আবশ্যক'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            </div>
                        </div>

                        <div class="col-sm-2 form-group <?php echo e($errors->has('prokolpo')?'has-error':''); ?>"
                             style="padding-left: 0px; padding-right: 0px;">
                            <label for="prokolpo" class="col-sm-3"
                                   style="padding-top: 9px;">প্রকল্প</label>
                            <div class="col-sm-9">
                                <select required name="prokolpo" class="form-control-select select-class"
                                        id="prokolpo">
                                    <option <?php if($prokolpo=='all'): ?> <?php echo e('selected'); ?> <?php endif; ?> value="all">সকল</option>
                                    <?php if(empty($prokolpoList)): ?>
                                        <option value="">No prokolpo</option>
                                    <?php else: ?>
                                        <?php $__currentLoopData = $prokolpoList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option <?php if($prokolpo==$row->id): ?> <?php echo e('selected'); ?> <?php endif; ?> value="<?php echo e($row->id); ?>"><?php echo e($row->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-2 form-group <?php echo e($errors->has('branch_id')?'has-error':''); ?>"
                             style="padding-left: 0px; padding-right: 0px;">
                            <label for="branch_id" class="col-sm-3"
                                   style="padding-top: 9px;">শাখা</label>
                            <div class="col-sm-9">
                                <select required name="branch_id" class="form-control-select select-class"
                                        id="branch_id">
                                    <option <?php if($branch=='all'): ?> <?php echo e('selected'); ?> <?php endif; ?> value="all">সকল</option>
                                    <?php if(empty($branchList)): ?>
                                        <option value="">No branch</option>
                                    <?php else: ?>
                                        <?php $__currentLoopData = $branchList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option <?php if($branch==$row->id): ?> <?php echo e('selected'); ?> <?php endif; ?> value="<?php echo e($row->id); ?>"><?php echo e($row->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-3 form-group <?php echo e($errors->has('member_id')?'has-error':''); ?>"
                             style="padding-left: 0px; padding-right: 0px;">
                            <label for="member_id" class="col-sm-2"
                                   style="padding-top: 9px;">সদস্য</label>
                            <div id="memBER" class="col-sm-10">
                                <select required name="member_id" class="form-control-select select-class"
                                        id="member_id">
                                    <?php if(sizeof($memberList)==0): ?>
                                        <option value="">কোনো সদস্য নেই</option>
                                    <?php else: ?>
                                        <option <?php if($member=='all'): ?> <?php echo e('selected'); ?> <?php endif; ?> value="all">সকল</option>
                                        <?php $__currentLoopData = $memberList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option <?php if($member==$row->id): ?> <?php echo e('selected'); ?> <?php endif; ?> value="<?php echo e($row->id); ?>"><?php echo e($row->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-1 form-group " style="padding-left: 0px;">
                            <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-search"></i>
                                অনুসন্ধান
                            </button>
                        </div>
                        <div class="col-sm-1 form-group " style="padding-left: 0px;">
                            <a href=""><button type="submit" class="btn btn-success btn-sm"><i class="fa fa-search"></i>
                                পি ডি এফ
                            </button>
                        </div>
                    </form>

                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <tr>
                            <th>#</th>
                            <th>তারিখ</th>
                            <th>নাম</th>
                            <th>ঠিকানা</th>
                            <th>মোবাইল নং</th>
                            <th>শাখা</th>
                            <th>প্রকল্প</th>
                            
                            
                            <th>সঞ্চয়</th>
                            <th></th>
                        </tr>
                        <?php if(sizeof($page_data)==0): ?>
                            <?php echo e('কোনো তথ্য নেই'); ?>

                        <?php else: ?>
                            <?php $__currentLoopData = $page_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e(str_replace(range(0,9),$bn_digits,$key+1)); ?></td>
                                    <td><?php echo e(str_replace(range(0,9),$bn_digits,$row->transaction_date)); ?></td>
                                    <td><a target="_blank" href="<?php echo e(url('admin/member/depositReport/'.$row->member_id.'/details')); ?>"><?php echo e($row->hasMember->name); ?></a></td>
                                    <td><?php echo e($row->hasMember->hasMemberDetails->current_location); ?>

                                        , <?php echo e($row->hasMember->hasMemberDetails->current_postoffice); ?>

                                        , <?php echo e($row->hasMember->hasMemberDetails->hasCurrUpz->bn_name); ?>

                                        , <?php echo e($row->hasMember->hasMemberDetails->hasCurrDistrict->bn_name); ?>

                                        , <?php echo e($row->hasMember->hasMemberDetails->hasCurrDivision->name); ?></td>
                                    <td><?php echo e(str_replace(range(0,9),$bn_digits,$row->hasMember->phone)); ?></td>
                                    <td><?php echo e($row->hasMember->hasBranch->name); ?></td>
                                    <td><?php echo e($row->hasSubGroup->name); ?></td>
                                    
                                    
                                    <td style="text-align: right;"><?php echo e(str_replace(range(0,9),$bn_digits,$row->debit)); ?>

                                        টাকা
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td colspan="7"></td>
                                <td style="text-align: right;"><?php echo e(str_replace(range(0,9),$bn_digits,$page_data->sum('debit'))); ?>

                                    টাকা
                                </td>
                            </tr>
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
    <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
    <script type="text/javascript">
        $(function () {
            $('input[name="d_date"]').daterangepicker({
                locale: {
                    format: 'YYYY/MM/DD'
                }
            });

            $(".select-class").selectize();
        });

        $('#branch_id').change(function () {
            $.ajax({
                url: '<?php echo e(url('admin/getMemeberAjax')); ?>',
                type: 'get',
                data: {
                    branch: $(this).val()
                }, success: function (res) {
                    $('#memBER').html('');

                    var trow = '<select required name="member_id" class="form-control-select select-class" id="member_id">'
                    if (res.length == 0) {
                        trow += '<option value="">কোনো সদস্য নেই</option>';
                    } else {
                        trow += '<option value="all">সকল</option>';
                        $.each(res, function (i, v) {
                            trow += '<option value="'+v["id"]+'">'+v["name"]+'</option>';
                        });
                        trow += '</select>';
                    }
                    $('#memBER').append(trow);
                    $('#member_id').selectize();
                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
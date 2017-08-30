<?php $__env->startSection('specifiedCss'); ?>
    <link rel="stylesheet" href="<?php echo e(url('public')); ?>/css/style-dashboard.css" type="text/css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php 
    $bn_digits = array('০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯');
     ?>
    <div class="container dash-container">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-4 col-sm-6 download-form">
                    <div class="panel panel-hover dash-panel" style="background: #1ABC9C">
                        <i class="fa fa-archive" aria-hidden="true"></i>
                        <div class="bubbles">৯</div>
                        <a href="" class="dash-titles">
                            আজকের জমা
                        </a>

                    </div>
                </div>
                <div class="col-md-4 col-sm-6 download-form">
                    <div class="panel panel-hover dash-panel" style="background: #FB6E52">
                        <i class="fa fa-archive" aria-hidden="true"></i>

                        <div class="bubbles ">১০০০০০৯</div>
                        <a href="" class="dash-titles">
                            ঋণ বিতরণ
                        </a>

                    </div>
                </div>
                <?php if(session('role')==1): ?>
                <div class="col-md-4 col-sm-6 download-form">
                    <div class="panel panel-hover dash-panel" style="background: #11A7DB">
                        <i class="fa fa-archive" aria-hidden="true"></i>
                        <div class="bubbles "><?php echo e(str_replace(range(0,9),$bn_digits,sizeof($applied_member))); ?></div>
                        <a href="<?php echo e(url('admin/member/lists/new')); ?>" class="dash-titles">
                            আবেদনকৃত সদস্য
                        </a>

                    </div>
                </div>
                <?php endif; ?>
                <?php if(session('role')==2 || session('role')==3): ?>
                <div class="col-md-4 col-sm-6 download-form">
                    <div class="panel panel-hover dash-panel" style="background: #11A7DB">
                        <i class="fa fa-archive" aria-hidden="true"></i>
                        <div class="bubbles "><?php echo e(str_replace(range(0,9),$bn_digits,sizeof($new_member))); ?></div>
                        <a href="<?php echo e(url('admin/member/lists/New')); ?>" class="dash-titles">
                            নতুন সদস্য
                        </a>

                    </div>
                </div>
                <?php endif; ?>
                <div class="col-md-4 col-sm-6 download-form">
                    <div class="panel panel-hover dash-panel" style="background: #435059">
                        <i class="fa fa-archive" aria-hidden="true"></i>

                        <div class="bubbles ">৯</div>
                        <a href="" class="dash-titles">
                            শেয়ার বিক্রি
                        </a>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 download-form">
                    <div class="panel panel-hover dash-panel" style="background: #DE291E">
                        <i class="fa fa-archive" aria-hidden="true"></i>


                        <div class="bubbles ">৯</div>
                        <a href="" class="dash-titles">
                            ব্যালেন্স শীট
                        </a>

                    </div>
                </div>
                <div class="col-md-4 col-sm-6 download-form">
                    <div class="panel panel-hover dash-panel" style="background: #ED675B">
                        <i class="fa fa-archive" aria-hidden="true"></i>

                        <div class="bubbles ">৯</div>

                        <a href="" class="dash-titles">
                            পণ্য বিক্রয়
                        </a>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 download-form">
                    <div class="panel panel-hover dash-panel" style="background: #0B5F6A">
                        <i class="fa fa-archive" aria-hidden="true"></i>

                        <div class="bubbles ">৯</div>

                        <a href="" class="dash-titles">
                            সার্ভিস চার্জ
                        </a>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 download-form">
                    <div class="panel panel-hover dash-panel" style="background: #B378D3">
                        <i class="fa fa-archive" aria-hidden="true"></i>

                        <div class="bubbles"><?php echo e(str_replace(range(0,9),$bn_digits,sizeof($total_employee))); ?></div>
                        <a href="<?php echo e(url('admin/employee')); ?>" class="dash-titles">
                            কর্মকর্তা কর্মচারী
                        </a>

                    </div>
                </div>
                <div class="col-md-4 col-sm-6 download-form">
                    <div class="panel panel-hover dash-panel" style="background: #370624">
                        <i class="fa fa-archive" aria-hidden="true"></i>

                        <div class="bubbles ">৯</div>
                        <a href="" class="dash-titles">
                            টাইটেল ৯
                        </a>
                    </div>
                </div>

            </div><!-- /row -->
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->startSection('specifiedCss'); ?>
    <link rel="stylesheet" href="<?php echo e(url('public')); ?>/css/selectize/selectize.css" type="text/css">
    <link rel="stylesheet" href="<?php echo e(url('public')); ?>/css/datatable/dataTables.bootstrap.min.css">
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
                <div class="table-responsive">
                    <table id="dynamicTable" class="table table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>ছবি</th>
                            <th>রেজিস্ট্রেশন নন্বর</th>
                            <th>নাম</th>
                            <th>জাতীয় পরিচয়পত্র নং</th>
                            <th>মোবাইল নং</th>
                            <th>শাখা</th>
                            <th>অ্যাকশন</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e(str_replace(range(0,9),$bn_digits,($k+1))); ?></td>
                                <td><img style="height: 50px; width: 50px;"
                                         src="<?php echo e(url('public/img/member/'.$row->pic)); ?>" alt="no img"></td>
                                <td><?php echo e(str_replace(range(0,9),$bn_digits,$row->registration_no)); ?></td>
                                <td><?php echo e($row->name); ?></td>
                                <td><?php echo e(str_replace(range(0,9),$bn_digits,$row->nid)); ?></td>
                                <td><?php echo e(str_replace(range(0,9),$bn_digits,$row->phone)); ?></td>
                                <td><?php echo e($row->hasBranch->name); ?></td>
                                <td>
                                    <a style="margin-top: 0px;"
                                       href="<?php echo e(url('admin/member/'.$type.'/'.$row->id.'/details')); ?>"
                                       class="btn btn-xs btn-info"><i class="fa fa-eye"></i> দেখুন</a>
                                    
                                    <?php if($type=='new' || $type=='block'): ?>
                                        <a style="margin-top: 0px;"
                                           href="<?php echo e(url('/admin/member/'.$type.'/'.$row->id.'/approved')); ?>"
                                           class="btn btn-xs btn-success"><i class="fa fa-check"></i> অনুমোদন</a>
                                    <?php endif; ?>
                                    <?php if($type=='new'): ?>
                                        <a style="margin-top: 0px;"
                                           href="<?php echo e(url('/admin/member/'.$type.'/'.$row->id.'/reject')); ?>"
                                           class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> বাতিল</a>
                                    <?php elseif($type=='approved'): ?>
                                        <a style="margin-top: 0px;"
                                           href="<?php echo e(url('/admin/member/'.$type.'/'.$row->id.'/block')); ?>"
                                           class="btn btn-xs btn-accent-dark"><i class="fa fa-ban"></i> ব্লক করুন</a>
                                    <?php endif; ?>

                                    <?php if($type=='New'): ?>
                                        <?php if($row->status==7): ?>
                                            <a href="<?php echo e(url('/admin/member_admission/'.$row->id)); ?>" style="margin-top: 0px;"
                                               class="btn btn-xs btn-success"><i
                                                        class="fa fa-plus"></i> সদস্য ভর্তি করুন</a>
                                        <?php elseif($row->status==6): ?>
                                            <a data-toggle="modal" data-target="#empModal<?php echo e($row->id); ?>"
                                               style="margin-top: 0px; cursor: pointer"
                                               class="btn btn-xs btn-primary"><i
                                                        class="fa fa-user"></i> কর্মচারী নিযুক্ত করুন</a>
                                        <?php endif; ?>

                                    <?php endif; ?>
                                </td>
                            </tr>
                            <!-----------------------------------------------
                             * assign member to field worker modal
                             *----------------------------------------------->
                            <?php if($row->status==6): ?>
                                <div class="modal fade" id="empModal<?php echo e($row->id); ?>" tabindex="-1"
                                     role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header padding">
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close"><span
                                                            aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myModalLabel"><i
                                                            class="fa fa-indent"></i> কর্মচারী নিযুক্ত করণ</h4>
                                            </div>
                                            <div class="modal-body">
                                                <form action="<?php echo e(url('/admin/member/assign/employee')); ?>" method="post">
                                                    <?php echo e(csrf_field()); ?>

                                                    <input type="hidden" name="member_id" value="<?php echo e($row->id); ?>">
                                                    <div class="form-group <?php echo e($errors->has('name')?'has-error':''); ?>">
                                                        <label for="name">কর্মচারী নাম</label>
                                                        <select readonly name="emp_id"
                                                                class="form-control-select emp">
                                                            <?php if(empty($employees)): ?>
                                                                <option value="">কর্মচারী নেই</option>
                                                            <?php else: ?>
                                                                <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $emp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <option value="<?php echo e($emp->id); ?>"><?php echo e($emp->name.'('.str_replace(range(0,9),$bn_digits,$emp->mobile).')'); ?></option>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            <?php endif; ?>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-success btn-sm"><i
                                                                    class="fa fa-database"></i> নিযুক্ত করুন
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- /end modal for store branch -->
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('specifiedJs'); ?>
    <script type="text/javascript" src="<?php echo e(url('public')); ?>/js/libs/selectize/selectize.min.js"></script>
    <script type="text/javascript" src="<?php echo e(url('public')); ?>/js/libs/datatable/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="<?php echo e(url('public')); ?>/js/libs/datatable/dataTables.bootstrap.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#dynamicTable').DataTable({
                "ordering": false
            });

            $('.emp').selectize();
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
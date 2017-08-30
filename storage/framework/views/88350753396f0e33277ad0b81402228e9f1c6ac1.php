<?php $__env->startSection('specifiedCss'); ?>
    <link rel="stylesheet" href="<?php echo e(url('public')); ?>/css/selectize/selectize.css" type="text/css">
<?php $__env->stopSection(); ?>
<?php 
$bn_digits = array('০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯');
 ?>
<?php $__env->startSection('content'); ?>
    <section>
        <div class="card">
            <div class="card-body">
                <?php echo $__env->make('includes.flashMessage', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <div class="alert alert-callout alert-success "><b class="text-lg">শাখা</b>
                    <button type="button" data-toggle="modal" data-target="#addBranch"
                            class="btn btn-sm btn-success pull-right"><i class="fa fa-plus"></i> শাখা সংযোজন করুন
                    </button>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <tr>
                            <th>#</th>
                            <th>নাম</th>
                            <th>বিভাগ</th>
                            <th>জেলা</th>
                            <th>উপজেলা</th>
                            <th>এলাকা</th>
                            <th>ম্যানেজার</th>
                            <th>কর্মচারী</th>
                            <th>অ্যাকশন</th>
                        </tr>
                        <?php if(empty($branches)): ?>
                            <h3 class="text-danger">No Branches</h3>
                        <?php else: ?>
                            <?php $number = 0; ?>
                            <?php $__currentLoopData = $branches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e(str_replace(range(0,9),$bn_digits,++$number)); ?></td>
                                    <td class="text-bold"><?php echo e($branch->name); ?></td>
                                    <td><?php echo e($branch->division['name']); ?></td>
                                    <td><?php echo e($branch->district['bn_name']); ?></td>
                                    <td><?php echo e($branch->subDistrict['bn_name']); ?></td>
                                    <td><?php echo e($branch->specified_location); ?></td>
                                    <td>-</td>
                                    <td>0</td>
                                    <td>
                                        <a  class="btn btn-xs btn-success"><i class="fa fa-eye"></i> দেখুন</a>
                                        <a data-toggle="modal" data-target="#editBranch<?php echo e($branch->id); ?>"
                                           class="btn btn-xs btn-info"><i class="fa fa-edit"></i> সংশোধন</a>
                                        <a href="<?php echo e(url('/admin/branch/'.$branch->id.'/delete')); ?>"
                                           class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> বাতিল</a>

                                        <!-----------------------------------------------
                                        * branch edit modal
                                        *----------------------------------------------->
                                        <div class="modal fade" id="editBranch<?php echo e($branch->id); ?>" tabindex="-1"
                                             role="dialog" aria-labelledby="myModalLabel">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header padding">
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close"><span
                                                                    aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title" id="myModalLabel"><i
                                                                    class="fa fa-indent"></i> শাখা সংশোধন</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="<?php echo e(url('/admin/branch/update')); ?>" method="post">
                                                            <?php echo e(csrf_field()); ?>

                                                            <input type="hidden" name="id" value="<?php echo e($branch->id); ?>">
                                                            <div class="form-group <?php echo e($errors->has('name')?'has-error':''); ?>">
                                                                <label for="name">শাখা নাম</label>
                                                                <input type="text" class="form-control"
                                                                       value="<?php echo e($branch->name); ?>" name="name" id="name"
                                                                       required>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-4 form-group <?php echo e($errors->has('division')?'has-error':''); ?>">
                                                                    <label for="division">বিভাগ</label>
                                                                    <select readonly name="division"
                                                                            class="form-control-select division" >
                                                                        <?php if(empty($divisions)): ?>
                                                                            <option value="">No division</option>
                                                                        <?php else: ?>
                                                                            <option value="<?php echo e($divisions->id); ?>"><?php echo e($divisions->name); ?></option>
                                                                        <?php endif; ?>
                                                                    </select>
                                                                </div>
                                                                <div class="col-sm-4 form-group <?php echo e($errors->has('district')?'has-error':''); ?>">
                                                                    <label for="district">জেলা</label>
                                                                    <select readonly class="form-control-select district"
                                                                            name="district" id="">
                                                                        <?php if(empty($districts)): ?>
                                                                            <option value="">No district</option>
                                                                        <?php else: ?>
                                                                            <option value="<?php echo e($districts->id); ?>"><?php echo e($districts->bn_name); ?></option>
                                                                        <?php endif; ?>
                                                                    </select>
                                                                </div>
                                                                <div class="col-sm-4 form-group <?php echo e($errors->has('subDistrict')?'has-error':''); ?>">
                                                                    <label for="district">উপজেলা</label>
                                                                    <select class="form-control-select subDistrict"
                                                                            name="subDistrict" id="">
                                                                        <?php if(empty($upazillas)): ?>
                                                                            <option value="">No district</option>
                                                                        <?php else: ?>
                                                                            <?php $__currentLoopData = $upazillas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $upazilla): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                <?php if($branch->subDistrict_id==$upazilla->id): ?>
                                                                                    <option selected
                                                                                            value="<?php echo e($upazilla->id); ?>"><?php echo e($upazilla->bn_name); ?></option>
                                                                                <?php else: ?>
                                                                                    <option value="<?php echo e($upazilla->id); ?>"><?php echo e($upazilla->bn_name); ?></option>
                                                                                <?php endif; ?>
                                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                        <?php endif; ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group <?php echo e($errors->has('specified')?'has-error':''); ?>">
                                                                <label for="specified">বিস্তারিত </label>
                                                                <textarea name="specified" id="specified"
                                                                          class="form-control"><?php echo e($branch->specified_location); ?></textarea>
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
                 * branch Add modal
                 *----------------------------------------------->
                <div class="modal fade" id="addBranch" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header padding">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                            aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-indent"></i> শাখা সংযোজন</h4>
                            </div>
                            <div class="modal-body">
                                <form action="<?php echo e(url('/admin/store')); ?>" method="post">
                                    <?php echo e(csrf_field()); ?>

                                    <div class="form-group <?php echo e($errors->has('name')?'has-error':''); ?>">
                                        <label for="name">শাখা নাম</label>
                                        <input type="text" class="form-control" name="name" id="name" required>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4 form-group <?php echo e($errors->has('division')?'has-error':''); ?>">
                                            <label for="division">বিভাগ</label>
                                            <select readonly name="division" class="form-control-select" id="division">
                                                <?php if(empty($divisions)): ?>
                                                    <option value="">No division</option>
                                                <?php else: ?>
                                                    <option value="<?php echo e($divisions->id); ?>"><?php echo e($divisions->name); ?></option>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-4 form-group <?php echo e($errors->has('district')?'has-error':''); ?>">
                                            <label for="district">জেলা</label>
                                            <select readonly class="form-control-select" name="district" id="district">
                                                <?php if(empty($districts)): ?>
                                                    <option value="">No district</option>
                                                <?php else: ?>
                                                    <option value="<?php echo e($districts->id); ?>"><?php echo e($districts->bn_name); ?></option>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                        <div class="col-sm-4 form-group <?php echo e($errors->has('subDistrict')?'has-error':''); ?>">
                                            <label for="district">উপজেলা</label>
                                            <select class="form-control-select" name="subDistrict" id="subDistrict">
                                                <?php if(empty($upazillas)): ?>
                                                    <option value="">No district</option>
                                                <?php else: ?>
                                                    <?php $__currentLoopData = $upazillas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $upazilla): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($upazilla->id); ?>"><?php echo e($upazilla->bn_name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group <?php echo e($errors->has('specified')?'has-error':''); ?>">
                                        <label for="specified">বিস্তারিত </label>
                                        <textarea name="specified" id="specified" class="form-control"></textarea>
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
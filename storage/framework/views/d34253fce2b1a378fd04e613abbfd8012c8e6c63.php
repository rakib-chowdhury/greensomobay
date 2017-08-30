<?php $__env->startSection('customCss'); ?>
    <link rel="stylesheet" href="<?php echo e(url('public')); ?>/css/selectize/selectize.css" type="text/css">
    <link rel="stylesheet" href="<?php echo e(url('public')); ?>/css/edit-image/iEdit.css">
    <link rel="stylesheet" href="<?php echo e(url('public')); ?>/css/datepicker/bootstrap-datepicker.css">
    <style>
        .input-group .form-control-select {
            margin-bottom: -6px
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content_info content_area_main">
        <div class="container">
            <div class="paddings-mini">
                <?php echo $__env->make('includes.flashMessage', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        <!--form title-->
                <div class="form-title title-vertical-line">
                    <h2><b>সদস্য ভর্তি ফর্ম</b></h2>
                </div>
                <div class="paddings-mini"></div>
                <!--form CONTENT-->
                <div class="form-content">
                    <form id="memberAdmitFrom" action="<?php echo e(url('/member_admission')); ?>" method="post" enctype="multipart/form-data">
                        <?php echo e(csrf_field()); ?>

                                <!--applicant name , profession-->
                        <div class="row">
                            <!-- applicant name -->
                            <div class="form-group col-sm-6 <?php echo e($errors->has('applierName') ? 'has-error' : ''); ?>">
                                <div class="row">
                                    <div class="col-sm-4 text-right">
                                        <label for="applierName"><span style="color: red;">* </span>আবেদনকারীর
                                            নাম</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="applierName" name="applierName" value="<?php echo e(old('applierName')); ?>"
                                               placeholder="নাম" required>
                                        <?php echo $__env->make('errors.formValidateError', ['inputName' => 'applierName','msg'=>'আবশ্যক'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                    </div>
                                </div>
                            </div><!-- /end single form input -->
                            <!-- applicant porfession -->
                            <div class="form-group col-sm-6 <?php echo e($errors->has('applierOccupation') ? 'has-error' : ''); ?>">
                                <div class="row">
                                    <div class="col-sm-4 text-right">
                                        <label for="applierOccupation"><span style="color: red;">* </span>আবেদনকারীর
                                            পেশা</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="applierOccupation" value="<?php echo e(old('applierOccupation')); ?>"
                                               name="applierOccupation" placeholder="পেশা" required>
                                        <?php echo $__env->make('errors.formValidateError', ['inputName' => 'applierOccupation','msg'=>'আবশ্যক'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                    </div>
                                </div>
                            </div><!-- /end single form input -->
                        </div>
                        <hr>
                        <!--father name, profession--->
                        <div class="row">
                            <!-- father name -->
                            <div class="form-group col-sm-6 <?php echo e($errors->has('guardianName') ? 'has-error' : ''); ?>">
                                <div class="row">
                                    <div class="col-sm-4 text-right">
                                        <label for="guardianName"><span style="color: red;">* </span>পিতা/স্বামীর
                                            নাম</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="guardianName" name="guardianName" value="<?php echo e(old('guardianName')); ?>"
                                               placeholder="পিতা/স্বামী" required>
                                        <?php echo $__env->make('errors.formValidateError', ['inputName' => 'guardianName','msg'=>'আবশ্যক'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                    </div>
                                </div>
                            </div><!-- /end single form input -->
                            <!-- father profession -->
                            <div class="form-group col-sm-6 <?php echo e($errors->has('guardianOccupation') ? 'has-error' : ''); ?>">
                                <div class="row">
                                    <div class="col-sm-4 text-right">
                                        <label for="guardianOccupation"><span style="color: red;">* </span>পিতা/স্বামীর
                                            পেশা</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="guardianOccupation"
                                               name="guardianOccupation" value="<?php echo e(old('guardianOccupation')); ?>" placeholder="পেশা" required>
                                        <?php echo $__env->make('errors.formValidateError', ['inputName' => 'guardianOccupation','msg'=>'আবশ্যক'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                    </div>
                                </div>
                            </div><!-- /end single form input -->
                        </div>
                        <hr>
                        <!--mother name , profesion-->
                        <div class="row">
                            <!-- mother name -->
                            <div class="form-group col-sm-6 <?php echo e($errors->has('motherName') ? 'has-error' : ''); ?>">
                                <div class="row">
                                    <div class="col-sm-4 text-right">
                                        <label for="motherName"><span style="color: red;">* </span>মাতার নাম</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="motherName" name="motherName" value="<?php echo e(old('motherName')); ?>"
                                               placeholder="মাতা" required>
                                        <?php echo $__env->make('errors.formValidateError', ['inputName' => 'motherName','msg'=>'আবশ্যক'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                    </div>
                                </div>
                            </div><!-- /end single form input -->
                            <!-- profession -->
                            <div class="form-group col-sm-6 <?php echo e($errors->has('motherOccupation') ? 'has-error' : ''); ?>">
                                <div class="row">
                                    <div class="col-sm-4 text-right">
                                        <label for="motherOccupation"><span style="color: red;">* </span>মাতার
                                            পেশা</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="motherOccupation"
                                               name="motherOccupation" value="<?php echo e(old('motherOccupation')); ?>" placeholder="পেশা" required>
                                        <?php echo $__env->make('errors.formValidateError', ['inputName' => 'motherOccupation','msg'=>'আবশ্যক'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                    </div>
                                </div>
                            </div><!-- /end single form input -->
                        </div>
                        <hr>
                        <!--present address-->
                        <div class="row">
                            <div class="col-sm-2 text-right">
                                <label for="currentAddress"><span style="color: red;">* </span>বর্তমান ঠিকানা</label>
                            </div>
                            <div class="col-sm-10">
                                <div class="row">
                                    <!--village-->
                                    <div class="col-sm-8 form-group <?php echo e($errors->has('location') ? 'has-error' : ''); ?>">
                                        <div class="input-group">
                                            <label for="location" class="location-label input-group-addon">গ্রাম</label>
                                            <input type="text" class="form-control" name="location" value="<?php echo e(old('location')); ?>" id="location"
                                                   placeholder="গ্রাম" required>
                                            <?php echo $__env->make('errors.formValidateError',['inputName' => 'location','msg'=>'আবশ্যক'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                        </div>
                                    </div>
                                    <!--post office-->
                                    <div class="col-sm-4 form-group <?php echo e($errors->has('postalLocation') ? 'has-error' : ''); ?>">
                                        <div class="input-group">
                                            <label for="postalLocation" class="location-label input-group-addon">ডাকঘর</label>
                                            <input type="text" class="form-control" name="postalLocation" value="<?php echo e(old('postalLocation')); ?>"
                                                   id="postalLocation" placeholder="ডাকঘর" required>
                                            <?php echo $__env->make('errors.formValidateError',['inputName' => 'postalLocation','msg'=>'আবশ্যক'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                        </div>
                                    </div>
                                    <!--division-->
                                    <div class="col-sm-4 form-group <?php echo e($errors->has('division') ? 'has-error' : ''); ?>">
                                        <div class="input-group">
                                            <label for="division" class="location-label input-group-addon">বিভাগ</label>
                                            <select required name="division" class="form-control-select select-class"
                                                    id="division">
                                                <?php if(empty($divisions)): ?>
                                                    <option value="">No division</option>
                                                <?php else: ?>
                                                    <?php $__currentLoopData = $divisions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $division): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option <?php if(old('division')==$division->id): ?> <?php echo e('selected'); ?> <?php endif; ?> value="<?php echo e($division->id); ?>"><?php echo e($division->name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>
                                            </select>
                                            <?php echo $__env->make('errors.formValidateError',['inputName' => 'division','msg'=>'আবশ্যক'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                        </div>
                                    </div>
                                    <!--district-->
                                    <div id="dist"
                                         class="col-sm-4 form-group <?php echo e($errors->has('district') ? 'has-error' : ''); ?>">
                                        <div class="input-group">
                                            <label for="district" class="location-label input-group-addon">জেলা</label>
                                            <select onchange="getUpz(this.id)" required name="district" id="district"
                                                    class="form-control-select select-class">
                                                <?php if(empty($districts)): ?>
                                                    <option value="">No division</option>
                                                <?php else: ?>
                                                    <?php $__currentLoopData = $districts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $district): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option <?php if(old('district')==$district->id): ?> <?php echo e('selected'); ?> <?php endif; ?> value="<?php echo e($district->id); ?>"><?php echo e($district->bn_name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>
                                            </select>
                                            <?php echo $__env->make('errors.formValidateError',['inputName' => 'district','msg'=>'আবশ্যক'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                        </div>
                                    </div>
                                    <!--upazilla-->
                                    <div id="upZ"
                                         class="col-sm-4 form-group <?php echo e($errors->has('thana') ? 'has-error' : ''); ?>">
                                        <div class="input-group">
                                            <label for="thana" class="location-label input-group-addon">উপজেলা</label>
                                            <select name="thana" id="thana" class="form-control-select select-class"
                                                    required>
                                                <?php if(empty($upz)): ?>
                                                    <option value="">No upazilla</option>
                                                <?php else: ?>
                                                    <?php $__currentLoopData = $upz; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option <?php if(old('thana')==$u->id): ?> <?php echo e('selected'); ?> <?php endif; ?> value="<?php echo e($u->id); ?>"><?php echo e($u->bn_name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>
                                            </select>
                                            <?php echo $__env->make('errors.formValidateError',['inputName' => 'thana','msg'=>'আবশ্যক'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <!--parmannt address--->
                        <div class="row">
                            <div class="col-sm-2 text-right">
                                <label for="permanentAddress"><span style="color: red;">* </span>স্থায়ী ঠিকানা</label>
                            </div>
                            <div class="col-sm-10">
                                <div class="row">
                                    <!--village-->
                                    <div class="col-sm-8 form-group <?php echo e($errors->has('permanentLocation') ? 'has-error' : ''); ?>">
                                        <div class="input-group">
                                            <label for="permanentLocation" class="location-label input-group-addon">গ্রাম</label>
                                            <input type="text" class="form-control" name="permanentLocation" value="<?php echo e(old('permanentLocation')); ?>"
                                                   id="permanentLocation" placeholder="গ্রাম" required>
                                            <?php echo $__env->make('errors.formValidateError',['inputName' => 'permanentLocation','msg'=>'আবশ্যক'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                        </div>
                                    </div>
                                    <!--post office-->
                                    <div class="col-sm-4 form-group <?php echo e($errors->has('permanentPostal') ? 'has-error' : ''); ?>">
                                        <div class="input-group">
                                            <label for="permanentPostal"
                                                   class="location-label input-group-addon">ডাকঘর</label>
                                            <input type="text" class="form-control" name="permanentPostal" value="<?php echo e(old('permanentPostal')); ?>"
                                                   id="permanentPostal" placeholder="ডাকঘর" required>
                                            <?php echo $__env->make('errors.formValidateError',['inputName' => 'permanentPostal','msg'=>'আবশ্যক'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                        </div>
                                    </div>
                                    <!--division--->
                                    <div class="col-sm-4 form-group <?php echo e($errors->has('permanentDivision') ? 'has-error' : ''); ?>">
                                        <div class="input-group">
                                            <label for="permanentDivision" class="location-label input-group-addon">বিভাগ</label>
                                            <select name="permanentDivision" class="form-control-select select-class"
                                                    id="permanentDivision" required>
                                                <?php if(empty($divisions)): ?>
                                                    <option value="">No division</option>
                                                <?php else: ?>
                                                    <?php $__currentLoopData = $divisions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $division): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option <?php if(old('permanentDivision')==$division->id): ?> <?php echo e('selected'); ?> <?php endif; ?> value="<?php echo e($division->id); ?>"><?php echo e($division->name); ?></option>
                                                        <option value="">dss</option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>
                                            </select>
                                            <?php echo $__env->make('errors.formValidateError',['inputName' => 'permanentDivision','msg'=>'আবশ্যক'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                        </div>
                                    </div>
                                    <!--district--->
                                    <div id="pDist" class="col-sm-4 form-group <?php echo e($errors->has('permanentDistrict') ? 'has-error' : ''); ?>">
                                        <div class="input-group">
                                            <label for="permanentDistrict"
                                                   class="location-label input-group-addon">জেলা</label>
                                            <select onchange="getUpzP(this.id)" name="permanentDistrict" id="permanentDistrict"
                                                    class="form-control-select select-class" required>
                                                <?php if(empty($districts)): ?>
                                                    <option value="">No division</option>
                                                <?php else: ?>
                                                    <?php $__currentLoopData = $districts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $district): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option <?php if(old('permanentDistrict')==$district->id): ?> <?php echo e('selected'); ?> <?php endif; ?> value="<?php echo e($district->id); ?>"><?php echo e($district->bn_name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>
                                            </select>
                                            <?php echo $__env->make('errors.formValidateError',['inputName' => 'permanentDistrict','msg'=>'আবশ্যক'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                        </div>
                                    </div>
                                    <!--upazilla-->
                                    <div id="pUpz" class="col-sm-4 form-group <?php echo e($errors->has('permanentThana') ? 'has-error' : ''); ?>">
                                        <div class="input-group">
                                            <label for="permanentThana"
                                                   class="location-label input-group-addon">উপজেলা</label>
                                            <select name="permanentThana" id="permanentThana"
                                                    class="form-control-select select-class" required>
                                                <?php if(empty($upz)): ?>
                                                    <option value="">No upazilla</option>
                                                <?php else: ?>
                                                    <?php $__currentLoopData = $upz; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option <?php if(old('permanentThana')==$u->id): ?> <?php echo e('selected'); ?> <?php endif; ?> value="<?php echo e($u->id); ?>"><?php echo e($u->bn_name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>
                                            </select>
                                            <?php echo $__env->make('errors.formValidateError',['inputName' => 'permanentThana','msg'=>'আবশ্যক'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <!--dob, gender-->
                        <div class="row">
                            <!-- dob -->
                            <div class="form-group col-sm-6 <?php echo e($errors->has('birthDate') ? 'has-error' : ''); ?>">
                                <div class="row">
                                    <div class="col-sm-4 text-right">
                                        <label for="birthDate">জন্ম তারিখ</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input readonly type="text" class="form-control" id="birthDate" name="birthDate"
                                               value="<?php echo e(old('birthDate')); ?>">
                                        <?php echo $__env->make('errors.formValidateError', ['inputName' => 'birthDate','msg'=>'আবশ্যক'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                    </div>
                                </div>
                            </div><!-- /end single form input -->
                            <!-- gender -->
                            <div class="form-group col-sm-6 <?php echo e($errors->has('gender')?'has-error':''); ?>">
                                <div class="row">
                                    <div class="col-sm-4 text-right">
                                        <label for="gender"><span style="color: red;">* </span>লিঙ্গ</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input required <?php if(old('gender')=="পুরুষ"): ?><?php echo e('checked'); ?><?php endif; ?>  type="radio" class="" name="gender" value="পুরুষ">&nbsp;পুরুষ &nbsp;&nbsp;&nbsp;
                                        <input required <?php if(old('gender')=="মহিলা"): ?><?php echo e('checked'); ?><?php endif; ?> type="radio" class="" name="gender" value="মহিলা">&nbsp;মহিলা
                                        <?php echo $__env->make('errors.formValidateError',['inputName' => 'gender','msg'=>'আবশ্যক'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                    </div>
                                </div>
                            </div><!-- /end single form input -->
                        </div>
                        <hr>
                        <!--NATIOnality, religion -->
                        <div class="row">
                            <!-- nationality-->
                            <div class="form-group col-sm-6 <?php echo e($errors->has('nationalism') ? 'has-error' : ''); ?>">
                                <div class="row">
                                    <div class="col-sm-4 text-right">
                                        <label for="nationalism"><span style="color: red;">* </span>জাতীয়তা</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="nationalism" name="nationalism"
                                               value="<?php echo e(old('nationalism')); ?>" placeholder="জাতীয়তা" required>
                                        <?php echo $__env->make('errors.formValidateError', ['inputName' => 'nationalism','msg'=>'আবশ্যক'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                    </div>
                                </div>
                            </div><!-- /end single form input -->
                            <!-- religion -->
                            <div class="form-group col-sm-6 <?php echo e($errors->has('religion') ? 'has-error' : ''); ?>">
                                <div class="row">
                                    <div class="col-sm-4 text-right">
                                        <label for="currentAge"><span style="color: red;">* </span>ধর্ম</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <select name="religion" class="form-control-select select-class" id="religion"
                                                required>
                                            <option <?php if(old('religion')=="মুসলিম"): ?><?php echo e('selected'); ?><?php endif; ?> value="মুসলিম">
                                                মুসলিম
                                            </option>
                                            <option <?php if(old('religion')=="হিন্দু"): ?><?php echo e('selected'); ?><?php endif; ?> value="হিন্দু">
                                                হিন্দু
                                            </option>
                                            <option <?php if(old('religion')=="বৌদ্ধ"): ?><?php echo e('selected'); ?><?php endif; ?> value="বৌদ্ধ">
                                                বৌদ্ধ
                                            </option>
                                            <option <?php if(old('religion')=="খ্রিষ্টান"): ?><?php echo e('selected'); ?><?php endif; ?> value="খ্রিষ্টান">
                                                খ্রিষ্টান
                                            </option>
                                        </select>
                                        <?php echo $__env->make('errors.formValidateError', ['inputName' => 'religion','msg'=>'আবশ্যক'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                    </div>
                                </div>
                            </div><!-- /end single form input -->
                        </div>
                        <hr>
                        <!--nid, bloood grp-->
                        <div class="row">
                            <!-- nid -->
                            <div class="form-group col-sm-6 ">
                                <div class="row">
                                    <div class="col-sm-4 text-right">
                                        <label for="idNumber"><span style="color: red;">* </span>ভোটার পরিচয়
                                            পত্র</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="idNumber" name="idNumber" value="<?php echo e(old('idNumber')); ?>"
                                               placeholder="ভোটার পরিচয় পত্র" required maxlength="17" minlength="17">
                                        <?php echo $__env->make('errors.formValidateError', ['inputName' => 'idNumber','msg'=>'১৭ সংখ্যার হতে হবে'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                    </div>
                                </div>
                            </div><!-- /end single form input -->
                            <!-- bld grp -->
                            <div class="form-group col-sm-6 <?php echo e($errors->has('bloodGroup') ? 'has-error' : ''); ?>">
                                <div class="row">
                                    <div class="col-sm-4 text-right">
                                        <label for="bloodGroup"><span style="color: red;">* </span>রক্তের গ্রুপ</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <select id="bloodGroup" name="bloodGroup"
                                                class="form-control-select select-class" required>
                                            <option value="0">রক্তের গ্রুপ</option>
                                            <?php if(empty($blood)): ?>
                                                <option value="">No blood group</option>
                                            <?php else: ?>
                                                <?php $__currentLoopData = $blood; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option <?php if(old('group')== $group->id): ?> <?php echo e('selected'); ?> <?php endif; ?> value="<?php echo e($group->id); ?>"><?php echo e($group->blood_grp_name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </select>
                                        <?php echo $__env->make('errors.formValidateError', ['inputName' => 'bloodGroup','msg'=>'আবশ্যক'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                    </div>
                                </div>
                            </div><!-- /end single form input -->
                        </div>
                        <hr>
                        <!--education, marital status-->
                        <div class="row">
                            <!-- education -->
                            <div class="form-group col-sm-6 <?php echo e($errors->has('educationQuality') ? 'has-error' : ''); ?>">
                                <div class="row">
                                    <div class="col-sm-4 text-right">
                                        <label for="educationQuality"><span style="color: red;">* </span>শিক্ষাগত
                                            যোগ্যতা</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <select name="educationQuality" id="educationQuality"
                                                class="form-control-select select-class" required>
                                            <?php if(empty($educations)): ?>
                                                <option value="">No education</option>
                                            <?php else: ?>
                                                <?php $__currentLoopData = $educations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $education): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option <?php if(old('education')==$education->id): ?> <?php endif; ?> value="<?php echo e($education->id); ?>"><?php echo e($education->edu_name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </select>
                                        <?php echo $__env->make('errors.formValidateError', ['inputName' => 'educationQuality','msg'=>'আবশ্যক'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                    </div>
                                </div>
                            </div><!-- /end single form input -->
                            <!-- marital status -->
                            <div class="form-group col-sm-6 <?php echo e($errors->has('maritalStatus') ? 'has-error' : ''); ?>">
                                <div class="row">
                                    <div class="col-sm-4 text-right">
                                        <label for="maritalStatus"><span style="color: red;">* </span>বৈবাহিক
                                            অবস্থা</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input required type="radio" name="maritalStatus" <?php if(old('maritalStatus')=="বিবাহিত"): ?><?php echo e('checked'); ?> <?php endif; ?> value="বিবাহিত"> বিবাহিত &nbsp;&nbsp;&nbsp;&nbsp;
                                        <input required type="radio" name="maritalStatus" <?php if(old('maritalStatus')=="অবিবাহিত"): ?><?php echo e('checked'); ?> <?php endif; ?> value="অবিবাহিত"> অবিবাহিত
                                        <?php echo $__env->make('errors.formValidateError', ['inputName' => 'maritalStatus','msg'=>'আবশ্যক'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                    </div>
                                </div>
                            </div><!-- /end single form input -->
                        </div>
                        <hr>
                        <!--nomini name, relation-->
                        <div class="row">
                            <!-- nominee name -->
                            <div class="form-group col-sm-6 <?php echo e($errors->has('nomineeName') ? 'has-error' : ''); ?>">
                                <div class="row">
                                    <div class="col-sm-4 text-right">
                                        <label for="nomineeName"><span style="color: red;">* </span>নমিনির নাম </label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="nomineeName" name="nomineeName" value="<?php echo e(old('nomineeName')); ?>"
                                               placeholder="নাম" required>
                                        <?php echo $__env->make('errors.formValidateError', ['inputName' => 'nomineeName','msg'=>'আবশ্যক'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                    </div>
                                </div>
                            </div><!-- /end single form input -->
                            <!-- nominee relation -->
                            <div class="form-group col-sm-6 <?php echo e($errors->has('nomineeRelation') ? 'has-error' : ''); ?>">
                                <div class="row">
                                    <div class="col-sm-4 text-right">
                                        <label for="nomineeRelation"><span style="color: red;">* </span>সম্পর্ক</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="nomineeRelation" required
                                               value="<?php echo e(old('nomineeRelation')); ?>" name="nomineeRelation" placeholder="সম্পর্ক">
                                        <?php echo $__env->make('errors.formValidateError', ['inputName' => 'nomineeRelation','msg'=>'আবশ্যক'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                    </div>
                                </div>
                            </div><!-- /end single form input -->
                        </div>
                        <hr>
                        <!--mobile, office-->
                        <div class="row">
                            <!--phone-->
                            <div class="col-md-6 form-group <?php echo e($errors->has('phoneNumber') ? 'has-error':''); ?>">
                                <div class="row">
                                    <div class="col-sm-4 text-right">
                                        <label for="phoneNumber"><span style="color: red;">* </span>ফোন/মোবাইল </label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" value="<?php echo e(old('phoneNumber')); ?>"
                                               placeholder="মোবাইল" maxlength="11" required>
                                        <?php echo $__env->make('errors.formValidateError', ['inputName' => 'phoneNumber','msg'=>'৭ থেকে ১১ সংখ্যার মধ্যে হতে হবে'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                    </div>
                                </div>
                            </div>
                            <!--branch-->
                            <div class="col-md-6 form-group <?php echo e($errors->has('officeLocation') ? 'has-error':''); ?>">
                                <div class="row">
                                    <div class="col-sm-4 text-right">
                                        <label for="officeLocation"><span style="color: red;">* </span>অফিস নির্বাচন
                                        </label>
                                    </div>
                                    <div class="col-sm-8">
                                        <select name="officeLocation" id="officeLocation"
                                                class="form-control-select select-class" required>
                                            <?php if(empty($branch)): ?>
                                                <option value="0">অফিস নির্বাচন করুন</option>
                                            <?php else: ?>
                                                <?php $__currentLoopData = $branch; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option <?php if(old('b')==$b->id): ?> <?php echo e('selected'); ?> <?php endif; ?> value="<?php echo e($b->id); ?>"><?php echo e($b->name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </select>
                                        <?php echo $__env->make('errors.formValidateError', ['inputName' => 'officeLocation','msg'=>'আবশ্যক'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <!--applicant pic, nominee pic -->
                        <div class="row">
                            <!--applicant pic-->
                            <div class="col-sm-6 form-group <?php echo e($errors->has('yourPicture') ? 'has-error':''); ?>">
                                <div class="row">
                                    <div class="col-sm-4 text-right">
                                        <label for="yourPicture"><span style="color: red;">* </span>আবেদনকারীর ছবি
                                        </label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="profileImage admitPicture">
                                            <input type="file" id="picture" name="picture" required
                                                   class="form-control">
                                            <img id="pictureView">
                                        </div>
                                        <?php echo $__env->make('errors.formValidateError',['inputName' => 'yourPicture','msg'=>'আবশ্যক'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                    </div>
                                </div>
                            </div>
                            <!--nominee pic-->
                            <div class="col-sm-6 form-group <?php echo e($errors->has('nomineePicture') ? 'has-error':''); ?>">
                                <div class="row">
                                    <div class="col-sm-4 text-right">
                                        <label for="nomineePicture"><span style="color: red;">* </span>নমিনীর ছবি
                                        </label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="profileImage nomineePicture">
                                            <input type="file" id="nomineePicture" name="nomineePicture" required
                                                   class="form-control">
                                            <img id="nomineePictureView">
                                            <?php echo $__env->make('errors.formValidateError',['inputName' => 'nomineePicture','msg'=>'আবশ্যক'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--applicant pic, nominee pic -->
                        <div class="row">
                            <!--applicant pic-->
                            <div class="col-sm-6 form-group <?php echo e($errors->has('applicantSign') ? 'has-error':''); ?>">
                                <div class="row">
                                    <div class="col-sm-4 text-right">
                                        <label for="yourPicture"><span style="color: red;">* </span>আবেদনকারীর স্বাক্ষর
                                        </label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="profileImage admitPicture">
                                            <input type="file" id="applicantSign" name="applicantSign" required
                                                   class="form-control">
                                            <img id="applicantSignView">
                                        </div>
                                        <?php echo $__env->make('errors.formValidateError',['inputName' => 'yourPicture','msg'=>'আবশ্যক'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-12" style="text-align: center">
                                    <button type="submit" id="btn" class="btn btn-success btn-lg"><i
                                                class="fa fa-save"></i> আবেদন করুন
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="paddings-mini"></div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('customJs'); ?>
    <script type="text/javascript" src="<?php echo e(url('public')); ?>/js/libs/selectize/selectize.min.js"></script>
    <script type="text/javascript" src="<?php echo e(url('public')); ?>/js/libs/image-resize/iEdit.js"></script>
    <script type="text/javascript" src="<?php echo e(url('public')); ?>/js/libs/form-validation/validate.min.js"></script>
    <script type="text/javascript" src="<?php echo e(url('public')); ?>/js/libs/datepicker/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="<?php echo e(url('public')); ?>/js/form/member-admit.js"></script>
    <script>
        function checkNumber(id) {
            var tmp_num = $('#' + id).val().getDigitEnglishFromBangla();
            if (tmp_num == null || isNaN(tmp_num)) {
                var x = document.getElementById(id);
                x.value = x.value.replace(/[^0-9]/, '');
            }
        }

        function getUpz(id) {
            var value = $('#'+id).val();
            $.ajax({
                type: 'get',
                url: base_url + '/sub_district/' + value,
                data: {}, success: function (data) {

                    document.getElementById('upZ').innerHTML = '';

                    var trow = '<div class="input-group">'
                            + '<label for="thana" class="location-label input-group-addon">উপজেলা</label>'
                            + '<select name="thana" id="thana" class="form-control-select select-class" required>';
                    $.each(data, function (i, v) {
                        trow += '<option value="' + v.id + '">' + v.bn_name + '</option>';

                    });
                    trow += '</select>'
                            + '</div>'

                    $('#upZ').append(trow);

                    $('#thana').selectize();


                }
            });
        }

        function getUpzP(id) {
            var value = $('#'+id).val();
            $.ajax({
                type: 'get',
                url: base_url + '/sub_district/' + value,
                data: {}, success: function (data) {

                    document.getElementById('pUpz').innerHTML = '';

                    var trow = '<div class="input-group">'
                            + '<label for="thana" class="location-label input-group-addon">উপজেলা</label>'
                            + '<select name="permanentThana" id="permanentThana" class="form-control-select select-class" required>';
                    $.each(data, function (i, v) {
                        trow += '<option value="' + v.id + '">' + v.bn_name + '</option>';

                    });
                    trow += '</select>'
                            + '</div>'

                    $('#pUpz').append(trow);

                    $('#permanentThana').selectize();


                }
            });
        }

        $('#division').on('change', function () {
            var value = $(this).val();

            $.ajax({
                type: 'get',
                url: base_url + '/district',
                data: {
                    div_id: value
                }, success: function (data) {

                    document.getElementById('dist').innerHTML = '';

                    var trow = '<div class="input-group">'
                            + '<label for="district" class="location-label input-group-addon">জেলা</label>'
                            + '<select onchange="getUpz(this.id)" required name="district" id="district" class="form-control-select select-class">';
                    $.each(data['dist'], function (i, v) {
                        trow += '<option value="' + v.id + '">' + v.bn_name + '</option>';

                    });
                    trow += '</select>'
                            + '</div>';

                    $('#dist').append(trow);

                    $('#district').selectize();


                    document.getElementById('upZ').innerHTML = '';

                    var trow = '<div class="input-group">'
                            + '<label for="thana" class="location-label input-group-addon">উপজেলা</label>'
                            + '<select name="thana" id="thana" class="form-control-select select-class" required>';
                    $.each(data['upz'], function (i, v) {
                        trow += '<option value="' + v.id + '">' + v.bn_name + '</option>';

                    });
                    trow += '</select>'
                            + '</div>';

                    $('#upZ').append(trow);

                    $('#thana').selectize();


                }
            });
        });

        $('#permanentDivision').on('change', function () {
            var value = $(this).val();

            $.ajax({
                type: 'get',
                url: base_url + '/district',
                data: {
                    div_id: value
                }, success: function (data) {

                    document.getElementById('pDist').innerHTML = '';

                    var trow = '<div class="input-group">'
                            + '<label for="permanentDistrict" class="location-label input-group-addon">জেলা</label>'
                            + '<select onchange="getUpzP(this.id)" required name="permanentDistrict" id="permanentDistrict" class="form-control-select select-class">';
                    $.each(data['dist'], function (i, v) {
                        trow += '<option value="' + v.id + '">' + v.bn_name + '</option>';

                    });
                    trow += '</select>'
                            + '</div>';

                    $('#pDist').append(trow);

                    $('#permanentDistrict').selectize();


                    document.getElementById('pUpz').innerHTML = '';

                    var trow = '<div class="input-group">'
                            + '<label for="thana" class="location-label input-group-addon">উপজেলা</label>'
                            + '<select name="permanentThana" id="permanentThana" class="form-control-select select-class" required>';
                    $.each(data['upz'], function (i, v) {
                        trow += '<option value="' + v.id + '">' + v.bn_name + '</option>';

                    });
                    trow += '</select>'
                            + '</div>';

                    $('#pUpz').append(trow);

                    $('#permanentThana').selectize();


                }
            });
        });

        $('#birthDate').datepicker({
            format: "dd/mm/yyyy"
        });

        $('#idNumber').keyup(function () {
            checkNumber('idNumber');
        }).blur(function () {
            checkNumber('idNumber');
        });

        $('#phoneNumber').keyup(function () {
            checkNumber('phoneNumber');
        }).blur(function () {
            checkNumber('phoneNumber');
        });

        $("#picture").change(function (e) {

            var img = e.target.files[0];

            if (!img.type.match('image.*')) {
                alert("Whoops! That is not an image.");
                $('#picture').val('');
                return;
            }
            iEdit.open(img, true, function (res) {
                $("#pictureView").attr("src", res).width(120).height(60);
            });
        });

        $("#nomineePicture").change(function (e) {

            var img = e.target.files[0];

            if (!img.type.match('image.*')) {
                alert("Whoops! That is not an image.");
                $('#nomineePicture').val('');
                return;
            }
            iEdit.open(img, true, function (res) {
                $("#nomineePictureView").attr("src", res).width(120).height(60);
            });
        });

        $("#applicantSign").change(function (e) {

            var img = e.target.files[0];

            if (!img.type.match('image.*')) {
                alert("Whoops! That is not an image.");
                $('#applicantSign').val('');
                return;
            }
            iEdit.open(img, true, function (res) {
                $("#applicantSignView").attr("src", res).width(120).height(60);
            });
        });

    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.public', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
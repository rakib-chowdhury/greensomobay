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
    <?php 
    $bn_digits = array('০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯');
     ?>
    <div class="content_info content_area_main">
        <div class="container">
            <div class="paddings-mini">
                <!--form title-->
                <div class="form-title title-vertical-line">
                    <h2><b>ঋণ আবেদন ফর্ম </b></h2>
                </div>
                <div class="paddings-mini"></div>
                <!--form CONTENT-->
                <div class="form-content">
                    <form id="loanApplicantForm" action="<?php echo e(url('/loanApplicant')); ?>" class="form" method="post"
                          enctype="multipart/form-data">
                        <?php echo e(csrf_field()); ?>

                        <input type="hidden" name="mem_id" value="<?php echo e($member_info->id); ?>">
                        <!-- to start -->
                        <div class="row">
                            <div class="form-group col-sm-12 <?php echo e($errors->has('applierName') ? 'has-error' : ''); ?>">
                                <div class="row">
                                    <label for="applicantTo">বরাবর </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-12 <?php echo e($errors->has('applierOccupation') ? 'has-error' : ''); ?>">
                                <div class="row">
                                    <label for="president">সভাপতি </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-12 <?php echo e($errors->has('applierOccupation') ? 'has-error' : ''); ?>">
                                <div class="row">
                                    <label for="area">গ্রীন, পঞ্চগড় </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-12 <?php echo e($errors->has('applierOccupation') ? 'has-error' : ''); ?>">
                                <div class="row">
                                    <label for="subject"><b>বিষয় : পণ্য /ক্ষুদ্র ব্যাবসার জন্য ঋণের আবেদন ।</b> </label>

                                </div>
                            </div>
                        </div>
                        <hr>
                        <!--Applicant name, guardian name-->
                        <div class="row">
                            <!--Applicant name-->
                            <div class="form-group col-sm-6 <?php echo e($errors->has('applierName') ? 'has-error' : ''); ?>">
                                <div class="row">
                                    <div class="col-sm-4 text-right">
                                        <label class="" for="applierName"><span style="color: red;">* </span>আবেদনকারীর
                                            নাম</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="applierName" name="applierName"
                                               placeholder="নাম" value="<?php echo e($member_info->name); ?>" readonly required>
                                        <?php echo $__env->make('errors.formValidateError', ['inputName' => 'applierName'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                    </div>
                                </div>
                            </div>
                            <!-- guardian name -->
                            <div class="form-group col-sm-6 <?php echo e($errors->has('guardianName') ? 'has-error' : ''); ?>">
                                <div class="row">
                                    <div class="col-sm-4 text-right">
                                        <label for="guardianName"><span style="color: red;">* </span>পিতা/স্বামীর
                                            নাম</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="guardianName" name="guardianName"
                                               readonly required
                                               placeholder="পিতা/স্বামী"
                                               value="<?php echo e($member_info->hasMemberDetails->guardian_name); ?>">
                                        <?php echo $__env->make('errors.formValidateError', ['inputName' => 'guardianName'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                    </div>
                                </div>
                            </div><!-- /end single form input -->
                        </div>
                        <hr>
                        <!--present address-->
                        <div class="row">
                            <div class="col-sm-2 text-right">
                                <label for="currentAddress"><span style="color: red;">* </span> বর্তমান ঠিকানা</label>
                            </div>
                            <div class="col-sm-10">
                                <div class="row">
                                    <!--village-->
                                    <div class="col-sm-8 form-group <?php echo e($errors->has('location') ? 'has-error' : ''); ?>">
                                        <div class="input-group">
                                            <label for="location" class="location-label input-group-addon">গ্রাম</label>
                                            <input type="text" class="form-control" name="location" readonly
                                                   value="<?php echo e($member_info->hasMemberDetails->current_location); ?>"
                                                   placeholder="গ্রাম" id="location" required>
                                            <?php echo $__env->make('errors.formValidateError',['inputName' => 'location','msg'=>'আবশ্যক'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                        </div>
                                    </div>
                                    <!--post office-->
                                    <div class="col-sm-4 form-group <?php echo e($errors->has('postalLocation') ? 'has-error' : ''); ?>">
                                        <div class="input-group">
                                            <label for="postalLocation"
                                                   class="location-label input-group-addon">ডাকঘর</label>
                                            <input type="text" class="form-control" name="postalLocation"
                                                   value="<?php echo e($member_info->hasMemberDetails->current_postoffice); ?>"
                                                   id="postalLocation" placeholder="ডাকঘর" required readonly>
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
                                                        <?php if($member_info->hasMemberDetails->current_division==$division->id): ?>
                                                            <option value="<?php echo e($division->id); ?>"><?php echo e($division->name); ?></option>
                                                        <?php endif; ?>
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
                                                    <option value="">No district</option>
                                                <?php else: ?>
                                                    <?php $__currentLoopData = $districts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $district): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if($member_info->hasMemberDetails->current_district==$district->id): ?>
                                                            <option value="<?php echo e($district->id); ?>"><?php echo e($district->bn_name); ?></option>
                                                        <?php endif; ?>
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
                                                        <?php if($member_info->hasMemberDetails->current_upazila==$u->id): ?>
                                                            <option value="<?php echo e($u->id); ?>"><?php echo e($u->bn_name); ?></option>
                                                        <?php endif; ?>
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
                        <!--permanent address-->
                        <div class="row">
                            <div class="col-sm-2 text-right">
                                <label for="permanentAddress"><span style="color: red;">* </span> স্থায়ী ঠিকানা</label>
                            </div>
                            <div class="col-sm-10">
                                <div class="row">
                                    <!--village-->
                                    <div class="col-sm-8 form-group <?php echo e($errors->has('permanentLocation') ? 'has-error' : ''); ?>">
                                        <div class="input-group">
                                            <label for="permanentLocation" class="location-label input-group-addon">গ্রাম</label>
                                            <input type="text" class="form-control" name="permanentLocation"
                                                   value="<?php echo e($member_info->hasMemberDetails->permanent_location); ?>"
                                                   id="permanentLocation" placeholder="গ্রাম" required readonly>
                                            <?php echo $__env->make('errors.formValidateError',['inputName' => 'permanentLocation','msg'=>'আবশ্যক'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                        </div>
                                    </div>
                                    <!--post office-->
                                    <div class="col-sm-4 form-group <?php echo e($errors->has('permanentPostal') ? 'has-error' : ''); ?>">
                                        <div class="input-group">
                                            <label for="permanentPostal"
                                                   class="location-label input-group-addon">ডাকঘর</label>
                                            <input type="text" class="form-control" name="permanentPostal"
                                                   value="<?php echo e($member_info->hasMemberDetails->permanent_postoffice); ?>"
                                                   id="permanentPostal" placeholder="ডাকঘর" required readonly>
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
                                                        <?php if($member_info->hasMemberDetails->permanent_division==$division->id): ?>
                                                            <option value="<?php echo e($division->id); ?>"><?php echo e($division->name); ?></option>
                                                        <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>
                                            </select>
                                            <?php echo $__env->make('errors.formValidateError',['inputName' => 'permanentDivision','msg'=>'আবশ্যক'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                        </div>
                                    </div>
                                    <!--district--->
                                    <div id="pDist"
                                         class="col-sm-4 form-group <?php echo e($errors->has('permanentDistrict') ? 'has-error' : ''); ?>">
                                        <div class="input-group">
                                            <label for="permanentDistrict"
                                                   class="location-label input-group-addon">জেলা</label>
                                            <select onchange="getUpzP(this.id)" name="permanentDistrict"
                                                    id="permanentDistrict"
                                                    class="form-control-select select-class" required>
                                                <?php if(empty($districts)): ?>
                                                    <option value="">No district</option>
                                                <?php else: ?>
                                                    <?php $__currentLoopData = $districts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $district): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if($member_info->hasMemberDetails->permanent_district==$district->id): ?>
                                                            <option value="<?php echo e($district->id); ?>"><?php echo e($district->bn_name); ?></option>
                                                        <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>
                                            </select>
                                            <?php echo $__env->make('errors.formValidateError',['inputName' => 'permanentDistrict','msg'=>'আবশ্যক'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                        </div>
                                    </div>
                                    <!--upazilla-->
                                    <div id="pUpz"
                                         class="col-sm-4 form-group <?php echo e($errors->has('permanentThana') ? 'has-error' : ''); ?>">
                                        <div class="input-group">
                                            <label for="permanentThana"
                                                   class="location-label input-group-addon">উপজেলা</label>
                                            <select name="permanentThana" id="permanentThana"
                                                    class="form-control-select select-class" required>
                                                <?php if(empty($upz)): ?>
                                                    <option value="">No upazilla</option>
                                                <?php else: ?>
                                                    <?php $__currentLoopData = $upz; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if($member_info->hasMemberDetails->permanent_upazila==$u->id): ?>
                                                            <option value="<?php echo e($u->id); ?>"><?php echo e($u->bn_name); ?></option>
                                                        <?php endif; ?>
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
                        <!--applicant register date, applicant register no-->
                        <div class="row">
                            <!--applicant register date-->
                            <div class="col-sm-6 form-group <?php echo e($errors->has('applicantDate') ? 'has-error' : ''); ?>">
                                <div class="row">
                                    <div class="col-sm-4 text-right">
                                        <label for="applicantDate"><span style="color: red;">* </span>সদস্য লাভের তারিখ
                                        </label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input readonly type="text" class="form-control" name="applicantDate" readonly
                                               required
                                               id="applicantDate"
                                               value="<?php echo e(str_replace(range(0,9),$bn_digits,$member_info->hasMemberDetails->membership_granted_at)); ?>">
                                        <?php echo $__env->make('errors.formValidateError',['inputName' => 'applicantDate'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                    </div>
                                </div>
                            </div>
                            <!--applicant register no, -->
                            <div class="col-sm-6 form-group <?php echo e($errors->has('registrationNumber') ? 'has-error' : ''); ?>">
                                <div class="row">
                                    <div class="col-sm-4 text-right">
                                        <label for="registrationNumber"><span style="color: red;">* </span>রেজিস্ট্রেশন
                                            নং</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="registrationNumber" required
                                               readonly
                                               id="registrationNumber" placeholder="রেজিস্ট্রেশন নং"
                                               value="<?php echo e(str_replace(range(0,9),$bn_digits,$member_info->registration_no)); ?>">
                                        <?php echo $__env->make('errors.formValidateError',['inputName' => 'registrationNumber'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <!--applicant mobile, applicant designation-->
                        <div class="row">
                            <!--applicant mobile-->
                            <div class="col-sm-6 form-group <?php echo e($errors->has('applicantMobile') ? 'has-error' : ''); ?>">
                                <div class="row">
                                    <div class="col-sm-4 text-right">
                                        <label for="applicantMobile"><span style="color: red;">* </span>সদস্যের মোবাইল
                                            নং</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="text" maxlength="11" class="form-control" name="applicantMobile"
                                               readonly required
                                               id="applicantMobile" placeholder="সদস্যের  মোবাইল নং"
                                               value="<?php echo e(str_replace(range(0,9),$bn_digits,$member_info->phone)); ?>">
                                        <?php echo $__env->make('errors.formValidateError',['inputName' => 'applicantMobile'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                    </div>
                                </div>
                            </div>
                            <!--applicant designation-->
                            <div class="col-sm-6 form-group <?php echo e($errors->has('applicantProfession') ? 'has-error' : ''); ?>">
                                <div class="row">
                                    <div class="col-sm-4 text-right">
                                        <label for="applicantProfession"><span style="color: red;">* </span>আবেদনকারীর
                                            পেশা</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="applicantProfession"
                                               id="applicantProfession"
                                               value="<?php echo e($member_info->hasMemberDetails->occupation); ?>"
                                               placeholder="আবেদনকারীর  পেশা" readonly required>
                                        <?php echo $__env->make('errors.formValidateError',['inputName' => 'applicantProfession'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <!--prev loan number, loan amount-->
                        <div class="row">
                            <!--prev loan number-->
                            <div class="col-sm-6 form-group <?php echo e($errors->has('loanTimes') ? 'has-error' : ''); ?>">
                                <div class="row">
                                    <div class="col-sm-4 text-right">
                                        <label for="loanTimes">পূর্বে কতবার ঋণ গ্রহণ করেছেন</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="loanTimes" id="loanTimes"
                                               placeholder="পূর্বে কতবার ঋণ গ্রহণ করেছেন  " readonly
                                               value="<?php echo e(str_replace(range(0,9),$bn_digits,sizeof($take_loan))); ?>">
                                    </div>
                                </div>
                            </div>
                            <!--loan amount-->
                            <div class="col-sm-6 form-group <?php echo e($errors->has('loanAmount') ? 'has-error' : ''); ?>">
                                <div class="row">
                                    <div class="col-sm-4 text-right">
                                        <label for="loanAmount">গৃহীত ঋণের পরিমাণ</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="loanAmount" id="loanAmount"
                                               readonly placeholder="গৃহীত ঋণের পরিমাণ  "
                                               <?php if(sizeof('take_loan')==0): ?>value="০"
                                               <?php else: ?> value="<?php echo e(str_replace(range(0,9),$bn_digits,$take_loan->sum('loan_amount'))); ?>" <?php endif; ?> >
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <!--loan pay cndtn, last loan pay date-->
                        <div class="row">
                            <!--loan pay cndtn-->
                            <div class="col-sm-6 form-group <?php echo e($errors->has('thana') ? 'has-error' : ''); ?>">
                                <div class="row">
                                    <div class="col-sm-4 text-right">
                                        <label for="repaymentStatus">পূর্ববর্তী ঋণ পরিশোধের অবস্থা</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <select class="form-control" id="repaymentStatus" name="repaymentStatus">
                                            <option>ভাল</option>
                                            <option>মোটামুটি</option>
                                            <option>খারাপ</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!--last loan pay date-->
                            <div class="col-sm-6 form-group <?php echo e($errors->has('paymentDeadline') ? 'has-error' : ''); ?>">
                                <div class="row">
                                    <div class="col-sm-4 text-right">
                                        <label for="paymentDeadline">পূর্বের ঋণ পরিশোদের শেষ তারিখ</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input readonly type="text" class="form-control dateInput"
                                               name="paymentDeadline" id="paymentDeadline"
                                               <?php if(empty('take_loan')): ?>value="0" <?php else: ?> value="45<?php echo e(str_replace(range(0,9),$bn_digits,$take_loan)); ?>" <?php endif; ?> >
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <!--lst 3mnth deposit --3rd mnth, lst 3mnth deposit --2rd mnth-->
                        <div class="row">
                            <!--lst 3mnth deposit --3rd mnth-->
                            <div class="col-sm-6 form-group <?php echo e($errors->has('storageStatus') ? 'has-error' : ''); ?>">
                                <div class="row">
                                    <div class="col-sm-4 text-right">
                                        <label for="storageStatus1st">বিগত ৩ মাসের সঞ্চয়ের অবস্থা : ১ম</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="storageStatus" id="storageStatus"
                                               placeholder="১ম মাস   ">
                                    </div>
                                </div>
                            </div>
                            <!--lst 3mnth deposit --2rd mnth-->
                            <div class="col-sm-6 form-group <?php echo e($errors->has('storageStatus2nd') ? 'has-error' : ''); ?>">
                                <div class="row">
                                    <div class="col-sm-4 text-right">
                                        <label for="storageStatus2nd">২য় মাস</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="storageStatus2nd"
                                               id="storageStatus2nd" placeholder="২য় মাস  ">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--lst 3mnth deposit --1st mnth-->
                        <div class="row">
                            <!--lst 3mnth deposit --1st mnth-->
                            <div class="col-sm-6 form-group <?php echo e($errors->has('storageStatus3rd') ? 'has-error' : ''); ?>">
                                <div class="row">
                                    <div class="col-sm-4 text-right">
                                        <label for="storageStatus3rd">৩য় মাস</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="storageStatus3rd"
                                               id="storageStatus3rd" placeholder="৩য় মাস   ">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <!--curr deposit, partial witdrawal -->
                        <div class="row">
                            <!--curr deposit-->
                            <div class="col-sm-6 form-group <?php echo e($errors->has('totalSavings') ? 'has-error' : ''); ?>">
                                <div class="row">
                                    <div class="col-sm-4 text-right">
                                        <label for="totalSavings">বর্তমান মোট সঞ্চয়</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="totalSavings" id="totalSavings"
                                               placeholder="বর্তমান মোট সঞ্চয়" readonly required
                                               value="<?php echo e(str_replace(range(0,9),$bn_digits,$deposit)); ?>">
                                        <?php echo $__env->make('errors.formValidateError',['inputName' => 'totalSavings'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                    </div>
                                </div>
                            </div>
                            <!--partial witdrawal-->
                            <div class="col-sm-6 form-group <?php echo e($errors->has('partialRefund') ? 'has-error' : ''); ?>">
                                <div class="row">
                                    <div class="col-sm-4 text-right">
                                        <label for="partialRefund"><span style="color: red;">* </span>আংশিক সঞ্চয় ফেরত
                                            নেওয়ার পরিমাণ</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="partialRefund" id="partialRefund"
                                               placeholder="আংশিক সঞ্চয় ফেরত নেওয়ার পরিমাণ ">
                                        <?php echo $__env->make('errors.formValidateError',['inputName' => 'partialRefund'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <!--req laon amount, loan field -->
                        <div class="row">
                            <!--req loan amount -->
                            <div class="col-sm-6 form-group <?php echo e($errors->has('proposedLoan') ? 'has-error' : ''); ?>">
                                <div class="row">
                                    <div class="col-sm-4 text-right">
                                        <label for="proposedLoan"><span style="color: red;">* </span>প্রস্তাবিত ঋণের
                                            পরিমাণ</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="proposedLoan" id="proposedLoan"
                                               placeholder="প্রস্তাবিত ঋণের পরিমাণ   " required>
                                        <?php echo $__env->make('errors.formValidateError',['inputName' => 'proposedLoan'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                    </div>
                                </div>
                            </div>
                            <!--loan field -->
                            <div class="col-sm-6 form-group <?php echo e($errors->has('creditSector') ? 'has-error' : ''); ?>">
                                <div class="row">
                                    <div class="col-sm-4 text-right">
                                        <label for="creditSector"><span style="color: red;">* </span>ঋণের খাত</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="creditSector" id="creditSector"
                                               placeholder="ঋণের খাত  " required>
                                        <?php echo $__env->make('errors.formValidateError',['inputName' => 'creditSector'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <!--loan duration -->
                        <div class="row">
                            <!--loan duration-->
                            <div class="col-sm-6 form-group <?php echo e($errors->has('termLoan') ? 'has-error' : ''); ?>">
                                <div class="row">
                                    <div class="col-sm-4 text-right">
                                        <label for="termLoan"><span style="color: red;">* </span>ঋণের মেয়াদ</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control " name="termLoan" id="termLoan"
                                               placeholder="ঋণের মেয়াদ" required>
                                        <?php echo $__env->make('errors.formValidateError',['inputName' => 'termLoan'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-sm-12 form-group ">
                                <div class="row">
                                    <div class="col-sm-12 ">
                                        <label for="termLoan">ঋণ পরিশোধের নিয়ম:<br><br>
                                            আমি আবেদনকারী এই মর্মে অঙ্গীকার করছি যে, আমাকে উক্ত ঋণ প্রদান করলে আমি যথা
                                            সময় এ সমিতির নির্ধারিত চার্জ অনুযায়ী ঋণ পরিশোধ করতে বাধ্য থাকিব ।
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <!---applicant sign--->
                            <div class="col-sm-offset-6 form-group <?php echo e($errors->has('applicantSignature') ? 'has-error' : ''); ?>">
                                <div class="row">
                                    <div class="col-sm-4 text-right">
                                        <label for="applicantSignature"><span style="color: red;">* </span>আবেদনকারীর
                                            স্বাক্ষর </label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="signature">
                                            <img style="width:120px; height: 60px;"
                                                 src="<?php echo e(url('public/img/member/'.$member_info->hasMemberDetails->member_sign)); ?>"
                                                 alt="">
                                        </div>
                                        <?php echo $__env->make('errors.formValidateError',['inputName' => 'applicantSignature'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <!---applicant sign date--->
                            <div class="col-sm-offset-6 form-group <?php echo e($errors->has('signatureDate') ? 'has-error' : ''); ?>">
                                <div class="row">
                                    <div class="col-sm-4 text-right">
                                        <label for="signatureDate"><span style="color: red;">* </span>তারিখ</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input readonly type="text" class=" form-control" name="signatureDate"
                                               id="signatureDate" value="<?php echo e(date('Y-m-d')); ?>" required>
                                        <?php echo $__env->make('errors.formValidateError',['inputName' => 'signatureDate'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <!---loan amount --->
                        <div class="row">
                            <div class="col-sm-12 form-group <?php echo e($errors->has('applicantName') ? 'has-error' : ''); ?>">
                                <div class="row">
                                    <div class="col-sm-3  ">
                                        <input type="text" class="form-control" name="applicantName" id="applicantName"
                                               placeholder="আবেদনকারীর  নাম " value="<?php echo e($member_info->name); ?>" required
                                               readonly>
                                        <?php echo $__env->make('errors.formValidateError',['inputName' => 'applicantName'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                    </div>
                                    <div class="col-sm-5">
                                        <label for="des"> এর অভিভাবক হিসাবে ঋণ পরিশোধের দায় -দায়িত্ব নিয়ে
                                        </label>
                                    </div>
                                    <!---loan amount--->
                                    <div class="col-sm-4 ">
                                        <input type="text" class="form-control" name="applicantGuardian"
                                               id="applicantGuardian" placeholder="" readonly>
                                        <?php echo $__env->make('errors.formValidateError',['inputName' => 'applicantGuardian'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                    </div>
                                    <hr>
                                    <div>
                                        <label for="des"> টাকা ঋণ প্রদানের জন্য অনুরোধ করছি ।
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <!-- grantor name -->
                            <div class="form-group col-sm-6 <?php echo e($errors->has('guardianName') ? 'has-error' : ''); ?>">
                                <div class="row">
                                    <div class="col-sm-4 text-right">
                                        <label for="guardianName"><span style="color: red;">* </span>অভিভাবকের নাম
                                        </label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="guardianName" name="guardianName"
                                               placeholder="অভিভাবকের  নাম">
                                        <?php echo $__env->make('errors.formValidateError', ['inputName' => 'guardianName'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                    </div>
                                </div>
                            </div><!-- /end single form input -->
                            <!-- grantor relation -->
                            <div class="form-group col-sm-6 <?php echo e($errors->has('nomineeRelation') ? 'has-error' : ''); ?>">
                                <div class="row">
                                    <div class="col-sm-4 text-right">
                                        <label for="nomineeRelation"><span style="color: red;">* </span> সম্পর্ক</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="nomineeRelation"
                                               name="nomineeRelation" placeholder="সম্পর্ক">
                                        <?php echo $__env->make('errors.formValidateError', ['inputName' => 'nomineeRelation'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                    </div>
                                </div>
                            </div><!-- /end single form input -->
                        </div>
                        <hr>

                        <div class="row">
                            <!--grantor sign -->
                            <div class="col-sm-6 form-group <?php echo e($errors->has('guardianSignature') ? 'has-error' : ''); ?>">
                                <div class="row">
                                    <div class="col-sm-4 text-right">
                                        <label for="guardianSignature"><span style="color: red;">* </span>অভিভাবকের
                                            স্বাক্ষর </label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="signature">
                                            <input type="file" id="guardianSignature" name="guardianSignature" required
                                                   class="form-control">
                                            <img id="guardianSignatureView">
                                        </div>
                                        <?php echo $__env->make('errors.formValidateError',['inputName' => 'guardianSignature'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                    </div>
                                </div>
                            </div>
                            <!--grantor designation -->
                            <div class="col-sm-6 form-group <?php echo e($errors->has('guardianCareers') ? 'has-error' : ''); ?>">
                                <div class="row">
                                    <div class="col-sm-4 text-right">
                                        <label for="guardianCareers"><span style="color: red;">* </span>অভিভাবকের
                                            পেশা</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="guardianCareers"
                                               id="guardianCareers" placeholder="অভিভাবকের পেশা ">
                                        <?php echo $__env->make('errors.formValidateError',['inputName' => 'guardianCareers'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <!-- witness 1 -->
                        <div class="row">
                            <div class="col-sm-6 form-group <?php echo e($errors->has('witnessSignature1') ? 'has-error' : ''); ?>">
                                <div class="row">
                                    <div class="col-sm-4 text-right">
                                        <label for="witnessSignature1"><span style="color: red;">* </span>সাক্ষীর
                                            স্বাক্ষর: ১ম স্বাক্ষর </label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="signature">
                                            <input type="file" id="witnessSignature1" name="witnessSignature1" required
                                                   class="form-control">
                                            <img id="witnessSignature1View">
                                        </div>
                                        <?php echo $__env->make('errors.formValidateError',['inputName' => 'witnessSignature1'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <!-- witness 2 -->
                        <div class="row">
                            <div class="col-sm-6 form-group <?php echo e($errors->has('witnessSignature2') ? 'has-error' : ''); ?>">
                                <div class="row">
                                    <div class="col-sm-4 text-right">
                                        <label for="witnessSignature2"><span style="color: red;">* </span>২য় স্বাক্ষর
                                        </label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="signature">
                                            <input type="file" id="witnessSignature2" name="witnessSignature2" required
                                                   class="form-control">
                                            <img id="witnessSignature2View">
                                        </div>
                                        <?php echo $__env->make('errors.formValidateError',['inputName' => 'witnessSignature2'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                    </div>
                                </div>
                            </div><!-- /end single form input -->
                        </div>
                        <hr>
                        <!-- witness 3 -->
                        <div class="row">
                            <div class="col-sm-6 form-group <?php echo e($errors->has('witnessSignature3') ? 'has-error' : ''); ?>">
                                <div class="row">
                                    <div class="col-sm-4 text-right">
                                        <label for="witnessSignature3"><span style="color: red;">* </span>৩য় স্বাক্ষর
                                        </label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="signature">
                                            <input type="file" id="witnessSignature3" name="witnessSignature3" required
                                                   class="form-control">
                                            <img id="witnessSignature3View">
                                        </div>
                                        <?php echo $__env->make('errors.formValidateError',['inputName' => 'witnessSignature3'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                    </div>
                                </div>
                            </div><!-- /end single form input -->
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
    <script type="text/javascript" src="<?php echo e(url('public')); ?>/js/form/loan-applicant.js"></script>
    <script>
        $(function () {
            $(".dateInput").datepicker({
                format: "yyyy-mm-dd"
            });
        });
        function checkNumber(id) {
            var tmp_num = $('#' + id).val().getDigitEnglishFromBangla();
            if (tmp_num == null || isNaN(tmp_num)) {
                var x = document.getElementById(id);
                x.value = x.value.replace(/[^0-9]/, '');
            }
        }

        $('#proposedLoan').keyup(function () {
            checkNumber('proposedLoan');
        }).blur(function () {
            checkNumber('proposedLoan');
        });

        $("#guardianSignature").change(function (e) {

            var img = e.target.files[0];

            if (!img.type.match('image.*')) {
                alert("Whoops! That is not an image.");
                $('#guardianSignature').val('');
                return;
            }
            iEdit.open(img, true, function (res) {
                $("#guardianSignatureView").attr("src", res).width(120).height(60);
            });
        });

        $("#witnessSignature1").change(function (e) {

            var img = e.target.files[0];

            if (!img.type.match('image.*')) {
                alert("Whoops! That is not an image.");
                $('#witnessSignature1').val('');
                return;
            }
            iEdit.open(img, true, function (res) {
                $("#witnessSignature1View").attr("src", res).width(120).height(60);
            });
        });

        $("#witnessSignature2").change(function (e) {

            var img = e.target.files[0];

            if (!img.type.match('image.*')) {
                alert("Whoops! That is not an image.");
                $('#witnessSignature2').val('');
                return;
            }
            iEdit.open(img, true, function (res) {
                $("#witnessSignature2View").attr("src", res).width(120).height(60);
            });
        });

        $("#witnessSignature3").change(function (e) {

            var img = e.target.files[0];

            if (!img.type.match('image.*')) {
                alert("Whoops! That is not an image.");
                $('#witnessSignature3').val('');
                return;
            }
            iEdit.open(img, true, function (res) {
                $("#witnessSignature3View").attr("src", res).width(120).height(60);
            });
        });

    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.public', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
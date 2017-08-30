<?php $__env->startSection('content'); ?>

        <!-- Info Content - Boxes Services-->
<div class="content_info">
    <div class="padding-bottom-mini">
        <!-- Container Area - Boxes Services -->
        <div class="container">
            <div class="row">
                <div class="form-group ">
                    <h2 class="text-center">যোগাযোগ করুন</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5 col-xs-12 table-responsive">
                    <table class="table table-bordered">
                        <tr class="info-table-row">
                            <td class="info-table-icon"><i class="fa fa-long-arrow-right"></i></td>
                            <td class="info-table-content">
                                <?php if(!empty($page_info)): ?>
                                    <?php echo e($page_info->name); ?>

                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr class="info-table-row">
                            <td class="info-table-icon"><i class="fa fa-map-marker"></i></td>
                            <td class="info-table-content">
                                <?php if(!empty($page_info)): ?>
                                    <?php echo e($page_info->address); ?>

                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr class="info-table-row">
                            <td class="info-table-icon"><i class="fa fa-phone"></i></td>
                            <td class="info-table-content">
                                <?php if(!empty($page_info)): ?>
                                    <?php echo e($page_info->tnt); ?>

                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr class="info-table-row">
                            <td class="info-table-icon"><i class="fa fa-mobile-phone"></i></td>
                            <td class="info-table-content">
                                <?php if(!empty($page_info)): ?>
                                    <?php echo e($page_info->mobile); ?>

                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr class="info-table-row">
                            <td class="info-table-icon"><i class="fa fa-envelope"></i></td>
                            <td class="info-table-content">
                                <?php if(!empty($page_info)): ?>
                                    <?php echo e($page_info->email); ?>

                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr class="info-table-row">
                            <td class="info-table-icon"><i class="fa fa-globe"></i></td>
                            <td class="info-table-content">
                                <?php if(!empty($page_info)): ?>
                                    <a style=" text-decoration: none;" target="_blank" href="http://www.<?php echo e($page_info->website); ?>"><?php echo e($page_info->website); ?></a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="col-md-7">

                    
                    <iframe width="100%" height="200px" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d28606.921940331038!2d88.53881820883981!3d26.33086273640467!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39e48be2f9a09cd7%3A0xd52634303d09e6f!2sPanchagarh%2C+Bangladesh!5e0!3m2!1sen!2s!4v1490873135206" ></iframe>
                    <!-- Contact form -->
                    <div class="row"> <?php echo $__env->make('includes.flashMessage', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?></div>
                    <div class="row" style="margin-top: 40px;">

                        <form class="" method="post" action="<?php echo e(url('contact/send_mail')); ?>">

                            <?php echo e(csrf_field()); ?>

                            <div class="form-group col-md-6 col-xs-12">
                                <input id="name" name="name" class="form-control" type="text" placeholder="Name" required>
                            </div>
                            <div class="form-group col-md-6 col-xs-12">
                                <input class="form-control" id="email" name="email" type="email" placeholder="Email" required>
                            </div>
                            <div class="form-group col-md-12 col-xs-12">
                                <input class="form-control" id="subject" name="subject" type="text" placeholder="Subject" required>
                            </div>
                            <div class="form-group col-md-12 col-xs-12">
                                <textarea class="form-control" id="message" name="message" rows="5" placeholder="Message" required></textarea>
                            </div>
                            <div class="form-group col-xs-12 col-md-12" style="text-align: center">
                                <input type="submit" class="btn btn-success btn-rounded btn-raised btn-md" value="Submit">
                            </div>
                            <div class="text-center spinner col-md-12 hidden"><i class="fa fa-spinner fa-pulse"></i></div>
                            <div class="info col-md-12"></div>
                        </form>
                    </div>
                    <!-- /Contact form -->
                </div>
            </div>
        </div>
        <!-- End Container Area - Boxes Services -->
    </div>
</div>
<!-- End Info Content - Boxes Services-->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.public', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
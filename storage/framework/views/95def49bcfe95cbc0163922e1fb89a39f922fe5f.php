<!-- Modal -->
<div id="check_member" class="modal fade" role="dialog" data-backdrop="static">
    <div class="modal-dialog">

        <!-- Modal content-->
        <form onsubmit="return check_member_post()" action="<?php echo e(url('/check_member')); ?>" method="post">
            <?php echo e(csrf_field()); ?>

            <div class="modal-content">
                <div class="modal-header">
                    <a href="<?php echo e(url('/')); ?>">
                        <button type="button" class="close">&times;</button>
                    </a>
                    <h4 class="modal-title" id="m_title"></h4>
                </div>
                <div class="modal-body">
                    <div class="row" style="padding: 8px 0px">
                        <input type="hidden" name="m_type" id="m_type">
                        <div class="from-group col-sm-10 col-sm-offset-1" style="padding-bottom: 8px">
                            <label for="" class="col-sm-3">রেজিস্ট্রেশন নং</label>
                            <div class="col-sm-9">
                                <input type="text" id="reg_no" name="reg_no" required class="form-control">
                            </div>
                        </div>
                        <div class="from-group col-sm-10 col-sm-offset-1">
                            <label for="" class="col-sm-3">মোবাইল নম্বর</label>
                            <div class="col-sm-9">
                                <input type="text" maxlength="11" minlength="11" id="mb" name="mb" required
                                       class="form-control">
                            </div>
                        </div>
                        <div class="from-group col-sm-10 col-sm-offset-1 text-center">
                            <p style="color: red" id="mdlErr"></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-info">সাবমিট</button>
                    <a href="<?php echo e(url('/')); ?>">
                        <button type="button" class="btn btn-danger">বাতিল</button>
                    </a>
                </div>
            </div>
        </form>

    </div>
</div>
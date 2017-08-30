<?php if(session('success')): ?>
    <div class="card">
    <div class="card-body alert alert-success no-margin">
        <?php echo e(session('success')); ?>

    </div>
    </div>
<?php elseif(session('warning')): ?>
    <div class="card">
    <div class="card-body alert alert-warning no-padding">
        <?php echo e(session('warning')); ?>

    </div>
    </div>
<?php endif; ?>
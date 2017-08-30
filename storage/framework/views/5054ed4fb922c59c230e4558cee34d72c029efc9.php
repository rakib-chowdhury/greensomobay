<?php if($errors->has($inputName)): ?>
    <span class="help-block">
        <strong><?php echo e($msg); ?></strong>
    </span>
<?php endif; ?>
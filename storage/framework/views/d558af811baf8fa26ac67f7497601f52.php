

<?php $__env->startSection('content'); ?>
<h2>Create Announcement</h2>

<?php if($errors->any()): ?>
    <div style="background:#f8d7da; padding:10px; margin-bottom:15px; border-radius:5px; color:#721c24;">
        <ul>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php endif; ?>

<form action="<?php echo e(route('admin.announcements.store')); ?>" method="POST" style="max-width:500px;">
    <?php echo csrf_field(); ?>
    <label>Title</label>
    <input type="text" name="title" value="<?php echo e(old('title')); ?>" style="width:100%; padding:8px; margin-bottom:10px;">

    <label>Message</label>
    <textarea name="message" rows="5" style="width:100%; padding:8px; margin-bottom:10px;"><?php echo e(old('message')); ?></textarea>

    <button type="submit" style="padding:8px 12px; background:#28a745; color:#fff; border:none; border-radius:5px;">Post Announcement</button>
</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\WEB-barangay\resources\views/admin/create_announcement.blade.php ENDPATH**/ ?>
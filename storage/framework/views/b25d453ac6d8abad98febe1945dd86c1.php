

<?php $__env->startSection('content'); ?>
    <h1>Announcements</h1>

    <?php if($announcements->isEmpty()): ?>
        <p>No announcements available.</p>
    <?php else: ?>
        <?php $__currentLoopData = $announcements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $announcement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div style="
                background:#fff;
                padding:15px;
                border-radius:8px;
                margin-bottom:15px;
                box-shadow:0 0 5px rgba(0,0,0,0.1);
            ">
                <h3 style="margin:0;"><?php echo e($announcement->title); ?></h3>
                <p style="margin-top:10px;"><?php echo e($announcement->message); ?></p>
                <small style="color:gray;">
                    Posted: <?php echo e($announcement->created_at->format('M d, Y h:i A')); ?>

                </small>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.resident', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\WEB-barangay\resources\views/resident/announcement.blade.php ENDPATH**/ ?>
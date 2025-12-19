


<?php $__env->startSection('content'); ?>
    <h1>Admin Dashboard</h1>

    <div class="placeholder-box" style="margin-bottom: 20px;">
        <h2>Announcements</h2>
        <p>Manage all announcements from here. <a href="<?php echo e(route('admin.announcements.index')); ?>">View Announcements</a></p>
    </div>

    <div class="placeholder-box" style="margin-bottom: 20px;">
        <h2>All Requests</h2>
        <p>View and manage all requests submitted by residents. <a href="<?php echo e(route('admin.all_requests')); ?>">View Requests</a></p>
    </div>

    <div class="placeholder-box">
        <h2>Create Announcement</h2>
        <p>Quickly create a new announcement. <a href="<?php echo e(route('admin.announcements.create')); ?>">Create Now</a></p>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\WEB-barangay\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>
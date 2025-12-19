

<?php $__env->startSection('content'); ?>
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Announcements</h1>

    <!-- Success message -->
    <?php if(session('success')): ?>
        <div class="bg-green-100 text-green-800 p-4 rounded mb-4">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <!-- Create Announcement Button -->
    <div class="mb-4">
        <a href="<?php echo e(route('admin.announcements.create')); ?>" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Create Announcement
        </a>
    </div>

    <?php if($announcements->isEmpty()): ?>
        <p>No announcements yet.</p>
    <?php else: ?>
        <div class="space-y-4">
            <?php $__currentLoopData = $announcements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $announcement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="border rounded p-4 bg-white shadow-sm">
                    <div class="flex justify-between items-start">
                        <div>
                            <h2 class="text-xl font-semibold"><?php echo e($announcement->title); ?></h2>
                            <p class="text-gray-600 text-sm">Posted on <?php echo e($announcement->created_at->format('F d, Y h:i A')); ?></p>
                            <p class="mt-2"><?php echo e($announcement->message); ?></p>
                        </div>
                        <div>
                            <form action="<?php echo e(route('admin.announcements.destroy', $announcement->id)); ?>" method="POST" onsubmit="return confirm('Are you sure you want to delete this announcement?');">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\WEB-barangay\resources\views/admin/announcement.blade.php ENDPATH**/ ?>
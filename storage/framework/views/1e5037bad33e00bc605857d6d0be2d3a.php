

<?php $__env->startSection('content'); ?>
<h1>My Requests</h1>

<?php if(session('success')): ?>
    <div style="color: green; margin-bottom: 15px;"><?php echo e(session('success')); ?></div>
<?php endif; ?>

<?php if($requests->isEmpty()): ?>
    <p>You have no requests yet.</p>
<?php else: ?>
    <div style="display: flex; flex-wrap: wrap; gap: 20px;">
        <?php $__currentLoopData = $requests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $request): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div style="background-color: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); width: 300px;">
                <h3 style="margin-top:0;">Purpose: <?php echo e($request->purpose); ?></h3>
                <p><?php echo e($request->message); ?></p>
                
                <div style="margin-bottom: 10px;">
                    <img src="<?php echo e(asset('storage/' . $request->id_image)); ?>" alt="ID Image" style="width:100%; border-radius: 5px;">
                </div>
                
                <p>Status: 
                    <?php if($request->status === 'pending'): ?>
                        <span style="color: #ffc107;">Pending</span>
                    <?php elseif($request->status === 'approved'): ?>
                        <span style="color: #28a745;">Approved</span>
                    <?php elseif($request->status === 'rejected'): ?>
                        <span style="color: #dc3545;">Rejected</span>
                    <?php endif; ?>
                </p>

                <?php if($request->status === 'pending'): ?>
                    <form action="<?php echo e(route('resident.my_requests.delete', $request->id)); ?>" method="POST" onsubmit="return confirm('Are you sure you want to delete this request?');">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" style="background-color:#dc3545;color:white;padding:8px 12px;border:none;border-radius:5px;cursor:pointer;">Delete</button>
                    </form>
                <?php endif; ?>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.resident', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\WEB-barangay\resources\views/resident/my_requests.blade.php ENDPATH**/ ?>
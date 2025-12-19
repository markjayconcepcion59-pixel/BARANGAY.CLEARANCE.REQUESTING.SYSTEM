

<?php $__env->startSection('content'); ?>
<h1>All Requests</h1>

<?php if(session('success')): ?>
    <div style="color: green; margin-bottom: 15px;"><?php echo e(session('success')); ?></div>
<?php endif; ?>

<div style="max-height: 600px; overflow-y: auto;">
    <?php $__currentLoopData = $requests->groupBy('user_id'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $userId => $userRequests): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div style="margin-bottom: 30px;">
            <h2>User: <?php echo e($userRequests->first()->user->name); ?> (<?php echo e($userRequests->first()->user->email); ?>)</h2>
            <?php $__currentLoopData = $userRequests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $req): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div style="background-color:#fff; padding:15px; margin-bottom:10px; border-radius:8px; box-shadow:0 0 5px rgba(0,0,0,0.1);">
                    <h3>Purpose: <?php echo e($req->purpose); ?></h3>
                    <p><?php echo e($req->message); ?></p>
                    <div style="margin-bottom:10px;">
                        <?php if($req->id_image): ?>
                            <img src="<?php echo e(asset('storage/' . $req->id_image)); ?>" 
                                 alt="ID Image" 
                                 style="width:100%; max-width:300px; border-radius:5px;">
                        <?php else: ?>
                            <p style="color:red;">No ID Image uploaded</p>
                        <?php endif; ?>
                    </div>
                    <p>Status: 
                        <?php if($req->status === 'pending'): ?>
                            <span style="color: #ffc107;">Pending</span>
                        <?php elseif($req->status === 'approved'): ?>
                            <span style="color: #28a745;">Done</span>
                        <?php elseif($req->status === 'rejected'): ?>
                            <span style="color: #dc3545;">Rejected</span>
                        <?php endif; ?>
                    </p>

                    
                    <?php if($req->status === 'pending'): ?>
                        <form action="<?php echo e(route('admin.all_requests.update_status', [$req->id, 'approved'])); ?>" method="POST" style="display:inline;">
                            <?php echo csrf_field(); ?>
                            <button type="submit" style="background-color:#28a745;color:white;padding:5px 10px;border:none;border-radius:5px;cursor:pointer;">Mark as Done</button>
                        </form>
                        <form action="<?php echo e(route('admin.all_requests.update_status', [$req->id, 'rejected'])); ?>" method="POST" style="display:inline;">
                            <?php echo csrf_field(); ?>
                            <button type="submit" style="background-color:#dc3545;color:white;padding:5px 10px;border:none;border-radius:5px;cursor:pointer;">Reject</button>
                        </form>
                    <?php endif; ?>

                    
                    <?php if(in_array($req->status, ['approved', 'rejected'])): ?>
                        <form action="<?php echo e(route('admin.all_requests.delete', $req->id)); ?>" method="POST" style="display:inline; margin-top:5px;">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button onclick="return confirm('Are you sure you want to delete this request?')" style="padding:6px 12px; background:#dc3545; border:none; color:white; border-radius:4px; cursor:pointer;">
                                Delete
                            </button>
                        </form>
                    <?php endif; ?>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\WEB-barangay\resources\views/admin/all_requests.blade.php ENDPATH**/ ?>
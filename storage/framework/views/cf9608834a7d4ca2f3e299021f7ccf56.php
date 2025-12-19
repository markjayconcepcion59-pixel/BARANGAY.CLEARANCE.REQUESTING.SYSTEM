

<?php $__env->startSection('content'); ?>
<h1>Create Clearance Request</h1>

<?php if(session('success')): ?>
    <div style="color:green; margin-bottom:10px;">
        <?php echo e(session('success')); ?>

    </div>
<?php endif; ?>

<?php if($errors->any()): ?>
    <div style="background-color:#f8d7da; color:#842029; padding:10px; margin-bottom:15px; border-radius:5px;">
        <ul>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php endif; ?>

<form method="POST" action="<?php echo e(route('resident.create_request.submit')); ?>" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>

    <label for="purpose">Purpose:</label><br>
    <input type="text" name="purpose" id="purpose" placeholder="Purpose" required style="width:100%; padding:8px; margin-bottom:10px;"><br>

    <label for="message">Message/Details:</label><br>
    <textarea name="message" id="message" placeholder="Enter details" required style="width:100%; padding:8px; margin-bottom:10px;"></textarea><br>

    <label for="id_image">Upload ID:</label><br>
    <input type="file" name="id_image" id="id_image" accept="image/*" required style="margin-bottom:15px;"><br>

    <button type="submit" style="padding:10px 20px; background-color:#007bff; color:white; border:none; border-radius:5px; cursor:pointer;">
        Submit Request
    </button>
</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.resident', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\WEB-barangay\resources\views/resident/create_request.blade.php ENDPATH**/ ?>
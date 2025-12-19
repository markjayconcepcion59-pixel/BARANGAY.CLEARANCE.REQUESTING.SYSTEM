<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
        }

        .sidebar {
            width: 220px;
            background-color: #007bff;
            height: 100vh;
            position: fixed;
            color: white;
            padding-top: 20px;
        }

        .sidebar a {
            display: block;
            color: white;
            padding: 12px 20px;
            text-decoration: none;
        }

        .sidebar a:hover {
            background-color: #0056b3;
        }

        .content {
            margin-left: 220px;
            padding: 30px;
        }

        h1 {
            color: #333;
        }

        .placeholder-box {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        .logout-form {
            margin-top: 20px;
            padding: 0 20px;
        }

        .logout-form button {
            width: 100%;
            padding: 10px;
            background-color: #dc3545;
            border: none;
            color: white;
            border-radius: 5px;
            cursor: pointer;
        }

        .logout-form button:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>

    <div class="sidebar">
        <h2 style="text-align:center;">Admin</h2>
        <a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a>
        <a href="<?php echo e(route('admin.announcements.index')); ?>">Announcements</a>
        <a href="<?php echo e(route('admin.announcements.create')); ?>">Create Announcement</a>
        <a href="<?php echo e(route('admin.all_requests')); ?>">All Requests</a>

        <form method="POST" action="<?php echo e(route('logout')); ?>" class="logout-form">
            <?php echo csrf_field(); ?>
            <button type="submit">Logout</button>
        </form>
    </div>

    <div class="content">
        <?php echo $__env->yieldContent('content'); ?>
    </div>

</body>
</html>
<?php /**PATH D:\WEB-barangay\resources\views/layouts/admin.blade.php ENDPATH**/ ?>
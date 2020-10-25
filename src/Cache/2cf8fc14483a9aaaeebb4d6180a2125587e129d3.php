<br>
<center><h2 class="title is-2">Edit <?php echo e($user_info->username); ?></h2></center>
<br>
<div class="columns is-centered">
    <form class="column is-one-quarter" name="register" method="POST" enctype="multipart/form-data">
        <div class="field">
            <label class="label">Username</label>
            <div class="control">
                <input class="input" type="text" name="username" value="<?php echo e($user_info->username); ?>">
            </div>

            <?php if($errors && $errors['username']['is_error']): ?>
                <?php $__currentLoopData = $errors['username']['errors_list']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <small class="has-text-danger"><?php echo e($error); ?></small><br>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </div>

        <div class="field">
            <label class="label">Email</label>
            <div class="control">
                <input class="input" type="text" name="email" value="<?php echo e($user_info->email); ?>">
            </div>

            <?php if($errors && $errors['email']['is_error']): ?>
                <?php $__currentLoopData = $errors['email']['errors_list']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <small class="has-text-danger"><?php echo e($error); ?></small><br>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </div>

        <div class="field">
            <label class="label">Password</label>
            <div class="control">
                <input class="input" type="password" name="password" value="">
            </div>

            <?php if($errors && $errors['password']['is_error']): ?>
                <?php $__currentLoopData = $errors['password']['errors_list']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <small class="has-text-danger"><?php echo e($error); ?></small><br>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </div>

        <div class="field">
            <label class="label">Image</label>
            <img class="image" src="src/Storage/Images/<?php echo e($user_info->image); ?>" width="150px"/>
            <br>
            <div class="control">
                <input type="file" name="image">
            </div>

            <?php if($errors && $errors['image']['is_error']): ?>
                <?php $__currentLoopData = $errors['image']['errors_list']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <small class="has-text-danger"><?php echo e($error); ?></small><br>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </div>

        <div class="field">
            <label class="label">User description</label>
            <textarea  class="textarea" placeholder="About you." name="user_desc"><?php echo e($user_info->user_desc); ?></textarea>

            <?php if($errors && $errors['user_desc']['is_error']): ?>
                <?php $__currentLoopData = $errors['user_desc']['errors_list']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <small class="has-text-danger"><?php echo e($error); ?></small><br>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </div>

        <div class="field is-grouped">
            <div class="control">
                <button class="button is-link">Submit</button>
            </div>
        </div>
    </form>
</div>
<?php /**PATH C:\xampp\htdocs\yourlaravel\src\Views/Edit.blade.php ENDPATH**/ ?>
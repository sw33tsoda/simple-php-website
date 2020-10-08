<br>
<center><h2 class="title is-2">Register</h2></center>
<br>

<div class="columns is-centered">
    <form class="column is-one-quarter" name="register" method="POST" enctype="multipart/form-data">
        <div class="field">
            <label class="label">Username</label>
            <div class="control">
                <input class="input" type="text" name="username">
            </div>

            <?php if($errors && $errors['username']['is_error']): ?>
                <?php $__currentLoopData = $errors['username']['errors_list']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <small class="has-text-danger"><?php echo e($error); ?></small><br>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </div>

        <div class="field">
            <label class="label">Password</label>
            <div class="control">
                <input class="input" type="password" name="password">
            </div>

            <?php if($errors && $errors['password']['is_error']): ?>
                <?php $__currentLoopData = $errors['password']['errors_list']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <small class="has-text-danger"><?php echo e($error); ?></small><br>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </div>

        <div class="field">
            <label class="label">Re-enter password</label>
            <div class="control">
                <input class="input" type="password" name="password_confirmation">
            </div>
        </div>

        <div class="field">
            <label class="label">Image</label>  
            <div class="control">
                <input type="file" name="image">
            </div>
        </div>

        <div class="field is-grouped">
            <div class="control">
                <button class="button is-link">Submit</button>
            </div>
        </div>
    </form>
</div>
<?php /**PATH C:\xampp\htdocs\yourlaravel\src\Views/Register.blade.php ENDPATH**/ ?>
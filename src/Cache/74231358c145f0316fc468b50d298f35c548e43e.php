<br>
<center><h2 class="title is-2">Add post</h2></center>
<br>

<div class="columns is-centered">
    <form class="column is-one-quarter" name="register" method="POST" enctype="multipart/form-data">
        <div class="field">
            <label class="label">Title</label>
            <div class="control">
                <input class="input" type="text" name="title">
            </div>

            <?php if($errors && $errors['title']['is_error']): ?>
                <?php $__currentLoopData = $errors['title']['errors_list']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <small class="has-text-danger"><?php echo e($error); ?></small><br>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </div>
        
        <div class="field">
            <label class="label">Content</label>
            <div class="control">
                <textarea class="textarea" placeholder="Say something..." name="content"></textarea>
                <small style="font-style:italic">Mind your words.</small>
            </div>

            <?php if($errors && $errors['content']['is_error']): ?>
                <?php $__currentLoopData = $errors['content']['errors_list']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <small class="has-text-danger"><?php echo e($error); ?></small><br>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </div>

        <div class="field">
            <label class="label">Image</label>  
            <div class="control">
                <input type="file" name="image">
            </div>

            <?php if($errors && $errors['image']['is_error']): ?>
                <?php $__currentLoopData = $errors['image']['errors_list']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <small class="has-text-danger"><?php echo e($error); ?></small><br>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </div>
        
        <button type="submit" class="button is-success">Submit</button>
    </form>
</div>
<?php /**PATH C:\xampp\htdocs\yourlaravel\src\Views/AddPost.blade.php ENDPATH**/ ?>
<br>

<div class="columns is-multiline">
    <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php {{
        $post['created_at'] = date_format(date_create($post['created_at']),'d/m/Y - H:i:s');
    }} ?>
    <div class="column is-full mt-5">
        <div class="card">
            <div class="card-content columns">
                <div class="column is-3">
                    <img src="src/Storage/Images/<?php echo e($post['image']); ?>" alt="Placeholder image">
                </div>
                <div class="column is-9">
                    <div class="media">
                        <div class="media-left">
                            <figure class="image is-48x48">
                                <img src="src/Storage/Images/<?php echo e($post['avatar']); ?>" alt="Placeholder image">
                            </figure>
                        </div>
                        <div class="media-content">
                            <p class="title is-4"><?php echo e($post['title']); ?></p>
                            <p class="subtitle is-6"><?php echo e($post['created_at']); ?> by <a href="#"><?php echo e($post['username']); ?></a></p>
                        </div>
                    </div>
                
                    <div class="content">
                    <?php echo e($post['content']); ?>

                    </div>

                    <?php if(isset($_SESSION['user'])): ?>
                        <?php if($_SESSION['user']['id'] == $post['user_id']): ?>
                            <a href="/?site=remove_post&post_id=<?php echo e($post['id']); ?>">Remove</a>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php /**PATH C:\xampp\htdocs\yourlaravel\src\Views/MyPost.blade.php ENDPATH**/ ?>
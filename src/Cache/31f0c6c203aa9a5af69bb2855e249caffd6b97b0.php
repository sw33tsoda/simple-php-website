<br>
<br>

<div class="card">
    <div class="card-content" style="padding-bottom:3em">
        <div class="has-text-centered">
            <p class="title is-3 is-spaced"><?php echo e($post->title); ?></p>
        </div>
        
        <div class="card-image has-text-centered">
            <figure class="image column is-3 is-inline-block">
                <img src="src/Storage/Images/<?php echo e($post->image); ?>"/>
            </figure>
        </div>

        <div class="content">
            <?php echo e($post->content); ?>

        </div>
        <p class="subtitle is-6 is-pulled-right"><?php echo e(date_format(date_create($post->created_at),'d/m/Y - H:i:s')); ?> by <a href="/?site=user_profile&id=<?php echo e($post->user_id); ?>"><?php echo e($post->username); ?></a></p>
        
    </div>
</div>
<br/>
<div id="comment"></div>
<br/>

<script type="text/babel"  src="src/Views/CommentSection/index.js"></script>
<?php if(isset($_SESSION['user'])): ?>
<script type="text/babel">
  const user_info = {
    user_id:  "<?php echo e($_SESSION['user']['id']); ?>",
    post_id:  "<?php echo e($post->id); ?>",
    image:  "<?php echo e($_SESSION['user']['image']); ?>",
  };
</script>
<?php else: ?>
<script type="text/babel">
  const user_info = {
    post_id:  "<?php echo e($post->id); ?>",
  };
</script>
<?php endif; ?>
<script type="text/babel">
  const comment = document.querySelector('#comment');
  ReactDOM.render(<CommentSection data={user_info}/>,comment);
</script><?php /**PATH C:\xampp\htdocs\yourlaravel\src\Views/ShowPost.blade.php ENDPATH**/ ?>
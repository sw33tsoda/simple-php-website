<br>

<div>
    <div class="section profile-heading">
      <div class="columns is-mobile is-multiline">
        <div class="column is-2">
          <span class="header-icon user-profile-image">
            <img class="is-rounded" src="/src/Storage/Images/<?php echo e($user_info->image); ?>"/>
          </span>
        </div>
        <div class="column is-4-tablet is-10-mobile name">
          <p>
            <span class="title is-bold"><?php echo e($user_info->username); ?></span>
            <br>
            <br>
          </p>
          <p class="tagline">
            <?php echo e($user_info->user_desc); ?>

          </p>
        </div>
        <div class="column is-3-tablet is-5-mobile has-text-centered">
          <p class="stat-val has-text-weight-bold is-size-1"></p>
          <p class="stat-key label"></p>
        </div>
        <div class="column is-3-tablet is-5-mobile has-text-centered">
          <p class="stat-val has-text-weight-bold is-size-1"><?php echo e($user_info->total_posts); ?></p>
          <p class="stat-key label">Posts</p>
        </div>
      </div>
    </div>

    <?php while($post = $user_posts->fetch_object()): ?>
      <?php {{
          $post->created_at = date_format(date_create($post->created_at),'d/m/Y - H:i:s');
      }} ?>
      <div class="column is-full mt-5">
          <div class="card">
              <div class="card-content columns">
                  <div class="column is-3">
                      <img src="src/Storage/Images/<?php echo e($post->image); ?>" alt="Placeholder image">
                  </div>
                  <div class="column is-9">
                      <div class="media">
                          <div class="media-left">
                              <figure class="image is-48x48">
                                  <img src="src/Storage/Images/<?php echo e($post->avatar); ?>" alt="Placeholder image">
                              </figure>
                          </div>
                          <div class="media-content">
                              <a href="/?site=show_post&post_id=<?php echo e($post->id); ?>"><p class="title is-4"><?php echo e($post->title); ?></p></a>
                              <p class="subtitle is-6"><?php echo e($post->created_at); ?> by <a href="/?site=user_profile&id=<?php echo e($post->user_id); ?>"><?php echo e($post->username); ?></a></p>
                          </div>
                      </div>
                  
                      <div class="content">
                      <?php echo e($post->content); ?>

                      </div>

                      <?php if(isset($_SESSION['user'])): ?>
                          <?php if($_SESSION['user']['id'] == $post->user_id): ?>
                              <a href="/?site=remove_post&post_id=<?php echo e($post->id); ?>">Remove</a>
                          <?php endif; ?>
                      <?php endif; ?>
                  </div>
              </div>
          </div>
      </div>
    <?php endwhile; ?>
</div><?php /**PATH D:\XAMPP\htdocs\laravelproject\src\Views/UserProfile.blade.php ENDPATH**/ ?>
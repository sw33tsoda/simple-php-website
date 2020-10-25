<br>

<div>
    <div class="section profile-heading">
      <div class="columns is-mobile is-multiline">
        <div class="column is-2">
          <span class="header-icon user-profile-image">
            <img class="is-rounded" src="/src/Storage/Images/{{$user_info->image}}"/>
          </span>
        </div>
        <div class="column is-4-tablet is-10-mobile name">
          <p>
            <span class="title is-bold">{{$user_info->username}}</span>
            <br>
            <br>
          </p>
          <p class="tagline">
            {{$user_info->user_desc}}
          </p>
        </div>
        <div class="column is-3-tablet is-5-mobile has-text-centered">
          <p class="stat-val has-text-weight-bold is-size-1">{{$user_info->total_posts}}</p>
          <p class="stat-key label">Posts</p>
        </div>
        <div class="column is-3-tablet is-5-mobile has-text-centered">
          <p class="stat-val has-text-weight-bold is-size-1">10</p>
          <p class="stat-key label">likes</p>
        </div>
      </div>
    </div>

    @while ($post = $user_posts->fetch_object())
      @php {{
          $post->created_at = date_format(date_create($post->created_at),'d/m/Y - H:i:s');
      }} @endphp
      <div class="column is-full mt-5">
          <div class="card">
              <div class="card-content columns">
                  <div class="column is-3">
                      <img src="src/Storage/Images/{{$post->image}}" alt="Placeholder image">
                  </div>
                  <div class="column is-9">
                      <div class="media">
                          <div class="media-left">
                              <figure class="image is-48x48">
                                  <img src="src/Storage/Images/{{$post->avatar}}" alt="Placeholder image">
                              </figure>
                          </div>
                          <div class="media-content">
                              <a href="/?site=show_post&post_id={{$post->id}}"><p class="title is-4">{{$post->title}}</p></a>
                              <p class="subtitle is-6">{{$post->created_at}} by <a href="/?site=user_profile&id={{$post->user_id}}">{{$post->username}}</a></p>
                          </div>
                      </div>
                  
                      <div class="content">
                      {{$post->content}}
                      </div>

                      @isset($_SESSION['user'])
                          @if ($_SESSION['user']['id'] == $post->user_id)
                              <a href="/?site=remove_post&post_id={{$post->id}}">Remove</a>
                          @endif
                      @endisset
                  </div>
              </div>
          </div>
      </div>
    @endwhile
</div>
<br>
<br>

<div class="card">
    <div class="card-content" style="padding-bottom:3em">
        <div class="has-text-centered">
            <p class="title is-3 is-spaced">{{$post->title}}</p>
        </div>
        
        <div class="card-image has-text-centered">
            <figure class="image column is-3 is-inline-block">
                <img src="src/Storage/Images/{{$post->image}}"/>
            </figure>
        </div>

        <div class="content">
            {{$post->content}}
        </div>
        <p class="subtitle is-6 is-pulled-right">{{date_format(date_create($post->created_at),'d/m/Y - H:i:s')}} by <a href="/?site=user_profile&id={{$post->user_id}}">{{$post->username}}</a></p>
        
    </div>
</div>
<br/>
<div id="comment"></div>
<br/>

<script type="text/babel"  src="src/Views/Comment/index.js"></script>
@if (isset($_SESSION['user']))
<script type="text/babel">
  const user_info = {
    user_id:  "{{$_SESSION['user']['id']}}",
    post_id:  "{{$post->id}}",
    image:  "{{$_SESSION['user']['image']}}",
  };
</script>
@else
<script type="text/babel">
  const user_info = {
    post_id:  "{{$post->id}}",
  };
</script>
@endif
<script type="text/babel">
  const comment = document.querySelector('#comment');
  ReactDOM.render(<Comment data={user_info}/>,comment);
</script>
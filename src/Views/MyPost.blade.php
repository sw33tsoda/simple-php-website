<br>

<div class="columns is-multiline">
    @foreach ($posts as $post)
    @php {{
        $post['created_at'] = date_format(date_create($post['created_at']),'d/m/Y - H:i:s');
    }} @endphp
    <div class="column is-full mt-5">
        <div class="card">
            <div class="card-content columns">
                <div class="column is-3">
                    <img src="src/Storage/Images/{{$post['image']}}" alt="Placeholder image">
                </div>
                <div class="column is-9">
                    <div class="media">
                        <div class="media-left">
                            <figure class="image is-48x48">
                                <img src="src/Storage/Images/{{$post['avatar']}}" alt="Placeholder image">
                            </figure>
                        </div>
                        <div class="media-content">
                            <p class="title is-4">{{$post['title']}}</p>
                            <p class="subtitle is-6">{{$post['created_at']}} by <a href="#">{{$post['username']}}</a></p>
                        </div>
                    </div>
                
                    <div class="content">
                    {{$post['content']}}
                    </div>

                    @isset($_SESSION['user'])
                        @if ($_SESSION['user']['id'] == $post['user_id'])
                            <a href="/?site=remove_post&post_id={{$post['id']}}">Remove</a>
                        @endif
                    @endisset
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

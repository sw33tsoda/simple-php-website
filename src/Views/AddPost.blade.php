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

            @if ($errors && $errors['title']['is_error'])
                @foreach ($errors['title']['errors_list'] as $error)
                    <small class="has-text-danger">{{$error}}</small><br>
                @endforeach
            @endif
        </div>
        
        <div class="field">
            <label class="label">Content</label>
            <div class="control">
                <textarea class="textarea" placeholder="Say something..." name="content"></textarea>
                <small style="font-style:italic">Mind your words.</small>
            </div>

            @if ($errors && $errors['content']['is_error'])
                @foreach ($errors['content']['errors_list'] as $error)
                    <small class="has-text-danger">{{$error}}</small><br>
                @endforeach
            @endif
        </div>

        <div class="field">
            <label class="label">Image</label>  
            <div class="control">
                <input type="file" name="image">
            </div>

            @if ($errors && $errors['image']['is_error'])
                @foreach ($errors['image']['errors_list'] as $error)
                    <small class="has-text-danger">{{$error}}</small><br>
                @endforeach
            @endif
        </div>
        
        <button type="submit" class="button is-success">Submit</button>
    </form>
</div>

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

            @if ($errors && $errors['username']['is_error'])
                @foreach ($errors['username']['errors_list'] as $error)
                    <small class="has-text-danger">{{$error}}</small><br>
                @endforeach
            @endif
        </div>

        <div class="field">
            <label class="label">Password</label>
            <div class="control">
                <input class="input" type="password" name="password">
            </div>

            @if ($errors && $errors['password']['is_error'])
                @foreach ($errors['password']['errors_list'] as $error)
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

        <div class="field is-grouped">
            <div class="control">
                <button class="button is-link">Submit</button>
            </div>
        </div>
    </form>
</div>

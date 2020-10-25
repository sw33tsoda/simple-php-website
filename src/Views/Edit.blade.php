<br>
<center><h2 class="title is-2">Edit {{$user_info->username}}</h2></center>
<br>
<div class="columns is-centered">
    <form class="column is-one-quarter" name="register" method="POST" enctype="multipart/form-data">
        <div class="field">
            <label class="label">Username</label>
            <div class="control">
                <input class="input" type="text" name="username" value="{{$user_info->username}}">
            </div>

            @if ($errors && $errors['username']['is_error'])
                @foreach ($errors['username']['errors_list'] as $error)
                    <small class="has-text-danger">{{$error}}</small><br>
                @endforeach
            @endif
        </div>

        <div class="field">
            <label class="label">Email</label>
            <div class="control">
                <input class="input" type="text" name="email" value="{{$user_info->email}}">
            </div>

            @if ($errors && $errors['email']['is_error'])
                @foreach ($errors['email']['errors_list'] as $error)
                    <small class="has-text-danger">{{$error}}</small><br>
                @endforeach
            @endif
        </div>

        <div class="field">
            <label class="label">Password</label>
            <div class="control">
                <input class="input" type="password" name="password" value="">
            </div>

            @if ($errors && $errors['password']['is_error'])
                @foreach ($errors['password']['errors_list'] as $error)
                    <small class="has-text-danger">{{$error}}</small><br>
                @endforeach
            @endif
        </div>

        <div class="field">
            <label class="label">Image</label>
            <img class="image" src="src/Storage/Images/{{$user_info->image}}" width="150px"/>
            <br>
            <div class="control">
                <input type="file" name="image">
            </div>

            @if ($errors && $errors['image']['is_error'])
                @foreach ($errors['image']['errors_list'] as $error)
                    <small class="has-text-danger">{{$error}}</small><br>
                @endforeach
            @endif
        </div>

        <div class="field">
            <label class="label">User description</label>
            <textarea  class="textarea" placeholder="About you." name="user_desc">{{$user_info->user_desc}}</textarea>

            @if ($errors && $errors['user_desc']['is_error'])
                @foreach ($errors['user_desc']['errors_list'] as $error)
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

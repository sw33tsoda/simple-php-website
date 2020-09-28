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
        </div>

        <div class="field">
            <label class="label">Password</label>
            <div class="control">
                <input class="input" type="text" name="password" value="">
            </div>
        </div>

        <div class="field">
            <label class="label">Re-enter password</label>
            <div class="control">
                <input class="input" type="text" name="password_confirmation">
            </div>
        </div>

        <div class="field">
            <label class="label">Image</label>
            <img class="image" src="src/Storage/Images/{{$user_info->image}}" width="150px"/>
            <div class="control">
                <input type="file" name="image" value="{{$user_info->image}}">
            </div>
        </div>

        <div class="field is-grouped">
            <div class="control">
                <button class="button is-link">Submit</button>
            </div>
        </div>
    </form>
</div>

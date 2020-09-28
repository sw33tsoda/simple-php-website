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
        </div>

        <div class="field">
            <label class="label">Password</label>
            <div class="control">
                <input class="input" type="text" name="password">
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
            <div class="control">
                <input type="file" name="image">
            </div>
        </div>

        <div class="field is-grouped">
            <div class="control">
                <button class="button is-link">Submit</button>
            </div>
        </div>
    </form>
</div>

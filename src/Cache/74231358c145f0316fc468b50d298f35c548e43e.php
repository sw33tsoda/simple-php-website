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
        </div>
        
        <div class="field">
            <label class="label">Content</label>
            <div class="control">
                <textarea class="textarea" placeholder="Say something..." name="content"></textarea>
                <small style="font-style:italic">Mind your words.</small>
            </div>
        </div>

        <div class="field">
            <label class="label">Image</label>  
            <div class="control">
                <input type="file" name="image">
            </div>
        </div>
        
        <button type="submit" class="button is-success">Submit</button>
    </form>
</div>
<?php /**PATH C:\xampp\htdocs\yourlaravel\src\Views/AddPost.blade.php ENDPATH**/ ?>
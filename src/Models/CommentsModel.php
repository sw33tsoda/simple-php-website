<?php
namespace Models;
use Database\DBConnection;
use Carbon\Carbon;

class CommentsModel extends DBConnection {
    function add($info) {
        $data = (object) $info;
        $created_at = Carbon::now();
        $sql = "INSERT INTO comments (`user_id`,`post_id`,`comment`,`created_at`) VALUES ('$data->user_id','$data->post_id','$data->comment','$created_at')";
        return $this->connection->query($sql);
    }

    function getAll($post_id) {
        $sql = "SELECT comments.*,users.username,users.image as 'avatar' FROM comments,users WHERE post_id = $post_id AND users.id = comments.user_id ORDER BY created_at DESC LIMIT 10";
        return $this->connection->query($sql);
    }
}
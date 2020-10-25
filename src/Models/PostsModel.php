<?php

namespace Models;
use Database\DBConnection;
use Carbon\Carbon;

class PostsModel extends DBConnection {

    function getAll() {
        $sql = "SELECT posts.*,users.username,users.image as 'avatar' FROM posts,users WHERE posts.user_id = users.id ORDER BY posts.created_at DESC";
        return $this->connection->query($sql);
    }

    function getByUserId($id) {
        $sql = "SELECT posts.*,users.username,users.image as 'avatar' FROM posts,users WHERE posts.user_id = users.id AND posts.user_id = $id ORDER BY posts.created_at DESC";
        return $this->connection->query($sql);
    }

    function getByPostId($id) {
        $sql = "SELECT posts.*,users.username,users.image as 'avatar' FROM posts,users WHERE posts.user_id = users.id AND posts.id = $id ORDER BY posts.created_at DESC";
        return $this->connection->query($sql);
    }

    function add($info) {
        $data = (object) $info;
        $created_at = Carbon::now();
        $sql = "INSERT INTO posts (`user_id`,`title`,`content`,`image`,`created_at`) VALUES ('$data->user_id','$data->title','$data->content','$data->image','$created_at')";
        return $this->connection->query($sql);
    }

    function remove($info) {
        $data = (object) $info;
        $sql = "DELETE FROM posts WHERE posts.id = $data->post_id AND posts.user_id = $data->user_id";
        return $this->connection->query($sql);
    }
}
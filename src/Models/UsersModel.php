<?php

namespace Models;
use Database\DBConnection;
use Carbon\Carbon;

class UsersModel extends DBConnection {

    function getUserProfileById($id) {
        $sql = "SELECT users.*,count(posts.id) as 'total_posts' FROM users,posts WHERE users.id = $id AND posts.user_id = $id LIMIT 1";
        return $this->connection->query($sql);
    }

    function register($info) {
        $data = (object) $info;
        $created_at = Carbon::now();
        $sql = "INSERT INTO users (`username`,`email`,`user_desc`,`password`,`image`,`created_at`) VALUES ('$data->username','$data->email','$data->user_desc','$data->password','$data->image','$created_at')";
        return $this->connection->query($sql);
    }

    function login($info) {
        $data = (object) $info;
        $sql = "SELECT * FROM users WHERE `email` = '$data->email' AND `password` = '$data->password' LIMIT 1";
        return $this->connection->query($sql); 
    }

    function edit($info) {
        $data = (object) $info;
        $sql = "UPDATE `users` SET `username`= '$data->username',`email`= '$data->email',`user_desc`= '$data->user_desc',`password`= '$data->password',`image`='$data->image' WHERE `id` = $data->id";
        return $this->connection->query($sql);
    }
}

?>
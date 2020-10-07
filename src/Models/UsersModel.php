<?php

namespace Models;
use Database\DBConnection;

class UsersModel extends DBConnection {

    function getUserProfileById($id) {
        $sql = "SELECT * FROM users WHERE `id` = $id LIMIT 1";
        return $this->connection->query($sql);
    }

    function register($info) {
        $data = (object) $info;
        $sql = "INSERT INTO users (`username`,`password`,`image`) VALUES ('$data->username','$data->password','$data->image')";
        return $this->connection->query($sql);
    }

    function login($info) {
        $data = (object) $info;
        $sql = "SELECT * FROM users WHERE `username` = '$data->username' AND `password` = '$data->password' LIMIT 1";
        return $this->connection->query($sql); 
    }

    function edit($info) {
        $data = (object) $info;
        $sql = "UPDATE `users` SET `username`= '$data->username',`password`= '$data->password',`image`='$data->image' WHERE `id` = $data->id";
        return $this->connection->query($sql);
    }
}

?>
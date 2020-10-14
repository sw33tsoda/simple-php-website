<?php 

namespace Database;

class DBConnection {
    protected $connection;
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "sw33tsoda_php_mvc";
    
    function __construct() {
        $this->connect();

        $create_database_sql = "CREATE DATABASE $this->database";
        $create = $this->connection->query($create_database_sql);
        $this->connection->select_db($this->database);

        if ($create) {
            foreach ($this->create_tables() as $sql) {
                $this->connection->query($sql);
            }
        }
    }

    private function create_tables() {
        return [
            'users' => "CREATE TABLE users (
                `id` int PRIMARY KEY NOT NULL AUTO_INCREMENT,
                `username` varchar(64),
                `password` varchar(64),
                `image` varchar(64),
                `created_at` datetime
            )",

            'posts' => "CREATE TABLE posts (
                `id` int PRIMARY KEY NOT NULL AUTO_INCREMENT,
                `user_id` int UNIQUE NOT NULL,
                `title` varchar(512),
                `content` varchar(4096),
                `image` varchar(64),
                `created_at` datetime
            )",
        ];
    }

    protected function connect() {
        $this->connection = @new \mysqli($this->servername,$this->username,$this->password);
        if ($this->connection->connect_error) {
            die("FAILED TO CONNECT TO DATABASE");
        } else {
            $this->connection->set_charset('utf-8');
            return $this->connection;
        }
    }
}

?>
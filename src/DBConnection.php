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
            echo 'reached';
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
                `email` varchar(64),
                `user_desc` varchar(512),
                `password` varchar(64),
                `image` varchar(64),
                `created_at` datetime
            )",

            'posts' => "CREATE TABLE posts (
                `id` int PRIMARY KEY NOT NULL AUTO_INCREMENT,
                `user_id` int NOT NULL,
                `title` varchar(512),
                `content` varchar(4096),
                `image` varchar(64),
                `created_at` datetime,
                FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
            )",

            'comments' => "CREATE TABLE comments (
                `id` int PRIMARY KEY NOT NULL AUTO_INCREMENT,
                `user_id` int NOT NULL,
                `post_id` int NOT NULL,
                `upvotes` int NOT NULL DEFAULT 0,
                `downvotes` int NOT NULL DEFAULT 0,
                `comment` varchar(1024),
                `created_at` datetime,
                FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
                FOREIGN KEY (post_id) REFERENCES posts(id) ON DELETE CASCADE
            )", 

            'votes' => "CREATE TABLE votes (
                `id` int PRIMARY KEY NOT NULL AUTO_INCREMENT,
                `user_id` int NOT NULL,
                `comment_id` int NOT NULL,
                `is_voted` bit DEFAULT 0,
                `vote_type` varchar(64),
                `created_at` datetime,
                FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
                FOREIGN KEY (comment_id) REFERENCES comments(id) ON DELETE CASCADE
            )"
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
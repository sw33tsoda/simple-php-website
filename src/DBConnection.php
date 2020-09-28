<?php 

namespace Database;

class DBConnection {
    protected $connection;
    
    function __construct() {
        $this->connect();
    }

    protected function connect() {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "php_mvc";
        $this->connection = @new \mysqli($servername,$username,$password,$database);
        if ($this->connection->connect_error) {
            die("FAILED TO CONNECT TO DATABASE");
        } else {
            $this->connection->set_charset('utf-8');
            return $this->connection;
        }
    }
}

?>
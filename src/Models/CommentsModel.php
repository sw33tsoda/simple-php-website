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

    function getAll($params) {
        $latest = "ASC";
        $limit = (int) $params['limit'];
        if ($params['latest'] == 'true') {
            $latest = "DESC";
        }
        $sql = "SELECT comments.*,votes.is_voted,votes.vote_type,users.username,users.image as 'avatar' 
                FROM comments
                LEFT JOIN votes
                ON comments.id = votes.comment_id
                LEFT JOIN users
                ON comments.user_id = users.id
                AND post_id = {$params['post_id']}
                GROUP BY comments.id
                ORDER BY created_at {$latest} 
                LIMIT {$limit}";
        return $this->connection->query($sql);
    }

    function delete($info) {
        $data = (object) $info;
        $sql = "DELETE FROM comments WHERE comments.id = '$data->comment_id' AND comments.user_id = '$data->user_id'";
        $this->connection->query($sql);
        echo $this->connection->error;
    }
}
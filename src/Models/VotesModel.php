<?php

namespace Models;

use Carbon\Carbon;
use Database\DBConnection;

class VotesModel extends DBConnection {
    
    function isExist($data) {
        $sql = "SELECT * FROM votes WHERE votes.comment_id = $data->comment_id AND votes.user_id = $data->user_id AND votes.vote_type = '$data->vote_type' LIMIT 1";
        $result = $this->connection->query($sql);
        $object = $result->fetch_object();
        if ($object == null)
            return [
                'result' => false,
                'is_voted' => null,
            ];
        return [
            'result' => true,
            'is_voted' => $object->is_voted,
        ];
    }

    function vote($info) {
        $data = (object) $info;
        $created_at = Carbon::now();

        if($this->isExist($data)['result']) {
            $is_voted = $this->isExist($data)['is_voted'] ? '0' : '1';
            $sql = "UPDATE `votes` SET `is_voted` = $is_voted WHERE votes.comment_id = '$data->comment_id' AND votes.user_id = '$data->user_id' AND votes.vote_type = '$data->vote_type'";
        } else if (!$this->isExist($data)['result']) {
            $sql = "INSERT INTO votes (`user_id`,`comment_id`,`is_voted`,`vote_type`,`created_at`) VALUES ('$data->user_id','$data->comment_id','1','$data->vote_type','$created_at')";
        }
        $voteChange = $this->connection->query($sql);
        if ($voteChange) {
            $upOrDown = $data->vote_type == 'upvote' ? 'upvotes' : 'downvotes';
            $increaseOrDecrease = $this->isExist($data)['is_voted'] == '1' ? '+' : '-';
            $sql_vote_update = "UPDATE comments SET `$upOrDown` = `$upOrDown` $increaseOrDecrease 1 WHERE comments.id = $data->comment_id AND comments.user_id = $data->user_id";
            $this->connection->query($sql_vote_update);
        }
    }
}
<?php

namespace Models;

use Carbon\Carbon;
use Database\DBConnection;

class VotesModel extends DBConnection {

    function getVotes($info) {
        $data = (object) $info;
        $sql = "SELECT comments.upvotes,comments.downvotes FROM comments WHERE comments.id = '$data->comment_id' AND comments.user_id = '$data->user_id'";
        return $this->connection->query($sql);
    }
    
    function isExist($data) {
        // CHECK IF YOUR VOTE EXISTS OR NOT.
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
        $isExist = $this->isExist($data);

        // IF YOUR VOTE ALREADY EXISTS, START VOTING OR UNVOTING.
        if($isExist['result']) {
            // UNVOTE IF VOTED, VOTE IF UNVOTED.
            $set_is_voted = $isExist['is_voted'] ? '0' : '1';
            $sql = "UPDATE `votes` SET `is_voted` = $set_is_voted WHERE votes.comment_id = '$data->comment_id' AND votes.user_id = '$data->user_id' AND votes.vote_type = '$data->vote_type'";
        // IF YOUR VOTE DOESN'T EXIST IN THE TABLE, CREATE ONE FOR FIRST VOTE. 
        } else if (!$isExist['result']) {
            $sql = "INSERT INTO votes (`user_id`,`comment_id`,`is_voted`,`vote_type`,`created_at`) VALUES ('$data->user_id','$data->comment_id','1','$data->vote_type','$created_at')";
        }

        $voteChange = $this->connection->query($sql);

        // FINAL STEP, INCREASE OR DECREASE THE NUMBER OF VOTES.
        if ($voteChange) {
            // CHECK IF YOUR VOTE IS UPVOTE OR DOWNVOTE.
            $upOrDown = $data->vote_type == 'upvote' ? 'upvotes' : 'downvotes';
            // IF YOU VOTED, YOUR VOTE ON THE COMMENT WILL INCREASE ONE VALUE.
            $increaseOrDecrease = $this->isExist($data)['is_voted'] == '1' ? '+' : '-';
            $sql_vote_update = "UPDATE comments SET `$upOrDown` = `$upOrDown` $increaseOrDecrease 1 WHERE comments.id = $data->comment_id";
            $this->connection->query($sql_vote_update);
        }
    }
}
<?php
namespace Controllers;
use Models\CommentsModel;

class CommentsController extends MainController {
    function add_comment() {
        $model = new CommentsModel;
        $model->add($_POST);
    }

    function get_comment() {
        $model = new CommentsModel;
        $get_comment = $model->getAll($_GET);
        $result = [];
        while ($comment = $get_comment->fetch_assoc()) {
            $comment['created_at'] = date_format(date_create($comment['created_at']),'d/m/Y - H:i:s');
            array_push($result,$comment);
        }
        echo "@JSON@".json_encode($result)."@JSON@";
    }
}
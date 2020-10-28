<?php

namespace Controllers;

use Models\VotesModel;

class VotesController extends MainController {
    function get_votes() {
        $model = new VotesModel;
        $result = $model->getVotes($_GET); 
        echo "@JSON@".json_encode($result->fetch_object())."@JSON@";
    }

    function vote() {
        $model = new VotesModel;
        $model->vote($_GET);
    }
}
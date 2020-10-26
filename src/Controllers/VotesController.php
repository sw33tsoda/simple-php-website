<?php

namespace Controllers;

use Models\VotesModel;

class VotesController extends MainController {
    function vote() {
        $model = new VotesModel;
        $model->vote($_GET);
    }
}
<?php

namespace Controllers;
use Controllers\MainController;
use Models\PostsModel;

class PostsController extends MainController {
    function add() {
        if ($_POST) {
            $data = $_POST;
            $data['image'] = $this->saveFile($_FILES,'image','Images');
            $data['user_id'] = $_SESSION['user']['id'];
            $model = new PostsModel;
            $save = $model->add($data);

            if ($save) {
                header('location:/?site=welcome');
            }
        }
        echo $this->blade->make('AddPost')->render();
    }

    function my_post() {
        $id = $_SESSION['user']['id'];
        $model = new PostsModel;
        $result = $model->getBy($id);
        echo $this->blade->make('MyPost',['posts' => $result])->render();
    }

    function remove() {
        $data = array(
            'user_id' => $_SESSION['user']['id'],
            'post_id' => $_GET['post_id']
        );
        $model = new PostsModel;
        $remove = $model->remove($data);
        if ($remove) {
            header('location:'.$_SERVER['HTTP_REFERER']);
        } else {
            echo 'Failed to delete!';
        }
    }
}
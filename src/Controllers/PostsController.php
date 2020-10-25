<?php

namespace Controllers;
use Controllers\MainController;
use Models\PostsModel;
use Validations\PostsValidation;

class PostsController extends MainController {
    function add() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST['image'] = $_FILES['image'];
            $validatedData = new PostsValidation($_POST);
            if (!$validatedData->hasError()) {
                $data = $validatedData->getData();
                $data['image'] = $this->saveFile($_FILES,'image','Images');
                $data['user_id'] = $_SESSION['user']['id'];
                $model = new PostsModel;
                $save = $model->add($data);
                if ($save) {
                    header('location:/?site=welcome');
                } else {
                    echo "Failed to add new post!";
                }
            } else {
                $this->errors = $validatedData->getErrorsList();
            }
        }
        $this->render('AddPost',['errors' => $this->errors]);
    }

    function show_post() {
        $post_id = $_GET['post_id'];
        $model = new PostsModel;
        $getPost = $model->getByPostId($post_id);
        
        $this->render('ShowPost',['post' => $getPost->fetch_object()]);
    }

    function my_post() {
        $id = $_SESSION['user']['id'];
        $model = new PostsModel;
        $result = $model->getByUserId($id);
        $this->render('MyPost',['posts' => $result]);
    }

    function remove() {
        $data = array(
            'user_id' => $_SESSION['user']['id'],
            'post_id' => $_GET['post_id'],
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
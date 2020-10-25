<?php
namespace Controllers;
use Controllers\MainController;
use Models\PostsModel;
use Models\UsersModel;
use Validations\UsersValidation;

class UsersController extends MainController {
    function user_profile() {
        $id = $_GET['id'];
        $users_model = new UsersModel;
        $posts_model = new PostsModel;
        $user_info = $users_model->getUserProfileById($id)->fetch_object();
        $user_posts = $posts_model->getByUserId($id);

        $this->render('UserProfile',[
            'user_info' => $user_info,
            'user_posts' => $user_posts,
            ]);
    }

    function register() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST['image'] = $_FILES['image'];
            $validatedData = new UsersValidation($_POST);
            if (!$validatedData->hasError()) {
                $data = $validatedData->getData();
                // FILE HANDLING.
                $data['image'] = $this->saveFile($_FILES,'image','Images');
                // MD5-IZE PASSWORD.
                $data['password'] = md5($data['password']);
    
                $model = new UsersModel;
                $register = $model->register($data);
                if ($register) {
                    $this->log->warning('REG_SUCCESS',$data);
                    echo "<center>Registration successful!</center>";
                    header('refresh:1;url=/?site=welcome');
                } else {
                    echo "Registration failure!";
                }
            } else {
                $this->errors = $validatedData->getErrorsList();
            }
        }

        $this->render('Register',['errors' => $this->errors]);
    }

    function login() {
        if ($_POST) {
            $data = $_POST;

            $data['password'] = md5($data['password']);
            $model = new UsersModel;
            $login = $model->login($data);
            
            if ($login->num_rows > 0) {
                $user = $login->fetch_assoc();
                $_SESSION['user'] = $user;
                $this->log->warning("{$user['username']} has logged in!",$user);
                header('location:/?site=welcome');
            } else {
                echo "<script>alert('Login failure!')</script>";
            }
        }
        
        $this->render('Login');
    }

    function edit() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST['image'] = $_FILES['image'];
            $validatedData = new UsersValidation($_POST);
            if (!$validatedData->hasError()) {
                $data = $validatedData->getData();
                $data['password'] = md5($data['password']);
                // CHECK IF USER WANT TO CHANGE THE IMAGE.
                if ($_FILES['image']['name'] == '') $data['image'] = $_SESSION['user']['image'];
                else $data['image'] = $this->saveFile($_FILES,'image','Images');

                $data['id'] = (int) $_SESSION['user']['id'];
                $model = new UsersModel;
                $edit = $model->edit($data);

                if ($edit) {
                    echo "Account has successfully changed";
                    $this->log->warning("{$data['username']} has changed their account information",$data);
                    $_SESSION['user'] = $data;
                } else {
                    echo "Changing account information failed!";
                }
            } else {
                $this->errors = $validatedData->getErrorsList();
            }
        }
        $this->render('Edit',['user_info' => (object) $_SESSION['user'],'errors' => $this->errors]);
    }

    function logout() {
        session_unset();
        header('location:/?site=welcome');
    }
}
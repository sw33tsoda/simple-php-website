<?php
namespace Controllers;
use Controllers\MainController;
use Models\UsersModel;
use Validation\UsersValidation;

class UsersController extends MainController {

    function user_profile() {
        $id = $_GET['id'];
        $model = new UsersModel;
        $result = $model->getUserProfileById($id);
        echo $this->blade->make('UserProfile',['user_info' => (object) $result->fetch_object()])->render();
    }

    function register() {
        $errors = [];
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
                $errors = $validatedData->getErrorsList();
            }
        }

        echo $this->blade->make('Register',['errors' => $errors])->render();
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
        echo $this->blade->make('Login')->render();
    }

    function edit() {
        $errors = [];
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
                $errors = $validatedData->getErrorsList();
            }
        }
        echo $this->blade->make('Edit',['user_info' => (object) $_SESSION['user'],'errors' => $errors])->render();
    }

    function logout() {
        session_unset();
        header('location:/?site=welcome');
    }
}
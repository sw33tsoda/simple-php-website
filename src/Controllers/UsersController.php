<?php
namespace Controllers;
use Controllers\MainController;
use Models\UsersModel;


class UsersController extends MainController {

    function register() {
        if ($_POST) {
            $data = $_POST;
            if ($data['password'] == $data['password_confirmation'] && !empty($data['password']) && !empty($data['password_confirmation'])) {
                // FILE HANDLING.
                $data['image'] = $this->saveFile($_FILES,'image','Images');
                // MD5-IZE PASSWORD.
                $data['password'] = md5($data['password']);
    
                $model = new UsersModel;
                $register = $model->register($data);
                if ($register) {
                    $this->log->warning('REG_SUCCESS',$data);
                    echo "Registration successful!";
                } else {
                    echo "Registration failure!";
                }
            }
        }

        echo $this->blade->make('Register')->render();
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
            }
        }
        echo $this->blade->make('Login')->render();
    }

    function edit() {

        if ($_POST) {
            $data = $_POST;

            if ($data['password'] == $data['password_confirmation'] && !empty($data['password']) && !empty($data['password_confirmation'])) {
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
            }
        }

        echo $this->blade->make('Edit',['user_info' => (object) $_SESSION['user']])->render();
    }

    function logout() {
        session_unset();
        header('location:/?site=welcome');
    }
}
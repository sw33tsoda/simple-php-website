<?php 

namespace Validation;

class UsersValidation {
    use Validation;
    private $data;
    private $errors_list;
    private $is_error = false;
    function __construct($data) {
        // REMOVE SPACES
        foreach ($data as $key => $value) {
            $data[$key] = preg_replace('/\s+/', '', $data[$key]);
        }

        // SET DATA
        $this->data = $data;
        
        // START VALIDATING IF WE HAVE VALUE. 
        if ($this->data) {
            $this->startValidating();
        }
    }

    function getData() {
        return $this->data;
    }

    function startValidating() {
        $this->errors_list = [
            'username' => $this->validate($this->data['username'])->min_length(6)->max_length(32)->required()->done(),
            'password' => $this->validate($this->data['password'])->min_length(4)->max_length(128)->required()->done(),
        ];

        // CHECK IF THERE IS A ERROR.
        foreach ($this->errors_list as $error) {
            if ($error['is_error']) {
                $this->is_error = true;
            }
        }
    }

    function hasError() {
        if ($this->is_error) {
            return true;
        }
        return false;
    }

    function getErrorsList() {
        return $this->errors_list;
    }
}
<?php

namespace Validations;

class MainValidation {
    use Validation;
    protected $data;
    protected $errors_list;
    protected $is_error = false;

    function startValidating($readRules,$data) {
        // SET DATA
        $this->data = $data;

        // START VALIDATING IF WE HAVE VALUE. 
        if ($this->data) {
            $readRules;
            // CHECK IF THERE IS A ERROR.
            foreach ($this->errors_list as $error) {
                if ($error['is_error']) {
                    $this->is_error = true;
                }
            }
        }
    }

    function getData() {
        return $this->data;
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
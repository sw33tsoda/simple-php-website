<?php

namespace Validation;

trait Validation {
    private $value;
    private $errors = [];

    function validate($value) {
        $this->value = $value;
        return $this;
    }
    
    function required() {
        if (empty($this->value))
        $this->errors['required'] = "This field is required.";
        return $this;
    }

    function email($value) {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL))
            $this->errors[' email'] = "Invalid email address.";
        return $this;
    }
    
    function max_length($max_string_length) {
        if (strlen($this->value) > $max_string_length)
            $this->errors['max_length'] = "Must not exceed {$max_string_length} characters";
        return $this;
    }

    function min_length($min_string_length) {
        if (strlen($this->value) < $min_string_length)
            $this->errors['min_length'] = "Must contain at least {$min_string_length} characters";
        return $this;
    }

    function done() {
        return [
            'is_error' => count($this->errors) > 0 ? true : false,
            'errors_list' => $this->errors
        ];
    }
}
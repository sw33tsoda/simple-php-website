<?php

namespace Validation;

trait Validation {
    private $value;
    private $errors = [];

    function validate($value) {
        $this->value = $value;
        return $this;
    }

    function allowedExtension($string_of_extensions) {
        if (!empty($this->value['name'])) {
            $string_of_extensions = explode('|',$string_of_extensions);
            $file_extension_temp = explode('.',$this->value['name']);
            $file_extension = $file_extension_temp[count($file_extension_temp) - 1];
            $supported_extensions = join(',',$string_of_extensions);
            foreach ($string_of_extensions as $extension) {
                if ($extension !== $file_extension) {
                    $this->errors['image'] = "This file type is not supported. Supported extensions : {$supported_extensions}";
                }
                break;
            }
        }
        return $this;
    }
    
    function required() {
        if (empty($this->value))
        $this->errors['required'] = "This field is required.";
        return $this;
    }

    function email($value) {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL))
            $this->errors['email'] = "Invalid email address.";
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
        $final_errors = $this->errors;
        $this->errors = null;
        return [
            'is_error' => count((array) $final_errors) > 0 ? true : false,
            'errors_list' => $final_errors
        ];
    }
}
<?php 

namespace Validations;

class UsersValidation extends MainValidation {
    function __construct($data) {
        // REMOVE SPACES
        foreach ($data as $key => $value) {
            $data[$key] = preg_replace('/\s+/', '', $data[$key]);
        }

        $this->startValidating($this->rules(),$data);
    }

    function rules() {
        // ADD DATA VALIDATION RULE.
        $this->errors_list = [
            'username' => $this->validate($this->data['username'])->min_length(6)->max_length(32)->required()->done(),
            'password' => $this->validate($this->data['password'])->min_length(4)->max_length(128)->required()->done(),
            'image' => $this->validate($this->data['image'])->allowedExtension('jpg|jpeg')->done(),
        ];
    }
}
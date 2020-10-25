<?php 

namespace Validations;

class UsersValidation extends MainValidation {
    function __construct($data) {
        // REMOVE SPACES
        // foreach ($data as $key => $value) {
        //     $data[$key] = preg_replace('/\s+/', '', $data[$key]);
        // }

        if (!isset($data['user_desc'])) {
            $data['user_desc'] = '';
        }

        // dd($data);
        $this->setData($data)->startValidating($this->rules());
    }

    function rules() {
        // ADD DATA VALIDATION RULES
        return [
            'username' => $this->validate($this->data['username'])->minLength(6)->maxLength(64)->required()->done(),
            'email' => $this->validate($this->data['email'])->required()->email()->maxLength(64)->done(),
            'user_desc' => $this->validate($this->data['user_desc'])->maxLength(512)->done(),
            'password' => $this->validate($this->data['password'])->minLength(4)->maxLength(128)->required()->done(),
            'image' => $this->validate($this->data['image'])->allowedExtension('jpg|jpeg')->maxSize(0.5)->done(),
        ];
    }
}
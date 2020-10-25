<?php

namespace Validations;

class PostsValidation extends MainValidation {
    function __construct($data) {
        $this->setData($data)->startValidating($this->rules());
    }

    function rules() {
        return [
            'title' => $this->validate($this->data['title'])->maxLength(512)->required()->done(),
            'content' => $this->validate($this->data['content'])->maxLength(1024*4)->required()->done(),
            'image' => $this->validate($this->data['image'])->allowedExtension('jpg|jpeg')->maxSize(2)->done(),
        ];
    }
}
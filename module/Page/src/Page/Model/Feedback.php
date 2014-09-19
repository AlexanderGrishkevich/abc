<?php

namespace Page\Model;

class Feedback {

    public $id;
    public $username;
    public $phone;
    public $email;
    public $text;

    public function exchangeArray($data) {
        $this->id = (isset($data['id'])) ? $data['id'] : NULL;
        $this->username = (isset($data['username'])) ? $data['username'] : NULL;
        $this->phone = (isset($data['phone'])) ? $data['phone'] : NULL;
        $this->email = (isset($data['email'])) ? $data['email'] : NULL;
        $this->text = (isset($data['text'])) ? $data['text'] : NULL;
    }

    public function getArrayCopy() {
        return get_object_vars($this);
    }

}

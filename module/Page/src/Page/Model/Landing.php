<?php

namespace Page\Model;

class Landing {

    public $id;
    public $type;
    public $phone;
    public $business;
    public $email;
    public $question;

    public function exchangeArray($data) {
        $this->id = (isset($data['id'])) ? $data['id'] : NULL;
        $this->type = (isset($data['type'])) ? $data['type'] : NULL;
        $this->phone = (isset($data['phone'])) ? $data['phone'] : NULL;
        $this->business = (isset($data['business'])) ? $data['business'] : NULL;
        $this->email = (isset($data['email'])) ? $data['email'] : NULL;
        $this->question = (isset($data['question'])) ? $data['question'] : NULL;
    }

    public function getArrayCopy() {
        return get_object_vars($this);
    }

}

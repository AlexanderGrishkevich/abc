<?php

namespace Auth\Model;

class User {

	public $id;
	public $email;
	public $password;
	

	public function exchangeArray($data) {
        $this->id = (isset($data['id'])) ? $data['id'] : NULL;
        $this->email = (isset($data['email'])) ? $data['email'] : NULL;
        $this->password = (isset($data['password'])) ? $data['password'] : NULL;
    }

    public function getArrayCopy() {
        return get_object_vars($this);
    }

	public function setPassword($password) {
		$this->password = md5($password);
	}    

}
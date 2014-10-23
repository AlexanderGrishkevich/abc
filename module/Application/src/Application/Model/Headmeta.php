<?php

namespace Application\Model;

class Headmeta {

    public $id;
    public $controller;
    public $action;
    public $title;
    public $description;
    public $keywords;

    public function exchangeArray($data) {
        $this->id = (isset($data['id'])) ? $data['id'] : NULL;
        $this->controller = (isset($data['controller'])) ? $data['controller'] : NULL;
        $this->action = (isset($data['action'])) ? $data['action'] : NULL;
        $this->title = (isset($data['title'])) ? $data['title'] : NULL;
        $this->description = (isset($data['description'])) ? $data['description'] : NULL;
        $this->keywords = (isset($data['keywords'])) ? $data['keywords'] : NULL;
    }

    public function getArrayCopy() {
        return get_object_vars($this);
    }

}

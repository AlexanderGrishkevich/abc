<?php

namespace Page\Model;

class Services {

    public $id;
    public $category;
    public $title;
    public $description;
    public $completion_date;
    public $report;
    public $services_for;
    public $bonus;
    public $price;

    public function exchangeArray($data) {
        $this->id = (isset($data['id'])) ? $data['id'] : NULL;
        $this->category = (isset($data['category'])) ? $data['category'] : NULL;
        $this->title = (isset($data['title'])) ? $data['title'] : NULL;
        $this->description = (isset($data['description'])) ? $data['description'] : NULL;
        $this->completion_date = (isset($data['completion_date'])) ? $data['completion_date'] : NULL;
        $this->report = (isset($data['report'])) ? $data['report'] : NULL;
        $this->services_for = (isset($data['services_for'])) ? $data['services_for'] : NULL;
        $this->bonus = (isset($data['bonus'])) ? $data['bonus'] : NULL;
        $this->price = (isset($data['price'])) ? $data['price'] : NULL;
    }

    public function getArrayCopy() {
        return get_object_vars($this);
    }

}

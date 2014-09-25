<?php

namespace Page\Model;

class Portfolio {

    public $id;
    public $activity;
    public $site_link;
    public $work;
    public $review;
    public $target;
    public $logo;
    public $active;

    public function exchangeArray($data) {
        $this->id = (isset($data['id'])) ? $data['id'] : NULL;
        $this->activity = (isset($data['activity'])) ? $data['activity'] : NULL;
        $this->site_link = (isset($data['site_link'])) ? $data['site_link'] : NULL;
        $this->work = (isset($data['work'])) ? $data['work'] : NULL;
        $this->review = (isset($data['review'])) ? $data['review'] : NULL;
        $this->target = (isset($data['target'])) ? $data['target'] : NULL;
        $this->active = (isset($data['active'])) ? $data['active'] : NULL;
    }

    public function getArrayCopy() {
        return get_object_vars($this);
    }

}

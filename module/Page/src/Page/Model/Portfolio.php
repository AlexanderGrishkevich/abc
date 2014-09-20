<?php

namespace Page\Model;

class Portfolio {

    public $id;
    public $image;
    public $activity;
    public $site_link;
    public $work;
    public $review;
    public $target;

    public function exchangeArray($data) {
        $this->id = (isset($data['id'])) ? $data['id'] : NULL;
        $this->image = (isset($data['image'])) ? $data['image'] : NULL;
        $this->activity = (isset($data['activity'])) ? $data['activity'] : NULL;
        $this->site_link = (isset($data['site_link'])) ? $data['site_link'] : NULL;
        $this->work = (isset($data['work'])) ? $data['work'] : NULL;
        $this->review = (isset($data['review'])) ? $data['review'] : NULL;
        $this->target = (isset($data['target'])) ? $data['target'] : NULL;
    }

    public function getArrayCopy() {
        return get_object_vars($this);
    }

}

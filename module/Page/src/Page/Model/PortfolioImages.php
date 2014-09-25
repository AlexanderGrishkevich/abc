<?php

namespace Page\Model;

class PortfolioImages {

    public $id;
    public $portfolio_id;
    public $filepath;

    public function exchangeArray($data) {
        $this->id = (isset($data['id'])) ? $data['id'] : NULL;
        $this->portfolio_id = (isset($data['portfolio_id'])) ? $data['portfolio_id'] : NULL;
        $this->filepath = (isset($data['filepath'])) ? $data['filepath'] : NULL;
    }

    public function getArrayCopy() {
        return get_object_vars($this);
    }

}

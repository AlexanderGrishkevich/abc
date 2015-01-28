<?php

namespace Page\Form;

use Zend\InputFilter\InputFilter;

class CountClientFilter extends InputFilter {
    public function __construct() {
        
        $this->add(array(
            'name' => 'phone',
            'required' => true,
        ));
        
        $this->add(array(
            'name' => 'business',
            'required' => true,
        ));
    }

}
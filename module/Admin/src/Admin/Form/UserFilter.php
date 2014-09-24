<?php

namespace Admin\Form;

use Zend\InputFilter\InputFilter;

class UserFilter extends InputFilter {
    public function __construct() {
        
        $this->add(array(
            'name' => 'email',
            'required' => true,
        ));
        
        $this->add(array(
            'name' => 'password',
            'required' => true,
        ));
    }

}
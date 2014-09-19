<?php

namespace Page\Form;

use Zend\InputFilter\InputFilter;

class CheckoutFilter extends InputFilter {
    public function __construct() {
        
        $this->add(array(
            'name' => 'username',
            'required' => true,
        ));
        
        $this->add(array(
            'name' => 'phone',
            'required' => true,
        ));
        
        $this->add(array(
            'name' => 'email',
            'required' => true,
            'multiple' => 'true',
        ));
        
        $this->add(array(
            'name' => 'text',
            'required' => true,
        ));
    }

}
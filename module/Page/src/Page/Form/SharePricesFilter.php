<?php

namespace Page\Form;

use Zend\InputFilter\InputFilter;

class SharePricesFilter extends InputFilter {
    public function __construct() {
        
        $this->add(array(
            'name' => 'email',
            'required' => true,
            'filters' => array(
                array(
                    'name' => 'StripTags',
                ),
            ),
            'validators' => array(
                array(
                    'name' => 'StringLength',
                    'options' => array(
                        'encoding' => 'UTF-8',
                        'min' => 1,
                        'max' => 140,
                    ),
                ), array(
                    'name' => 'EmailAddress',
                    'options' => array(
                        'domain' => true,
                    ),
                ),              
            ),
        ));
    }

}
<?php

namespace Application\Form;

use Zend\Form\Form;

class HeadmetaForm extends Form {
    public function __construct($name = null) {
        parent::__construct('login-form');
        $this->setAttribute('method', 'post');
        $this->setAttribute('enctype', 'multipart/form-data');

        $this->add(array(
            'name' => 'controller',
            'attributes' => array(
                'type' => 'text',
            ),
            'options' => array(
                'label' => "controller",
            ),
        ));

        $this->add(array(
            'name' => 'action',
            'attributes' => array(
                'type' => 'text',
            ),
            'options' => array(
                'label' => "action",
            ),
        ));
        
        $this->add(array(
            'name' => 'title',
            'attributes' => array(
                'type' => 'text',
            ),
            'options' => array(
                'label' => "title",
            ),
        ));
        
        $this->add(array(
            'name' => 'description',
            'attributes' => array(
                'type' => 'text',
            ),
            'options' => array(
                'label' => "description",
            ),
        ));
        
         $this->add(array(
            'name' => 'keywords',
            'attributes' => array(
                'type' => 'text',
            ),
            'options' => array(
                'label' => "keywords",
            ),
        ));

        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Пагнали',
                'class' => 'submit'
            ),
        ));
    }
}
<?php

namespace Admin\Form;

use Zend\Form\Form;

class PortfolioForm extends Form {

    public function __construct($name = null) {
        parent::__construct('portfolio-form');
        $this->setAttribute('method', 'post');
        $this->setAttribute('enctype', 'multipart/form-data');
        $this->setAttribute('class', 'portfolio-form');

        $this->add(array(
            'name' => 'activity',
            'attributes' => array(
                'type' => 'textarea',
                'placeholder' => 'Деятельность',
            ),
        ));

        $this->add(array(
            'name' => 'site_link',
            'attributes' => array(
                'type' => 'text',
                'placeholder' => 'http://',
            ),
        ));

        $this->add(array(
            'name' => 'work',
            'attributes' => array(
                'type' => 'textarea',
                'placeholder' => 'Выполненные работы',
            ),
        ));

        $this->add(array(
            'name' => 'review',
            'attributes' => array(
                'type' => 'textarea',
                'placeholder' => 'Отзыв',
            ),
        ));

        $this->add(array(
            'name' => 'target',
            'attributes' => array(
                'type' => 'textarea',
                'placeholder' => 'Цель',
            ),
        ));

        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Сохранить',
                'class' => 'submit'
            ),
        ));
    }

}

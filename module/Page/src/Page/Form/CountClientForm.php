<?php

namespace Page\Form;

use Zend\Form\Form,
    Zend\Captcha;

class CountClientForm extends Form {

    public function __construct($name = null) {
        parent::__construct('CountClient-form');
        $this->setAttribute('method', 'post');
        $this->setAttribute('enctype', 'multipart/form-data');
        $this->setAttribute('class', 'client-form');

        $this->add(array(
            'name' => 'phone',
            'required' => true,
            'options' => array(
                'label' => 'Напишите Ваш телефон:',
            ),
            'attributes' => array(
                'type' => 'text',
            ),
            'attributes' => array(
                'placeholder' => 'Ваш телефон*',
                'id' => 'form-phone',
            ),
        ));
        
        $this->add(array(
            'name' => 'business',
            'required' => true,
            'options' => array(
                'label' => 'Укажите область Вашего бизнеса:',
            ),
            'attributes' => array(
                'type' => 'text',
            ),
            'attributes' => array(
                'placeholder' => 'Ваш бизнес*',
                'id' => 'form-business',
            ),
        ));

//        $this->add(array(
//            'type' => 'Zend\Form\Element\Captcha',
//            'name' => 'captcha',
//            'attributes' => array(
//                'class' => 'form-control',
//                'placeholder' => 'Введите текст*'
//            ),
//            'options' => array(
//                'captcha' => new Captcha\Figlet(array(
//                    'name' => 'foo',
//                    'wordLen' => 4,
//                    'timeout' => 300,
//                    'messages' => array(
//                        'badCaptcha' => 'Неправильно введена каптча!'
//                    )
//                        )),
//            ),
//        ));

        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Рассчитать количество новых клиентов!',
                'id' => 'form-submit',
                'data-form' => 'Form'
            ),
        ));
    }

}

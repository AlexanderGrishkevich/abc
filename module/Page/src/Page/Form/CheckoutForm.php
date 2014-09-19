<?php

namespace Page\Form;

use Zend\Form\Form,
    Zend\Captcha;

class CheckoutForm extends Form {

    public function __construct($name = null) {
        parent::__construct('login-form');
        $this->setAttribute('method', 'post');
        $this->setAttribute('enctype', 'multipart/form-data');
        $this->setAttribute('class', 'feedback-form');

        $this->add(array(
            'name' => 'username',
            'attributes' => array(
                'type' => 'text',
            ),
            'attributes' => array(
                'placeholder' => 'Ваше имя*',
            ),
        ));
        
        $this->add(array(
            'name' => 'site',
            'attributes' => array(
                'type' => 'text',
            ),
            'attributes' => array(
                'placeholder' => 'Адрес вашего сайта',
            ),
        ));

        $this->add(array(
            'name' => 'phone',
            'attributes' => array(
                'type' => 'text',
            ),
            'attributes' => array(
                'placeholder' => 'Телефон*',
            ),
        ));

        $this->add(array(
            'name' => 'email',
            'attributes' => array(
                'type' => 'text',
            ),
            'attributes' => array(
                'placeholder' => 'Email*',
            ),
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Textarea',
            'name' => 'text',
            'attributes' => array(
                'placeholder' => 'Сообщение*',
            ),
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Captcha',
            'name' => 'captcha',
            'attributes' => array(
                'class' => 'form-control',
                'placeholder' => 'Введите текст*'
            ),
            'options' => array(
                'captcha' => new Captcha\Figlet(array(
                    'name' => 'foo',
                    'wordLen' => 4,
                    'timeout' => 300,
                    'messages' => array(
                        'badCaptcha' => 'Неправильно введена каптча!'
                    )
                        )),
            ),
        ));

        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Отправить',
                'class' => 'feedback-submit'
            ),
        ));
    }

}

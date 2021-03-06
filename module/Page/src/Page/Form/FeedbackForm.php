<?php

namespace Page\Form;

use Zend\Form\Form,
    Zend\Captcha;

class FeedbackForm extends Form {

    public function __construct($name = null) {
        parent::__construct('login-form');
        $this->setAttribute('method', 'post');
        $this->setAttribute('enctype', 'multipart/form-data');
        $this->setAttribute('class', 'feedback-form');

        $this->add(array(
            'type' => 'text',
            'name' => 'username',
            'attributes' => array(
                'placeholder' => 'Ваше имя*',
            ),
        ));
        $this->add(array(
            'type' => 'text',
            'name' => 'phone',
            'attributes' => array(
                'placeholder' => 'Телефон*',
            ),
        ));

        $this->add(array(
            'type' => 'text',
            'name' => 'email',
            'attributes' => array(
                'multiple' => 'true',
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

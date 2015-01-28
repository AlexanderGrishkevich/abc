<?php

namespace Page\Form;

use Zend\Form\Form,
    Zend\Captcha;

class QuestionForm extends Form {

    public function __construct($name = null) {
        parent::__construct('Question-form');
        $this->setAttribute('method', 'post');
        $this->setAttribute('enctype', 'multipart/form-data');
        $this->setAttribute('class', 'client-form');

        $this->add(array(
            'name' => 'name',
            'required' => true,
            'attributes' => array(
                'type' => 'text',
            ),
            'attributes' => array(
                'placeholder' => 'Ваше имя*',
                'id' => 'form-name',
            ),
        ));
        
        $this->add(array(
            'name' => 'email',
            'required' => true,
            'attributes' => array(
                'type' => 'email',
            ),
            'attributes' => array(
                'placeholder' => 'Ваш email*',
                'id' => 'form-email',
            ),
        ));
        
        $this->add(array(
            'name' => 'question',
            'required' => true,
            'type' => 'Zend\Form\Element\Textarea',
            'attributes' => array(
                'placeholder' => 'Ваш вопрос*',
                'id' => 'form-question',
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
                'value' => 'ЗАДАТЬ ВОПРОС',
                'id' => 'form-submit',
                'data-form' => 'Form3'
            ),
        ));
    }

}

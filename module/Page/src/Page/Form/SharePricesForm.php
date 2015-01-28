<?php

namespace Page\Form;

use Zend\Form\Form,
    Zend\Captcha;

class SharePricesForm extends Form {

    public function __construct($name = null) {
        parent::__construct('SarePrices-form');
        $this->setAttribute('method', 'post');
        $this->setAttribute('enctype', 'multipart/form-data');
        $this->setAttribute('class', 'client-form');

        $this->add(array(
            'name' => 'email',
            'required' => true,
            'attributes' => array(
                'type' => 'email',
                'placeholder' => 'Ваш email*',
                'id' => 'form-email',
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
                'value' => 'УЗНАТЬ СТОИМОСТЬ ПО АКЦИИ',
                'id' => 'form-submit',
                'data-form' => 'Form2'
            ),
        ));
    }

}

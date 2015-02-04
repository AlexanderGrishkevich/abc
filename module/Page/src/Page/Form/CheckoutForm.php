<?php

namespace Page\Form;

use Zend\Form\Form,
    Zend\Captcha;

class CheckoutForm extends Form {

    public function __construct($name = null) {
        parent::__construct('login-form');
        $this->setAttribute('method', 'post');
        $this->setAttribute('enctype', 'multipart/form-data');
        $this->setAttribute('class', 'checkout-form-content');

        $this->add(array(
            'name' => 'checkbox1',
            'type' => 'Zend\Form\Element\MultiCheckbox',
            'options' => array(
                'label' => 'Отметьте пункты соответствующие интересам вашей компании:',
                'value_options' => array(
                    array(
                        'value' => 'У нас есть веб-сайт',
                        'label' => 'У нас есть веб-сайт',
                        'selected' => false,
                    ),
                    array(
                        'value' => 'Нам нужен веб-сайт',
                        'label' => 'Нам нужен веб-сайт',
                        'selected' => false,
                    ),
                    array(
                        'value' => 'Мы хотим быть №1 в Google/Yandex',
                        'label' => 'Мы хотим быть №1 в Google/Yandex',
                        'selected' => false,
                    ),
                    array(
                        'value' => 'Мы хотим улучщить конвертацию посетитель -> клиент',
                        'label' => 'Мы хотим улучщить конвертацию посетитель -> клиент',
                        'selected' => false,
                    ),
                    array(
                        'value' => 'Мы хотим улучшить представление о нас в социальных медиа',
                        'label' => 'Мы хотим улучшить представление о нас в социальных медиа',
                        'selected' => false,
                    ),
                    array(
                        'value' => 'Нам нужна продающая страница',
                        'label' => 'Нам нужна продающая страница',
                        'selected' => false,
                    ),
                    array(
                        'value' => 'Нужна система сбора данных: посещения/звонки/заказы',
                        'label' => 'Нужна система сбора данных: посещения/звонки/заказы',
                        'selected' => false,
                    ),
                ),
                'use_hidden_element' => true,
                'checked_value' => 'да',
                'unchecked_value' => 'нет',
            ),
        ));

        $this->add(array(
            'name' => 'site',
            'type' => 'text',
            'options' => array(
                'label' => 'Пожалуйста, предоставьте нам ссылку на ваш веб-сайт:',
            ),
            'attributes' => array(
                'placeholder' => 'http://abcmedia.by/',
            ),
        ));

        $this->add(array(
            'name' => 'checkbox2',
            'type' => 'Zend\Form\Element\MultiCheckbox',
            'options' => array(
                'label' => 'Отметьте пункты соответствующие вашей рекламной политике:',
                'value_options' => array(
                    array(
                        'value' => 'Мы уже проводили/проводим работы по оптимизации нашего веб-сайта',
                        'label' => 'Мы уже проводили/проводим работы по оптимизации нашего веб-сайта',
                        'selected' => false,
                    ),
                    array(
                        'value' => 'Мы в настоящее время рекламируем свой бизнес в Интернете',
                        'label' => 'Мы в настоящее время рекламируем свой бизнес в Интернете',
                        'selected' => false,
                    ),
                    array(
                        'value' => 'Мы в настоящее время рекламируем свой бизнес за пределами Интернета (газеты, журналы, ТВ, наружная реклама и т.д.)',
                        'label' => 'Мы в настоящее время рекламируем свой бизнес за пределами Интернета (газеты, журналы, ТВ, наружная реклама и т.д.)',
                        'selected' => false,
                    ),
                    array(
                        'value' => 'Мы в настоящее время рекламируем свой бизнес с использованием холодных звонков',
                        'label' => 'Мы в настоящее время рекламируем свой бизнес с использованием холодных звонков',
                        'selected' => false,
                    ),
                    array(
                        'value' => 'Мы в настоящее время используем контекстную рекламу',
                        'label' => 'Мы в настоящее время используем контекстную рекламу',
                        'selected' => false,
                    ),
                    array(
                        'value' => 'У нас есть база почтовой рассылки, состоящей из нынешних/потенциальных клиентов',
                        'label' => 'У нас есть база почтовой рассылки, состоящей из нынешних/потенциальных клиентов',
                        'selected' => false,
                    ),
                    array(
                        'value' => 'Наша компания тратит 1,000$ или больше в месяц на рекламу',
                        'label' => 'Наша компания тратит 1,000$ или больше в месяц на рекламу',
                        'selected' => false,
                    ),
                    array(
                        'value' => 'Мы планируем привлекать только местных клиентов. Только на территории города с пригородами (местный бизнес)',
                        'label' => 'Мы планируем привлекать только местных клиентов. Только на территории города с пригородами (местный бизнес)',
                        'selected' => false,
                    ),
                    array(
                        'value' => 'Мы планируем привлекать клиентов по всей территории страны (общенациональный бизнес)',
                        'label' => 'Мы планируем привлекать клиентов по всей территории страны (общенациональный бизнес)',
                        'selected' => false,
                    ),
                    array(
                        'value' => 'Мы планируем привлекать клиентов по всему миру (международный бизнес)',
                        'label' => 'Мы планируем привлекать клиентов по всему миру (международный бизнес)',
                        'selected' => false,
                    ),
                ),
                'use_hidden_element' => true,
                'checked_value' => 'да',
                'unchecked_value' => 'нет',
            ),
        ));

        $this->add(array(
            'name' => 'theme',
            'type' => 'text',
            'options' => array(
                'label' => 'Пожалуйста, предоставьте нам список ключевых слов, при поиске которых вы хотите занять место в Google/Yandex. Например:',
            ),
            'attributes' => array(
                'placeholder' => 'Тематика: автозапчасти',
            ),
        ));


        $this->add(array(
            'name' => 'keys',
            'type' => 'Zend\Form\Element\Textarea',
            'attributes' => array(
                'placeholder' => 'Ключи: купить радиатор, купить переднюю панель, купить решетку радиатора',
            ),
        ));

        $this->add(array(
            'name' => 'checkbox3',
            'type' => 'Zend\Form\Element\MultiCheckbox',
            'options' => array(
                'label' => 'Отметьте на каких социальных ресурсах представлена ваша компания:',
                'value_options' => array(
                    array(
                        'value' => 'Youtube channel',
                        'label' => 'Youtube channel',
                        'selected' => false,
                    ),
                    array(
                        'value' => 'Facebook business page',
                        'label' => 'Facebook business page',
                        'selected' => false,
                    ),
                    array(
                        'value' => 'LinkedIn business account',
                        'label' => 'LinkedIn business account',
                        'selected' => false,
                    ),
                    array(
                        'value' => 'Twitter',
                        'label' => 'Twitter',
                        'selected' => false,
                    ),
                    array(
                        'value' => 'Google+',
                        'label' => 'Google+',
                        'selected' => false,
                    ),
                    array(
                        'value' => 'Yelp!',
                        'label' => 'Yelp!',
                        'selected' => false,
                    ),
                    array(
                        'value' => 'Pinterest',
                        'label' => 'Pinterest',
                        'selected' => false,
                    ),
                    array(
                        'value' => 'Foursquare',
                        'label' => 'Foursquare',
                        'selected' => false,
                    ),
                    array(
                        'value' => 'Weebly',
                        'label' => 'Weebly',
                        'selected' => false,
                    ),
                    array(
                        'value' => 'вконтакте',
                        'label' => 'вконтакте',
                        'selected' => false,
                    ),
                    array(
                        'value' => 'одноклассники',
                        'label' => 'одноклассники',
                        'selected' => false,
                    ),
                ),
                'use_hidden_element' => true,
                'checked_value' => 'да',
                'unchecked_value' => 'нет',
            ),
        ));

        $this->add(array(
            'name' => 'links',
            'type' => 'Zend\Form\Element\Textarea',
            'options' => array(
                'label' => 'Пожалуйста, предоставьте нам ссылки для каждой из Ваших учетных записей в социальных сетях, перечисленных в предыдущем вопросе',
            ),
            'attributes' => array(
                'placeholder' => 'Пример: http://facebook.com/mybusiness',
            ),
        ));

        $this->add(array(
            'name' => 'info',
            'type' => 'Zend\Form\Element\Textarea',
            'options' => array(
                'label' => 'Пожалуйста, предоставьте нам любую дополнительную информацию о Вашем бизнесе, которая по вашему мнению может быть полезной',
            ),
        ));

        $this->add(array(
            'name' => 'name',
            'type' => 'text',
            'options' => array(
                'label' => 'Ваше имя',
            ),
        ));

        $this->add(array(
            'name' => 'adress_street',
            'type' => 'text',
            'options' => array(
                'label' => 'Ваш адрес:',
            ),
            'attributes' => array(
                'placeholder' => 'улица',
            ),
        ));

        $this->add(array(
            'name' => 'adress_city',
            'type' => 'text',
            'attributes' => array(
                'placeholder' => 'город'
            ),
        ));

        $this->add(array(
            'name' => 'adress_region',
            'type' => 'text',
            'attributes' => array(
                'placeholder' => 'область'
            ),
        ));

        $this->add(array(
            'name' => 'adress_index',
            'type' => 'text',
            'attributes' => array(
                'placeholder' => 'индекс'
            ),
        ));

        $this->add(array(
            'name' => 'adress_country',
            'type' => 'text',
            'attributes' => array(
                'placeholder' => 'страна'
            ),
        ));

        $this->add(array(
            'name' => 'email',
            'type' => 'email',
            'options' => array(
                'label' => "Ваш адрес электронной почты:",
            ),
            'attributes' => array(
                'placeholder' => 'example@mail.ru'
            ),
        ));

        $this->add(array(
            'name' => 'phone',
            'type' => 'text',
            'options' => array(
                'label' => "Ваш телефонный номер:",
            ),
            'attributes' => array(
                'placeholder' => '+375 33 123-58-95'
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
                'value' => 'Отправить',
                'class' => 'checkout-submit'
            ),
        ));
    }

}

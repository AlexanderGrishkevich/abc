<?php

namespace Page\Controller;

use Zend\Mvc\Controller\AbstractActionController,
    Zend\View\Model\ViewModel;
use Page\Form\FeedbackForm,
    Page\Form\FeedbackFilter,
    Page\Model\Feedback,
    Page\Model\FeedbackTable,
    Page\Form\CheckoutForm,
    Page\Form\CheckoutFilter,
    Page\Model\Checkout,
    Page\Model\CheckoutTable,
    Page\Model\ServicesTable,
    Page\Form\CountClientForm,
    Page\Form\SharePricesForm,
    Page\Form\QuestionForm,
    Page\Form\CountClientFilter,
    Page\Model\Landing,
    Page\Model\LandingTable,
    Page\Form\SharePricesFilter,
    Page\Form\QuestionFilter;
use Zend\Mail\Transport\Sendmail as SendmailTransport;

class PageController extends AbstractActionController {

    public function promotionAction() {
        return new ViewModel();
    }

    public function brendAction() {
        return new ViewModel();
    }

    public function marketingAction() {
        return new ViewModel();
    }

    public function designAction() {
        return new ViewModel();
    }

    public function prAction() {
        return new ViewModel();
    }

    public function contactsAction() {
        $form = new FeedbackForm();
        return new ViewModel(array('form' => $form));
    }

    public function processFeedbackAction() {
        $post = $this->request->getPost();
        $form = new FeedbackForm();
        $form->setInputFilter(new FeedbackFilter());
        $form->setData($post);

        if (!$form->isValid()) {
            $model = new ViewModel(array('error' => true, 'form' => $form));
            $model->setTemplate('page/page/contacts');
            return $model;
        }

        $data = $form->getData();

        $sm = $this->getServiceLocator();
        $dbAdapter = $sm->get('DbAdapter');
        $feedback = new Feedback();
        $feedbackTable = new FeedbackTable($dbAdapter);
        $feedback->exchangeArray($data);
        $feedbackTable->save($feedback);
        return $this->redirect()->toRoute(NULL, array('controller' => 'page', 'action' => 'confirm-feedback'));
    }

    public function confirmFeedbackAction() {
        return new ViewModel();
    }

    public function bannersAction() {
        return new ViewModel();
    }

    public function checkoutAction() {
        $form = new CheckoutForm();
        return new ViewModel(array('form' => $form));
    }

    public function processCheckoutAction() {
        $post = $this->request->getPost();
        $form = new CheckoutForm();
        $form->setInputFilter(new CheckoutFilter());
        $form->setData($post);
        if (!$form->isValid()) {
            $model = new ViewModel(array('error' => true, 'form' => $form));
            $model->setTemplate('page/page/checkout');
            return $model;
        }
       
        $message = $this->sendMail($post);
//        $sm = $this->getServiceLocator();
//        $dbAdapter = $sm->get('DbAdapter');
//        $checkout = new Checkout();
//        $checkoutTable = new CheckoutTable($dbAdapter);
//        $checkout->exchangeArray($data);
//        $checkoutTable->save($checkout);
        return $this->redirect()->toRoute(NULL, array('controller' => 'page', 'action' => 'confirm-checkout'));
    }
    
    public function sendMail($post) {     
        
        $options = new \Zend\Mail\Transport\SmtpOptions(array(
            "name" => "localhost",
            "host" => "localhost",
            "connection_class" => "login",
            "connection_config" => array(
                "username" => "checkout@abcmedia.by",
                "password" => "QHuMxhQQ"
            )
        ));
        
        $message = array();
        
        $ch1 = $post->checkbox1;
        $message[] = 'Отметьте пункты соответствующие интересам вашей компании:';
        if (is_array($ch1)) {
            foreach ($ch1 as $chItem) {
                $message[] = $chItem;
            }
        } else {
            $message[] = $ch1;
        }
        
        $message[] = '';
        $message[] = 'Пожалуйста, предоставьте нам ссылку на ваш веб-сайт:';
        $message[] = $post->site ? : '-';
        
        $ch2 = $post->checkbox2;
        $message[] = '';
        $message[] = 'Отметьте пункты соответствующие вашей рекламной политике:';
        if (is_array($ch2)) {
            foreach ($ch2 as $chItem) {
                $message[] = $chItem;
            }
        } else {
            $message[] = $ch2;
        }
        
        $message[] = '';
        $message[] = 'Пожалуйста, предоставьте нам список ключевых слов, при поиске которых вы хотите занять место в Google/Yandex.';
        $message[] = 'Тематика:' . $post->theme ? : '-';
        $message[] = 'Ключи:' . $post->keys ? : '-';
        
        $ch3 = $post->checkbox3;
        $message[] = '';
        $message[] = 'Отметьте на каких социальных ресурсах представлена ваша компания:';
        if (is_array($ch3)) {
            foreach ($ch3 as $chItem) {
                $message[] = $chItem;
            }
        } else {
            $message[] = $ch3;
        }
        
        $message[] = '';
        $message[] = 'Пожалуйста, предоставьте нам ссылки для каждой из Ваших учетных записей в социальных сетях, перечисленных в предыдущем вопросе.';
        $message[] = $post->links ? : '-';
        
        $message[] = '';
        $message[] = 'Пожалуйста, предоставьте нам любую дополнительную информацию о Вашем бизнесе, которая по вашему мнению может быть полезной';
        $message[] = $post->info ? : '-';
        
        $message[] = '';
        $message[] = 'Ваше Имя:';
        $message[] = $post->name ? : '-';
        
        $message[] = '';
        $message[] = 'Ваш адрес:';
        $message[] = $post->adress_street ? : ' ' . ' - улица';
        $message[] = $post->adress_city ? : ' ' . ' - город';
        $message[] = $post->adress_region ? : ' ' . ' - область';
        $message[] = $post->adress_index ? : ' ' . ' - индекс';
        $message[] = $post->adress_country ? : ' ' . ' - страна';
        
        $message[] = '';
        $message[] = 'Email:';
        $message[] = $post->email;
        
        $message[] = '';
        $message[] = 'Phone:';
        $message[] = $post->phone;
        
        $htmlPart = new \Zend\Mime\Part(implode("<br>",$message));
        $htmlPart->type = "text/html";

        $body = new \Zend\Mime\Message();
        $body->setParts(array($htmlPart));

        $msg = new \Zend\Mail\Message();
        $msg->setFrom('info@abcmedia.by');
        $msg->addTo('wwwmediaservice@gmail.com');
        $msg->setSubject('Новый заказ');
        $msg->setEncoding('UTF-8');
        $msg->setBody($body);
        
        $headers = $msg->getHeaders();
        $headers->removeHeader('Content-Type');
        $headers->addHeaderLine('Content-Type', 'text/html; charset=UTF-8');

        $transport = new \Zend\Mail\Transport\Smtp();
        $transport->setOptions($options);
        try {
            $transport->send($msg);
        } catch (Exception $e) {

        }
        return $message;
    }

    public function confirmCheckoutAction() {
        return new ViewModel();
    }

    public function portfolioAction() {
        return new ViewModel();
    }

    public function supportAction() {
        return new ViewModel();
    }

    public function fastSalesAction() {
        return new ViewModel();
    }

    public function sellPagesAction() {
        return new ViewModel();
    }

    public function servicesAction() {
        $servicesTable = new ServicesTable($this->getServiceLocator()->get('dbAdapter'));
        $services = $servicesTable->fetchAll();
        return array('services' => $services->toArray());
    }

    public function landingAction() {
        $form = new CountClientForm();
        $form2 = new SharePricesForm();
        $form3 = new QuestionForm();
        return new ViewModel(array('form' => $form, 'form2' => $form2, 'form3' => $form3));
    }

    public function landingFormAction() {
        $post = $this->request->getPost();
        $form = new CountClientForm();
        $form->setInputFilter(new CountClientFilter());
        $form->setData($post);

        if (!$form->isValid()) {
            $answer = array('status' => 'bad');
        } else {
            $data = $form->getData();
            $sm = $this->getServiceLocator();
            $dbAdapter = $sm->get('DbAdapter');
            $landing = new Landing();
            $landingTable = new LandingTable($dbAdapter);
            $landing->exchangeArray($data);
            $landing->type = $post['type'];
            print_r($landing);
            $landingTable->save($landing);
            $answer = array('status' => 'ok');
        }

        $response = $this->getResponse();
        $response->setContent(\Zend\Json\Json::encode($answer));
        $response->getHeaders()->addHeaders(array('Content-Type' => 'application/json'));
        return $response;
    }

    public function landingForm2Action() {
        $post = $this->request->getPost();
        $form2 = new SharePricesForm();
        $form2->setInputFilter(new SharePricesFilter());
        $form2->setData($post);

        if (!$form2->isValid()) {
            $answer = array('status' => 'bad');
        } else {
            $data = $form2->getData();
            $sm = $this->getServiceLocator();
            $dbAdapter = $sm->get('DbAdapter');
            $landing = new Landing();
            $landingTable = new LandingTable($dbAdapter);
            $landing->exchangeArray($data);
            $landing->type = $data['submit'];
            $landingTable->save($landing);
            $answer = array('status' => 'ok');
        }

        $response = $this->getResponse();
        $response->setContent(\Zend\Json\Json::encode($answer));
        $response->getHeaders()->addHeaders(array('Content-Type' => 'application/json'));
        return $response;
    }

    public function landingForm3Action() {
        $post = $this->request->getPost();
        $form3 = new QuestionForm();
        $form3->setInputFilter(new SharePricesFilter());
        $form3->setData($post);

        if (!$form3->isValid()) {
            $answer = array('status' => 'bad');
        } else {
            $data = $form3->getData();
            $sm = $this->getServiceLocator();
            $dbAdapter = $sm->get('DbAdapter');
            $landing = new Landing();
            $landingTable = new LandingTable($dbAdapter);
            $landing->exchangeArray($data);
            $landing->type = $data['submit'];
            $landingTable->save($landing);
            $answer = array('status' => 'ok');
        }

        $response = $this->getResponse();
        $response->setContent(\Zend\Json\Json::encode($answer));
        $response->getHeaders()->addHeaders(array('Content-Type' => 'application/json'));
        return $response;
    }
    
    public function mResearchAction() {
        return new ViewModel();
    }

}

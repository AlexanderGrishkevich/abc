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

        $data = $form->getData();

        $sm = $this->getServiceLocator();
        $dbAdapter = $sm->get('DbAdapter');
        $checkout = new Checkout();
        $checkoutTable = new CheckoutTable($dbAdapter);
        $checkout->exchangeArray($data);
        $checkoutTable->save($checkout);
        return $this->redirect()->toRoute(NULL, array('controller' => 'page', 'action' => 'confirm-checkout'));
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

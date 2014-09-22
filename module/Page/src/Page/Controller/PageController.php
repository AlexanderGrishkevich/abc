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
    Page\Model\CheckoutTable;

class PageController extends AbstractActionController {

    public function promotionAction() {
        return new ViewModel();
    }

    public function marketingAction() {
        return new ViewModel();
    }

    public function designAction() {
        return new ViewModel();
    }

    public function publicityAction() {
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

}

<?php

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController,
    Zend\View\Model\ViewModel;
use Auth\Model\UserTable,
    Admin\Form\UserForm,
    Admin\Form\UserFilter,
    Auth\Model\User,
    Page\Model\FeedbackTable,
    Page\Model\CheckoutTable;

class AdminController extends AbstractActionController {

    public function indexAction() {
        $user = $this->getServiceLocator()->get('AuthService')->getIdentity();
        if (!$user['id']) {
            return $this->redirect()->toUrl('/auth/login');
        }
        return new ViewModel();
    }

    public function usersAction() {
        $userTable = new UserTable($this->getServiceLocator()->get('dbAdapter'));
        $users = $userTable->fetchAll();
        $form = new UserForm;
        return new ViewModel(array('users' => $users, 'form' => $form));
    }

    public function deleteUserAction() {
        $userTable = new UserTable($this->getServiceLocator()->get('dbAdapter'));
        $request = $this->getRequest();
        $response = $this->getResponse();

        if ($request->isPost()) {
            $postData = $request->getPost();
            $userId = (int) $postData->id;
            $rowset = $userTable->deleteUser($userId);
            if ($rowset) {
                $status = 'ok';
            } else {
                $status = 'bad';
            }
        }
        $answer = array('status' => $status);
        $response->setContent(\Zend\Json\Json::encode($answer));
        $response->getHeaders()->addHeaders(array('Content-Type' => 'application/json'));
        return $response;
    }

    public function addUserAction() {
        $userTable = new UserTable($this->getServiceLocator()->get('dbAdapter'));
        $request = $this->getRequest();
        $form = new UserForm();
        $form->setInputFilter(new UserFilter());
        $form->setData($request->getPost());

        if (!$form->isValid()) {
            $users = $userTable->fetchAll();
            $model = new ViewModel(array('error' => true, 'form' => $form, 'users' => $users));
            $model->setTemplate('admin/admin/users');
            return $model;
        }
        $data = $form->getData();
        $user = new User();
        $user->exchangeArray($data);
        $userTable->saveUser($user);
        return $this->redirect()->toUrl('/admin/users');
    }

    public function feedbacksAction() {
        $feedbackTable = new FeedbackTable($this->getServiceLocator()->get('dbAdapter'));
        $feedbacks = $feedbackTable->fetchAll();
        return new ViewModel(array('feedbacks' => $feedbacks));
    }

    public function deleteFeedbackAction() {
        $feedbackTable = new FeedbackTable($this->getServiceLocator()->get('dbAdapter'));
        $request = $this->getRequest();
        $response = $this->getResponse();

        if ($request->isPost()) {
            $postData = $request->getPost();
            $feedbackId = (int) $postData->id;
            $rowset = $feedbackTable->deleteFeedback($feedbackId);
            if ($rowset) {
                $status = 'ok';
            } else {
                $status = 'bad';
            }
        }
        $answer = array('status' => $status);
        $response->setContent(\Zend\Json\Json::encode($answer));
        $response->getHeaders()->addHeaders(array('Content-Type' => 'application/json'));
        return $response;
    }

    public function checkoutsAction() {
        $checkoutTable = new CheckoutTable($this->getServiceLocator()->get('dbAdapter'));
        $checkouts = $checkoutTable->fetchAll();
        return new ViewModel(array('checkouts' => $checkouts));
    }

    public function deleteCheckoutAction() {
        $checkoutTable = new CheckoutTable($this->getServiceLocator()->get('dbAdapter'));
        $request = $this->getRequest();
        $response = $this->getResponse();

        if ($request->isPost()) {
            $postData = $request->getPost();
            $checkoutId = (int) $postData->id;
            $rowset = $checkoutTable->deleteCheckout($checkoutId);
            if ($rowset) {
                $status = 'ok';
            } else {
                $status = 'bad';
            }
        }
        $answer = array('status' => $status);
        $response->setContent(\Zend\Json\Json::encode($answer));
        $response->getHeaders()->addHeaders(array('Content-Type' => 'application/json'));
        return $response;
    }
    
    public function addportfolioAction() {
        return new ViewModel();
    }

}

<?php

namespace Auth\Controller;

use Zend\Mvc\Controller\AbstractActionController,
    Zend\View\Model\ViewModel;
use Auth\Form\LoginForm,
    Auth\Form\LoginFilter;

class AuthController extends AbstractActionController {

    protected $authservice;

    public function getAuthService() {
        if (!$this->authservice) {
            $this->authservice = $this->getServiceLocator()->get('AuthService');
        }
        return $this->authservice;
    }

    public function loginAction() {
        if ($this->getAuthService()->hasIdentity()) {
            return $this->redirect()->toUrl('/admin/index');
        }

        $form = new LoginForm();

        return array(
            'form' => $form,
            'messages' => $this->flashmessenger()->getMessages()
        );
    }

    public function authenticateAction() {
        $form = new LoginForm();
        $form->setInputFilter(new LoginFilter());
        $redirect = '/auth/login';

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $this->getAuthService()->getAdapter()
                        ->setIdentity($request->getPost('email'))
                        ->setCredential($request->getPost('password'));

                $result = $this->getAuthService()->authenticate();
                $user = $this->getAuthService()->getAdapter()->getResultRowObject();
                // TODO refactor this
                foreach ($result->getMessages() as $message) {
                    if ($message == 'A record with the supplied identity could not be found.' || $message == 'Supplied credential is invalid.') {
                        $this->flashmessenger()->addMessage('Логин или пароль введен неправильно.');
                    }
                }

                if ($result->isValid()) {
                    $redirect = '/admin/index';
                    $userDataArray = array('id' => $user->id, 'email' => $user->email);
                    $this->getAuthService()->getStorage()->write($userDataArray);
                }
            } else {
                $model = new ViewModel(array('error' => true, 'form' => $form));
                $model->setTemplate('auth/auth/login');
                return $model;
            }
        }
        return $this->redirect()->toUrl($redirect);
    }

    public function logoutAction() {
        $this->getAuthService()->clearIdentity();
        return $this->redirect()->toUrl('/');
    }

}

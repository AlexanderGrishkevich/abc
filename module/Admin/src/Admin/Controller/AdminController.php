<?php

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController,
    Zend\View\Model\ViewModel;
use Auth\Model\UserTable,
    Admin\Form\UserForm,
    Admin\Form\UserFilter,
    Auth\Model\User,
    Page\Model\FeedbackTable,
    Page\Model\CheckoutTable,
    Page\Model\PortfolioTable,
    Page\Model\Portfolio,
    Page\Model\PortfolioImagesTable,
    Admin\Form\PortfolioForm,
    Application\Model\Headmeta,
    Application\Form\HeadmetaForm,
    Application\Model\HeadmetaTable;

class AdminController extends AbstractActionController {

    public function indexAction() {
        $this->auth();
        return new ViewModel();
    }

    public function saveHeadmetaAction() {
        $request = $this->getRequest();
        $headmetaTable = new HeadmetaTable($this->getServiceLocator()->get('dbAdapter'));
        if ($request->isPost()) {
            $postData = $request->getPost();

            $headmeta = new Headmeta();
            $form = new HeadmetaForm();

            $form->setData($postData);
            if ($form->isValid()) {
                $data = $form->getData();
                $headmeta->exchangeArray($data);
                $headmetaTable->saveHeadMeta($headmeta);
            }
        }
        

        return $this->redirect()->toUrl($_SERVER['HTTP_REFERER']);
    }

    public function auth() {
        $user = $this->getServiceLocator()->get('AuthService')->getIdentity();
        if (!$user['id']) {
            return $this->redirect()->toUrl('/auth/login');
        };
    }

    public function usersAction() {
        $this->auth();
        $userTable = new UserTable($this->getServiceLocator()->get('dbAdapter'));
        $users = $userTable->fetchAll();
        $form = new UserForm;
        return new ViewModel(array('users' => $users, 'form' => $form));
    }

    public function deleteUserAction() {
        $this->auth();
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
        $this->auth();
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
        $this->auth();
        $feedbackTable = new FeedbackTable($this->getServiceLocator()->get('dbAdapter'));
        $feedbacks = $feedbackTable->fetchAll();
        return new ViewModel(array('feedbacks' => $feedbacks));
    }

    public function deleteFeedbackAction() {
        $this->auth();
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
        $this->auth();
        $checkoutTable = new CheckoutTable($this->getServiceLocator()->get('dbAdapter'));
        $checkouts = $checkoutTable->fetchAll();
        return new ViewModel(array('checkouts' => $checkouts));
    }

    public function deleteCheckoutAction() {
        $this->auth();
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
        $this->auth();
        $id = (int) $this->params()->fromRoute('id');
        $portfolioTable = new PortfolioTable($this->getServiceLocator()->get('dbAdapter'));
        $form = new PortfolioForm;
        if (!$id) {
            $portfolio = new Portfolio();
            $portfolio = $portfolioTable->savePortfolio($portfolio);
            return new ViewModel(array('form' => $form, 'id' => $portfolio->id));
        } else {
            $portfolio = $portfolioTable->getPortfolioById($id);
            $form->bind($portfolio);
            $images = $portfolioTable->getPortfolioImagesById($id);
            return new ViewModel(array('form' => $form, 'id' => $id, 'images' => $images, 'portfolio' => $portfolio));
        }
    }

    public function addImageAction() {
        $this->auth();
        $id = (int) $this->params()->fromRoute('id');
        $sm = $this->getServiceLocator();
        $dbAdapter = $sm->get('DbAdapter');
        $request = $this->getRequest();
        $portfolioImagesTable = new PortfolioImagesTable($dbAdapter);

        if ($request->isPost()) {
            $files = $request->getFiles()->toArray();
            $file = $this->saveImage($files, $id);
            if ($file) {
                $portfolioImagesTable->save($file, $id);
                $answer = array('status' => 'ok', 'src' => $file);
            }
        }

        $response = $this->getResponse();
        $response->setContent(\Zend\Json\Json::encode($answer));
        $response->getHeaders()->addHeaders(array('Content-Type' => 'application/json'));
        return $response;
    }

    public function saveImage($file, $id) {
        $httpadapter = new \Zend\File\Transfer\Adapter\Http();
        if ($httpadapter->isValid()) {
            $pathdir = 'public/uploads/portfolio/' . $id;
            if (!is_dir($pathdir)) {
                mkdir($pathdir);
            }

            $httpadapter->setDestination($pathdir);
            foreach ($httpadapter->getFileInfo() as $info) {
                $httpadapter->addFilter('File\Rename', array(
                    'target' => $httpadapter->getDestination() . '/' . str_replace(' ', '_', $file['file']['name']),
                    'overwrite' => true,
                    'randomize' => false
                        )
                );

                if ($httpadapter->receive($info['name'])) {
                    $newfile = $httpadapter->getFileName();
                    return str_replace('\\', '/', $newfile);
                }
            }
        }
    }

    public function deleteImageAction() {
        $this->auth();
        $sm = $this->getServiceLocator();
        $dbAdapter = $sm->get('DbAdapter');
        $request = $this->getRequest();
        $portfolioImagesTable = new PortfolioImagesTable($dbAdapter);
        if ($request->isPost()) {
            $postData = $request->getPost();
            $src = 'public' . $postData->src;
            $rowset = $portfolioImagesTable->deleteImage($src);
            if ($rowset) {
                if (file_exists($src)) {
                    unlink($src);
                }
                $status = 'ok';
            } else {
                $status = 'bad';
            }
        }

        $response = $this->getResponse();
        $answer = array('status' => $status);
        $response->setContent(\Zend\Json\Json::encode($answer));
        $response->getHeaders()->addHeaders(array('Content-Type' => 'application/json'));
        return $response;
    }

    public function savePortfolioAction() {
        $this->auth();
        $id = (int) $this->params()->fromRoute('id');

        $sm = $this->getServiceLocator();
        $dbAdapter = $sm->get('DbAdapter');
        $portfolioTable = new PortfolioTable($dbAdapter);
        $post = $this->request->getPost();

        $portfolio = new Portfolio();
        $form = new PortfolioForm();

        $form->setData($post);
        if ($form->isValid()) {
            $data = $form->getData();
            $portfolio->exchangeArray($data);
            $portfolio->id = $id;
            $portfolioTable->savePortfolio($portfolio);
            return $this->redirect()->toUrl('/admin/portfolios');
        }
    }

    public function addLogoAction() {
        $this->auth();
        $id = (int) $this->params()->fromRoute('id');
        $sm = $this->getServiceLocator();
        $dbAdapter = $sm->get('DbAdapter');
        $request = $this->getRequest();
        $portfolioTable = new PortfolioTable($dbAdapter);

        if ($request->isPost()) {
            $files = $request->getFiles()->toArray();
            $file = $this->saveImage($files, $id);
            if ($file) {
                $portfolioTable->saveLogo($file, $id);
                $answer = array('status' => 'ok', 'src' => $file);
            }
        }

        $response = $this->getResponse();
        $response->setContent(\Zend\Json\Json::encode($answer));
        $response->getHeaders()->addHeaders(array('Content-Type' => 'application/json'));
        return $response;
    }

    public function addBannerAction() {
        $this->auth();
        $id = (int) $this->params()->fromRoute('id');
        $sm = $this->getServiceLocator();
        $dbAdapter = $sm->get('DbAdapter');
        $request = $this->getRequest();
        $portfolioTable = new PortfolioTable($dbAdapter);

        if ($request->isPost()) {
            $files = $request->getFiles()->toArray();
            $file = $this->saveImage($files, $id);
            if ($file) {
                $portfolioTable->saveBanner($file, $id);
                $answer = array('status' => 'ok', 'src' => $file);
            }
        }

        $response = $this->getResponse();
        $response->setContent(\Zend\Json\Json::encode($answer));
        $response->getHeaders()->addHeaders(array('Content-Type' => 'application/json'));
        return $response;
    }

    public function portfoliosAction() {
        $this->auth();
        return new ViewModel();
    }

    public function deletePortfolioAction() {
        $this->auth();
        $sm = $this->getServiceLocator();
        $dbAdapter = $sm->get('DbAdapter');
        $request = $this->getRequest();
        $portfolioTable = new PortfolioTable($dbAdapter);
        if ($request->isPost()) {
            $postData = $request->getPost();
            $src = 'public/uploads/portfolio/' . $postData->id;
            $rowset = $portfolioTable->deletePortfolio($postData->id);
            if (!$rowset) {
                $status = 'bad';
            } else {
                $status = 'ok';
            }
            foreach (glob($src . '/*') as $entry) {
                unlink($entry);
            }
        }

        $response = $this->getResponse();
        $answer = array('status' => $status);
        $response->setContent(\Zend\Json\Json::encode($answer));
        $response->getHeaders()->addHeaders(array('Content-Type' => 'application/json'));
        return $response;
    }

}

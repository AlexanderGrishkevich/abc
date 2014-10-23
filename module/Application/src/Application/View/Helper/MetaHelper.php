<?php

namespace Application\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceManager;
use Application\Model\HeadmetaTable;
use Application\Form\HeadmetaForm;

class MetaHelper extends AbstractHelper {

    protected $routeMatch;

    public function __construct($routeMatch) {
        $this->routeMatch = $routeMatch;
    }

    public function __invoke() {
        if ($this->routeMatch) {
            $controller = $this->routeMatch->getParam('controller');
            $action = $this->routeMatch->getParam('action');
            $controllerName = explode('\\', $controller);
            $dbAdapter = $this->serviceLocator->get('DbAdapter');

            $headmetaTable = new HeadmetaTable($dbAdapter);
            $headmeta = $headmetaTable->getMetaByControllerAndAction(strtolower($controllerName[2]), $action);
            $this->authService = $this->serviceLocator->get('AuthService');

            if ($this->authService->hasIdentity()) {
                $form = new HeadmetaForm;
                $form->bind($headmeta);
                return array('title' => $headmeta->title, 'description' => $headmeta->description, 'keywords' => $headmeta->keywords, 'form' => $form);
            } 

            return array('title' => $headmeta->title, 'description' => $headmeta->description, 'keywords' => $headmeta->keywords, 'form' => null);
        }
    }

    public function setServiceLocator(ServiceManager $serviceLocator) {
        $this->serviceLocator = $serviceLocator;
    }

}

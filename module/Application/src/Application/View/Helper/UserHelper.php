<?php

namespace Application\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceManager;
use Application\Form\HeadmetaForm;
use Application\Model\HeadmetaTable;

class UserHelper extends AbstractHelper {

    public function __invoke() {
    }

    public function setServiceLocator(ServiceManager $serviceLocator) {
        $this->serviceLocator = $serviceLocator;
    }

}

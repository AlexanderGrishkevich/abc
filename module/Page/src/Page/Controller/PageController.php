<?php

namespace Page\Controller;

use Zend\Mvc\Controller\AbstractActionController,
    Zend\View\Model\ViewModel;

class PageController extends AbstractActionController {

    public function promotionAction() {
        return new ViewModel();
    }

    public function marketingAction() {
        return new ViewModel();
    }

    public function agreementAction() {
        return new ViewModel();
    }

    public function safetyAction() {
        return new ViewModel();
    }
    
    public function priceAction() {
        return new ViewModel();
    }
    
    public function requisitesAction() {
        return new ViewModel();
    }
    
    public function bannerbuttonAction() {
        return new ViewModel();
    }
}

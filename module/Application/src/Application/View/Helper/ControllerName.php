<?php
namespace Application\View\Helper;

use Zend\View\Helper\AbstractHelper;

class ControllerName extends AbstractHelper {

    protected $routeMatch;

    public function __construct($routeMatch) {
        $this->routeMatch = $routeMatch;
    }

    public function __invoke() {
        if ($this->routeMatch) {
            $controller = $this->routeMatch->getParam('controller');
            $action = $this->routeMatch->getParam('action');
            $controllerName = explode('\\', $controller);
            return array('controller' => strtolower($controllerName[2]), 'action' => $action);
        }
    }
}
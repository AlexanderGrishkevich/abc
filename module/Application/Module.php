<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module {

    public function onBootstrap(MvcEvent $e) {
        $this->setDefaultTranslator($e);
        $eventManager = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }

    public function getConfig() {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig() {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getViewHelperConfig() {
        return array(
            'factories' => array(
                'ControllerName' => function ($sm) {
                    $match = $sm->getServiceLocator()->get('application')->getMvcEvent()->getRouteMatch();
                    $viewHelper = new \Application\View\Helper\ControllerName($match);
                    return $viewHelper;
                },
                'MetaHelper' => function ($helperPluginManager) {
                    $serviceLocator = $helperPluginManager->getServiceLocator();
                    $match = $serviceLocator->get('application')->getMvcEvent()->getRouteMatch();
                    $viewHelper = new View\Helper\MetaHelper($match);
                    $viewHelper->setServiceLocator($serviceLocator);
                    return $viewHelper;
                },
                'UserHelper' => function ($helperPluginManager) {
                    $serviceLocator = $helperPluginManager->getServiceLocator();
                    $viewHelper = new View\Helper\UserHelper();
                    $viewHelper->setServiceLocator($serviceLocator);
                    return $viewHelper;
                },
            )
        );
    }

    protected function setDefaultTranslator($e) {
        $translator = $e->getApplication()->getServiceManager()->get('translator');

        $type = 'phpArray';
        $filename = 'data/language/ru/Zend_Validate.php';
        $textDomain = 'default';
        $locale = 'ru_RU';

        $translator->addTranslationFile($type, $filename, $textDomain, $locale);

        \Zend\Validator\AbstractValidator::setDefaultTranslator($translator);
    }

}

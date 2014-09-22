<?php

namespace Page;

class Module {

    public function getAutoloaderConfig() {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . str_replace('\\', '/', __NAMESPACE__),
                ),
            ),
        );
    }

    public function getConfig() {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getServiceConfig() {
        return array(
            'factories' => array(
            ),
        );
    }

    public function getViewHelperConfig() {
        return array(
            'factories' => array(
                'Portfolio' => function ($helperPluginManager) {
                    $serviceLocator = $helperPluginManager->getServiceLocator();
                    $viewHelper = new View\Helper\PortfolioHelper();
                    $viewHelper->setServiceLocator($serviceLocator);
                    return $viewHelper;
                },
                'Marketing' => function ($helperPluginManager) {
                    $serviceLocator = $helperPluginManager->getServiceLocator();
                    $viewHelper = new View\Helper\MarketingHelper();
                    $viewHelper->setServiceLocator($serviceLocator);
                    return $viewHelper;
                },
                'Promotion' => function ($helperPluginManager) {
                    $serviceLocator = $helperPluginManager->getServiceLocator();
                    $viewHelper = new View\Helper\PromotionHelper();
                    $viewHelper->setServiceLocator($serviceLocator);
                    return $viewHelper;
                }
            )
        );
    }

}

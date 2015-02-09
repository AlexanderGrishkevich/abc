<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
return array(
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Index',
                        'action' => 'index',
                    ),
                ),
            ),
            // The following is a route to simplify getting started creating
// new controllers and actions without needing to create a new
// module. Simply drop new controllers in, and you can access them
// using the path /application/:controller/:action
            'application' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/application',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller' => 'Index',
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'navigation' => array(
        'default' => array(
            array(
                'label' => 'Продвижение',
                'route' => 'page',
                'action' => 'promotion',
                'resource' => 'page',
                'pages' => array(
                    array(
                        'label' => 'Продвижение',
                        'route' => 'page',
                        'action' => 'promotion',
                    ),
                    array(
                        'label' => 'Старт быстрых продаж',
                        'route' => 'page',
                        'action' => 'fast-sales',
                    ),
                    array(
                        'label' => 'Пакетные решения',
                        'route' => 'page',
                        'action' => 'services',
                    ),
                    array(
                        'label' => 'Массовое привлечение клиентов',
                        'route' => 'page',
                        'action' => 'landing',
                    )
                )
            ),
            array(
                'label' => 'WEB Дизайн',
                'route' => 'page',
                'action' => 'design',
                'resource' => 'page',
                'pages' => array(
                    array(
                        'label' => 'WEB Дизайн',
                        'route' => 'page',
                        'action' => 'design',
                    ),
                    array(
                        'label' => 'Портфолио',
                        'route' => 'page',
                        'action' => 'portfolio',
                    )
                )
            ),
            array(
                'label' => 'WEB Маркетинг',
                'route' => 'page',
                'action' => 'marketing',
                'resource' => 'page',
                'pages' => array(
                    array(
                        'label' => 'WEB Маркетинг',
                        'route' => 'page',
                        'action' => 'marketing',
                    ),
                    array(
                        'label' => 'Маркетинговые исследования',
                        'route' => 'page',
                        'action' => 'm-research',
                    ),
                    array(
                        'label' => 'Продающие страницы',
                        'route' => 'page',
                        'action' => 'sell-pages',
                    )
                )
            ),
            array(
                'label' => 'Реклама и PR',
                'route' => 'page',
                'action' => 'pr',
                'resource' => 'page',
                'pages' => array(
                    array(
                        'label' => 'Реклама и PR',
                        'route' => 'page',
                        'action' => 'pr',
                    ),
                    array(
                        'label' => 'Узнаваемость бренда',
                        'route' => 'page',
                        'action' => 'brend',
                    )
                )
            ),
            array(
                'label' => 'Контакты',
                'route' => 'page',
                'action' => 'contacts',
                'resource' => 'page',
                'pages' => array(
                    array(
                        'label' => 'Контакты',
                        'route' => 'page',
                        'action' => 'contacts',
                    ),
                    array(
                        'label' => '+375 29 615-27-93',
                        'route' => 'page',
                        'action' => 'contacts',
                    ),
                    array(
                        'label' => '+375 33 615-27-93',
                        'route' => 'page',
                        'action' => 'contacts',
                    )
                )
            )
        )
    ),
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
        'aliases' => array(
            'translator' => 'MvcTranslator',
        ),
        'factories' => array(
            'Navigation' => 'Zend\Navigation\Service\DefaultNavigationFactory'
        )
    ),
    'translator' => array(
        'locale' => 'ru_RU',
        'translation_file_patterns' => array(
            array(
                'type' => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern' => '%s.mo',
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Application\Controller\Index' => 'Application\Controller\IndexController'
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions' => true,
        'doctype' => 'HTML5',
        'not_found_template' => 'error/404',
        'exception_template' => 'error/index',
        'template_map' => array(
            'layout/layout' => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404' => __DIR__ . '/../view/error/404.phtml',
            'error/index' => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    // Placeholder for console routes
    'console' => array(
        'router' => array(
            'routes' => array(
            ),
        ),
    ),
);

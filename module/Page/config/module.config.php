<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Page\Controller\Page' => 'Page\Controller\PageController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'page' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '[/:action]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'Page\Controller\Page',
                        'action' => 'company',
                    ),
                ),
            ),
        ),
    ),
   'service_manager' => array(
        'factories' => array(
        ),
   ),

    'view_manager' => array(
        'template_path_stack' => array(
            'Page' => __DIR__ . '/../view',
        ),
    ),
);
<?php

namespace Application;

return array(
    'controllers' => array(
        'invokables' => include 'controllers.config.php',
    ),
    'doctrine' => array(
        'driver' => array(
            __NAMESPACE__ . '_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(
                    __DIR__ . '/../src/' . __NAMESPACE__ . '/Entity'
                )
            ),
            'orm_default' => array(
                'drivers' => array(
                    __NAMESPACE__ .  '\Entity' => __NAMESPACE__ .  '_driver'
                ),
            )
        )
    ),
    'data-fixture' => array(
        __NAMESPACE__ .  'Application_fixture' => __DIR__ . '/../src/' . __NAMESPACE__ . '/Fixture',
    ),
    'service_manager' => array(
        'factories' => array(
            'navigation' => 'Zend\Navigation\Service\DefaultNavigationFactory',
        ),
    ),
    'router' => include 'router.config.php',
    'navigation' => include 'menu.config.php',
);

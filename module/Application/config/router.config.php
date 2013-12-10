<?php

return array(
    'routes' => array(
        'home' => array(
            'type' => 'Zend\Mvc\Router\Http\Literal',
            'options' => array(
                'route'    => '/',
                'defaults' => array(
                    'controller' => 'index',
                    'action'     => 'index',
                ),
            ),
            'may_terminate' => true
        ),
        'logout' => array(
            'type' => 'Zend\Mvc\Router\Http\Literal',
            'options' => array(
                'route'    => '/logout',
                'defaults' => array(
                    'controller' => 'usuario',
                    'action'     => 'logout',
                ),
            ),
            'may_terminate' => true
        ),
        'crud' => array(
            'type' => 'Segment',
            'options' => array(
                'route' => '/:controller[/:action][?id=:id]',
                'defaults' => array(
                    'action' => 'index',
                    'id' => null,
                ),
                'constraints' => array(
                    'id' => '[0-9]+',
                )
            ),
            'priority' => 0
        ),
    ),
);

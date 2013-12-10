<?php

namespace Application;

use Zend\Mvc\ModuleRouteListener,
    Zend\Mvc\MvcEvent,
    Zend\ModuleManager\ModuleManager,
    Zend\Authentication\AuthenticationService,
    Zend\Authentication\Storage\Session as SessionStorage;

class Module
{

    public function onBootstrap(MvcEvent $e)
    {
        (new ModuleRouteListener())->attach($e->getApplication()->getEventManager());
    }

    public function getConfig()
    {
        return include __DIR__ . '../../config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    'Application' => __DIR__ . '/Application'
                ),
            ),
        );
    }

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'application.usuario' => function ($sm) {
                    return new Service\Usuario($sm->get('Doctrine\ORM\EntityManager'));
                },
                'application.orgao' => function ($sm) {
                    return new Service\Orgao($sm->get('Doctrine\ORM\EntityManager'));
                }
            )
        );
    }

    public function getViewHelperConfig()
    {
        return array(
            'factories' => array(
                'navigation' => function ($sm) {

                    //$auth = $sm->getServiceLocator()->get('Zend\Authentication\AuthenticationService');

                    $navigation = $sm->get('Zend\View\Helper\Navigation');
                    //if ($auth->getIdentity()) {
                        //$navigation->setAcl($auth->getIdentity()->getAcl())->setRole('user');
                    //}

                    return $navigation;
                }
            )
        );
    }

}

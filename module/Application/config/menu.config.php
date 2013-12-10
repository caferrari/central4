<?php

namespace Application;

return array(
    'default' => array(
        'home' =>  array(
            'label' => 'Home',
            'route' => 'home',
            'order' => -1000
        ),
        'cadastros' => array(
            'label' => 'Cadastros',
            'uri' => '#',
            'order' => 0,
            'resource' => 'cadastros',
            'pages' => array(
                array(
                    'label' => 'Órgãos',
                    'route' => 'crud',
                    'controller' => 'orgao',
                    'action' => 'index',
                    'resource' => 'orgao',
                    'icon' => 'icon-building',
                    'pages' => array(
                        array(
                            'label' => 'Adicionar Órgão',
                            'route' => 'crud',
                            'controller' => 'orgao',
                            'action' => 'novo',
                        ),
                        array(
                            'label' => 'Editar Órgão',
                            'route' => 'crud',
                            'controller' => 'orgao',
                            'action' => 'editar',
                        )
                    )
                ),
                array(
                    'label' => 'Usuários',
                    'route' => 'crud',
                    'controller' => 'usuario',
                    'action' => 'index',
                    'resource' => 'usuario',
                    'icon' => 'icon-user',
                    'pages' => array(
                        array(
                            'label' => 'Adicionar Usuário',
                            'route' => 'crud',
                            'controller' => 'usuario',
                            'action' => 'novo',
                        ),
                        array(
                            'label' => 'Editar Usuário',
                            'route' => 'crud',
                            'controller' => 'usuario',
                            'action' => 'editar',
                        )
                    )
                )
            )
        )
    ),
);

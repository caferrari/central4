<?php

namespace Application\Form;

use Common\AbstractForm;

class Usuario extends AbstractForm
{

    public function __construct()
    {

        parent::__construct('usuario');

        $this->loadInputFilter();
        $this->setAttribute('method', 'post');

        $this->add(
            array(
                'name' => 'id',
                'type' => 'hidden'
            )
        );

        $this->add(
            array(
                'name' => 'nome',
                'type' => 'text',
                'options' => array(
                    'label' => 'Nome'
                ),
                'attributes' => array(
                    'placeholder' => 'Nome do Usuário',
                    'class' => 'span4'
                )
            )
        );

        $this->add(
            array(
                'name' => 'email',
                'type' => 'email',
                'options' => array(
                    'label' => 'E-mail'
                ),
                'attributes' => array(
                    'placeholder' => 'seuemail@dominio.com',
                    'class' => 'span3'
                )
            )
        );


        $this->add(
            array(
                'name' => 'senha',
                'type' => 'password',
                'options' => array(
                    'label' => 'Senha',
                ),
                'attributes' => array(
                    'class' => 'span2'
                )
            )
        );

        $this->add(
            array(
                'type' => 'Zend\Form\Element\Csrf',
                'name' => 'security'
            )
        );

        $this->add(
            array(
                'name' => 'tipo',
                'type' => 'Zend\Form\Element\Select',
                'options' => array(
                    'label' => 'Tipo',
                    'value_options' => array(
                        'admin' => 'Administrador',
                        'admin-orgao' => 'Administrador de Órgão',
                        'revisor' => 'Revisor',
                        'atendente' => 'Atendente'
                    )
                )
            )
        );
    }
}

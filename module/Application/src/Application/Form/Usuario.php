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
                'name' => 'isAdmin',
                'type' => 'checkbox',
                'options' => array(
                    'label' => 'Administrador',
                    'checked_value' => true,
                    'unchecked_value' => false
                )
            )
        );

        $this->add(
            array(
                'name' => 'isRevisor',
                'type' => 'checkbox',
                'options' => array(
                    'label' => 'Revisor',
                    'checked_value' => true,
                    'unchecked_value' => false
                )
            )
        );

        $this->add(
            array(
                'type' => 'csrf',
                'name' => 'security'
            )
        );

    }
}

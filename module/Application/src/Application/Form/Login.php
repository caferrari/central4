<?php

namespace Application\Form;

use Zend\Form\Form;

class Login extends Form
{

    public function __construct()
    {

        parent::__construct('login');
        $this->setAttribute('method', 'post');

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

    }
}

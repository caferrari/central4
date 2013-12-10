<?php

namespace Application\Form;

use Common\AbstractForm,
    Application\Filter\Orgao as InputFilter;;

class Orgao extends AbstractForm
{

    public function __construct()
    {

        parent::__construct('orgao');
        $this->setInputFilter(new InputFilter);
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
                    'label' => 'Nome do órgão'
                ),
                'attributes' => array(
                    'placeholder' => 'Nome do órgão',
                    'class' => 'span5'
                )
            )
        );

        $this->add(
            array(
                'name' => 'responsavel',
                'type' => 'text',
                'options' => array(
                    'label' => 'Responsável'
                ),
                'attributes' => array(
                    'placeholder' => 'Nome do responsável'
                )
            )
        );


        $this->add(
            array(
                'name' => 'email',
                'type' => 'email',
                'required' => false,
                'options' => array(
                    'label' => 'E-mail'
                ),
                'attributes' => array(
                    'placeholder' => 'email@dominio.com',
                    'class' => 'span3'
                )
            )
        );

        $this->add(
            array(
                'name' => 'telefone',
                'type' => 'text',
                'options' => array(
                    'label' => 'Telefone'
                ),
                'attributes' => array(
                    'placeholder' => '63 9999-9999',
                    'class' => 'span4'
                )
            )
        );

    }

}

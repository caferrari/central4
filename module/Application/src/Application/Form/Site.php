<?php

namespace Application\Form;

use Common\AbstractForm,
    Application\Filter\Site as InputFilter;;

class Site extends AbstractForm
{

    public function __construct()
    {

        parent::__construct('site');
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
                    'label' => 'Nome do Site'
                ),
                'attributes' => array(
                    'placeholder' => 'Digite o nome do site',
                    'class' => 'span5'
                )
            )
        );

        $this->add(
            array(
                'name' => 'sigla',
                'type' => 'text',
                'options' => array(
                    'label' => 'Sigla'
                ),
                'attributes' => array(
                    'placeholder' => 'exemplo',
                    'class' => 'span2',
                    'maxlength' => '30'
                )
            )
        );

    }

}

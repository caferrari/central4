<?php

namespace Application\Filter;

use Zend\InputFilter\InputFilter;

class Site extends InputFilter
{

    public function __construct()
    {

        $this->add(
            array(
                'name' => 'id',
                'required' => false,
                'validators' => array(
                    array(
                        'name' => 'Digits',
                        'options' => array(
                            'messages' => array('notDigits' => 'ID inválido')
                        )
                    )
                )
            )
        );

        $this->add(
            array(
                'name' => 'nome',
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim')
                ),
                'validators' => array(
                    array(
                        'name' => 'NotEmpty',
                        'options' => array(
                            'messages' => array('isEmpty' => 'Digite um nome para o site')
                        )
                    )
                )
            )
        );

        $this->add(
            array(
                'name' => 'sigla',
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim')
                ),
                'validators' => array(
                    array(
                        'name' => 'NotEmpty',
                        'options' => array(
                            'messages' => array('isEmpty' => 'Digite uma sigla para o site')
                        )
                    ),
                    array(
                        'name' => 'Regex',
                        'options' => array(
                            'pattern' => '@^[a-z0-9_-]{2,30}$@',
                            'messages' => array('regexNotMatch' => 'Sigla inválida')
                        )
                    )
                )
            )
        );

    }

}

<?php

namespace Common;

use Zend\Form\Form,
    Zend\Di\Di,
    Zend\InputFilter\InputFilter;

abstract class AbstractForm extends Form
{

    public function loadInputFilter($filtersNamespace = 'Application\Filter') {

        $parts = explode('\\', static::class);
        $class = "$filtersNamespace\\" . end($parts);

        try {
            $filter = (new Di)->get($class);
        } catch (\Exception $e) {
            $filter = new InputFilter;
        }

        $this->setInputFilter($filter);
    }

    private function getExceptionMessage()
    {
        $errors  = $this->getInputFilter()->getMessages();
        $messages = array();

        foreach ($errors as $error) {
            $messages[] = array_shift($error);
        }

        return implode('; ', $messages);

    }

}

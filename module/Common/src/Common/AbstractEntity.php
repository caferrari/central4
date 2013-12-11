<?php

namespace Common;

abstract class AbstractEntity
{

    protected $inputFilter;

    public function __construct(array $data = null)
    {
        if ($data) {
            $this->setData($data);
        }
        $this->inputFilter = null;
    }

    public function __set($key, $value)
    {
        $setMethod = 'set' . ucfirst($key);
        if (method_exists($this, $setMethod)) {
            $this->$setMethod($value);
        } else {
            $this->$key = $value;
        }
    }

    public function __get($key)
    {
        return $this->$key;
    }

    public function setData($data)
    {
        foreach ($data as $key => $value) {
            $this->__set($key, $value);
        }
    }

    public function toArray()
    {
        $dados = get_object_vars($this);
        foreach ($dados as $k => $item) {
            if (is_object($item) && isset($item->id)) {
                $dados[$k] = $item->id;
            } else {
                $dados[$k] = $item;
            }

        }
        return $dados;
    }

    public function isValid()
    {
        $inputFilter = $this->getInputFilter();
        $inputFilter->setData($this->toArray());
        return $inputFilter->isValid();
    }

    public function validate()
    {
        if (!$this->isValid()) {
            throw new \InvalidArgumentException($this->getInvalidMessages());
        }

        return true;
    }

    private function getInvalidMessages() {
        $messages = array();
        foreach ($this->getInputFilter()->getMessages() as $field) {
            foreach ($field as $message) {
                $messages[] = $message;
            }
        }

        return implode(';', $messages);
    }

    public function getInputFilter()
    {
        if (null == $this->inputFilter) {
            $filter = $this->getInputFilterClassName();
            if (!class_exists($filter)) {
                throw new \RuntimeException("Filter \"{$filter}\" not found");
            }
            $this->inputFilter = new $filter();
        }
        return $this->inputFilter;
    }

    private function getInputFilterClassName()
    {
        $class = get_called_class();
        $class = str_replace('DoctrineORMModule\\Proxy\\__CG__\\', '', $class);
        $classParts = explode('\\', $class);
        $classParts[1] = 'Filter';
        return implode('\\', $classParts);
    }

    public function __toString()
    {
        return json_encode($this->toArray());
    }

}

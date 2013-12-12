<?php

namespace Common\Helper;

use Zend\Form\View\Helper\FormRow,
    Zend\Form\ElementInterface;

class BootstrapRow extends FormRow
{

    protected $prepend = array();
    protected $append = array();

    protected $element;

    public function render(ElementInterface $element)
    {
        $this->prepend = array();
        $this->append = array();

        $this->element = $element;
        return $this;
    }

    public function __toString()
    {
        $element = $this->element;

        $elementErrorsHelper = $this->getElementErrorsHelper();

        $inputErrorClass = $this->getInputErrorClass();
        $elementErrors   = $elementErrorsHelper->render($element);

        // Does this element have errors ?
        if (!empty($elementErrors) && !empty($inputErrorClass)) {
            $classAttributes = ($element->hasAttribute('class') ? $element->getAttribute('class') . ' ' : '');
            $classAttributes = $classAttributes . $inputErrorClass;

            $element->setAttribute('class', $classAttributes);
        }

        if (!$element->hasAttribute('id')) {
            $inputId = 'input' . ucfirst($element->getAttribute('name'));
            $element->setAttribute('id', $inputId);
        } else {
            $inputId = $element->getAttribute('id');
        }

        $markup = <<<EOD
<div class="control-group%extraClass">
    <label for="{$inputId}" class="control-label">%label:</label>
    <div class="controls">
        %input
        %help
    </div>
</div>
EOD;

        $label = $this->renderLabel();
        $input = $this->renderInput();


        if (!$this->renderErrors) {
            $elementErrors = '';
            $markup = str_replace('%extraClass', '', $markup);
        }
        $markup = str_replace('%label', $label, $markup);
        $markup = str_replace('%input', $input, $markup);
        if ($elementErrors) {
            $elementErrors = '<span class="help-inline">' . $elementErrors . '</span>';
            $markup = str_replace('%extraClass', ' error', $markup);
        } else {
            $markup = str_replace('%extraClass', '', $markup);
        }
        $markup = str_replace('%help', $elementErrors, $markup);

        return $markup;

    }

    public function renderLabel()
    {
        $escapeHtmlHelper = $this->getEscapeHtmlHelper();
        $label  = $this->element->getLabel();
        if (null !== ($translator = $this->getTranslator())) {
            $label = $translator->translate(
                $label, $this->getTranslatorTextDomain()
            );
        }

        return $escapeHtmlHelper($label);
    }

    public function renderInput()
    {
        $elementHelper = $this->getElementHelper();
        $markup = '%input';

        $classes = array();

        if ($this->prepend) {
            $classes[] = 'input-prepend';
        }

        if ($this->append) {
            $classes[] = 'input-append';
        }

        if ($classes) {
            $markup = '<div class="%classes">%prepend%input%append</div>';

            $markup = str_replace('%classes', implode(' ', $classes), $markup);
            $markup = str_replace('%prepend', implode('', $this->prepend), $markup);
            $markup = str_replace('%append', implode('', $this->append), $markup);

        }

        return str_replace('%input', $elementHelper->render($this->element), $markup);
    }

    public function prepend($code)
    {
        $this->prepend[] = $code;
        return $this;
    }

    public function append($code)
    {
        $this->append[] = $code;
        return $this;
    }

    public function prependIcon($iconClass)
    {
        $this->prepend("<span class=\"add-on\"><i class=\"{$iconClass}\"></i></span>");
        return $this;
    }

    public function appendIcon($iconClass)
    {
        $this->append("<span class=\"add-on\"><i class=\"{$iconClass}\"></i></span>");
        return $this;
    }

}

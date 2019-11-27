<?php

namespace ISConfiguracao\Form;

use Zend\InputFilter\InputFilter;

class CapacidadeFilter extends InputFilter
{
    public function __construct()
    {
        $this->addElements();
    }

    private function addElements()
    {
        $this->add(array(
            'name' => 'numero',
            'required' => true,
            'filters' => array(array('name' => 'StripTags'), array('name' => 'StringTrim')),
            'validators' => array(array('name' => 'NotEmpty', 'options' => array('messages' => array('isEmpty' => 'Campo obrigatório'))))
        ));

        $this->add(array(
            'name' => 'unidadeCurricular',
            'required' => true,
            'filters' => array(array('name' => 'StripTags'), array('name' => 'StringTrim')),
            'validators' => array(array('name' => 'NotEmpty', 'options' => array('messages' => array('isEmpty' => 'Campo obrigatório'))))
        ));

        $this->add(array(
            'name' => 'descricao',
            'required' => true,
            'filters' => array(array('name' => 'StripTags'), array('name' => 'StringTrim')),
            'validators' => array(array('name' => 'NotEmpty', 'options' => array('messages' => array('isEmpty' => 'Campo obrigatório'))))
        ));
    }
}

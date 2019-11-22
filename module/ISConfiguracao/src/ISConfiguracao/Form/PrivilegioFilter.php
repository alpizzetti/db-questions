<?php

namespace ISConfiguracao\Form;

use Zend\InputFilter\InputFilter;

class PrivilegioFilter extends InputFilter
{
    public function __construct()
    {
        $this->addElements();
    }

    private function addElements()
    {
        $this->add(array(
            'name' => 'grupo',
            'required' => true,
            'filters' => array(array('name' => 'StripTags'), array('name' => 'StringTrim')),
            'validators' => array(array('name' => 'NotEmpty', 'options' => array('messages' => array('isEmpty' => 'Campo obrigatório'))))
        ));

        $this->add(array(
            'name' => 'funcionalidade',
            'required' => true,
            'filters' => array(array('name' => 'StripTags'), array('name' => 'StringTrim')),
            'validators' => array(array('name' => 'NotEmpty', 'options' => array('messages' => array('isEmpty' => 'Campo obrigatório'))))
        ));

        $this->add(array(
            'name' => 'escrever',
            'required' => true,
            'filters' => array(array('name' => 'StripTags'), array('name' => 'StringTrim')),
            'validators' => array(array('name' => 'NotEmpty', 'options' => array('messages' => array('isEmpty' => 'Campo obrigatório'))))
        ));

        $this->add(array(
            'name' => 'ler',
            'required' => true,
            'filters' => array(array('name' => 'StripTags'), array('name' => 'StringTrim')),
            'validators' => array(array('name' => 'NotEmpty', 'options' => array('messages' => array('isEmpty' => 'Campo obrigatório'))))
        ));
    }
}

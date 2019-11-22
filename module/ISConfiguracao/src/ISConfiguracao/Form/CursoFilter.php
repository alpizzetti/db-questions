<?php

namespace ISConfiguracao\Form;

use Zend\InputFilter\InputFilter;

class CursoFilter extends InputFilter
{
    public function __construct()
    {
        $this->addElements();
    }

    private function addElements()
    {
        $this->add(array(
            'name' => 'nome',
            'required' => true,
            'filters' => array(array('name' => 'StripTags'), array('name' => 'StringTrim')),
            'validators' => array(array('name' => 'NotEmpty', 'options' => array('messages' => array('isEmpty' => 'Campo obrigatório'))))
        ));

        $this->add(array(
            'name' => 'tipo',
            'required' => true,
            'filters' => array(array('name' => 'StripTags'), array('name' => 'StringTrim')),
            'validators' => array(array('name' => 'NotEmpty', 'options' => array('messages' => array('isEmpty' => 'Campo obrigatório'))))
        ));

        $this->add(array(
            'name' => 'unidade',
            'required' => true,
            'filters' => array(array('name' => 'StripTags'), array('name' => 'StringTrim')),
            'validators' => array(array('name' => 'NotEmpty', 'options' => array('messages' => array('isEmpty' => 'Campo obrigatório'))))
        ));
    }
}

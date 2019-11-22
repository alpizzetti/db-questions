<?php

namespace ISConfiguracao\Form;

use Zend\InputFilter\InputFilter;

class GrupoFilter extends InputFilter
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
            'name' => 'professor',
            'required' => true,
            'filters' => array(array('name' => 'StripTags'), array('name' => 'StringTrim')),
            'validators' => array(array('name' => 'NotEmpty', 'options' => array('messages' => array('isEmpty' => 'Campo obrigatório'))))
        ));

        $this->add(array(
            'name' => 'administrador',
            'required' => true,
            'filters' => array(array('name' => 'StripTags'), array('name' => 'StringTrim')),
            'validators' => array(array('name' => 'NotEmpty', 'options' => array('messages' => array('isEmpty' => 'Campo obrigatório'))))
        ));

        $this->add(array(
            'name' => 'moderador',
            'required' => true,
            'filters' => array(array('name' => 'StripTags'), array('name' => 'StringTrim')),
            'validators' => array(array('name' => 'NotEmpty', 'options' => array('messages' => array('isEmpty' => 'Campo obrigatório'))))
        ));
    }
}

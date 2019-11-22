<?php

namespace ISConfiguracao\Form;

use Zend\InputFilter\InputFilter;

class MeusDadosSenhaFilter extends InputFilter
{
    public function __construct()
    {
        $this->addElements();
    }

    private function addElements()
    {
        $this->add(array(
            'name' => 'senha_atual',
            'required' => true,
            'filters' => array(array('name' => 'StripTags'), array('name' => 'StringTrim')),
            'validators' => array(array('name' => 'NotEmpty', 'options' => array('messages' => array('isEmpty' => 'Informe a senha'))))
        ));

        $this->add(array(
            'name' => 'senha',
            'required' => true,
            'filters' => array(array('name' => 'StripTags'), array('name' => 'StringTrim')),
            'validators' => array(array('name' => 'NotEmpty', 'options' => array('messages' => array('isEmpty' => 'Informe a senha'))))
        ));

        $this->add(array(
            'name' => 'senha_repete',
            'required' => true,
            'filters' => array(array('name' => 'StripTags'), array('name' => 'StringTrim')),
            'validators' => array(array('name' => 'NotEmpty', 'options' => array('messages' => array('isEmpty' => 'Informe a senha de confirmação'))))
        ));

        $this->add(array(
            'name' => 'senha_repete',
            'required' => true,
            'filters' => array(array('name' => 'StripTags'), array('name' => 'StringTrim')),
            'validators' => array(
                array(
                    'name' => 'Identical',
                    'options' => array(
                        'token' => 'senha',
                        'messages' => array(
                            \Zend\Validator\Identical::NOT_SAME => 'A senha de confirmação não corresponde'
                        )
                    )
                )
            )
        ));
    }
}

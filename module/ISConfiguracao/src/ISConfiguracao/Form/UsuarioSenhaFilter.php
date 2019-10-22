<?php

namespace ISConfiguracao\Form;

use Zend\InputFilter\InputFilter;

class UsuarioSenhaFilter extends InputFilter
{

    public function __construct()
    {
        $this->addElements();
    }

    private function addElements()
    {
        $this->add(array(
            'name' => 'senha',
            'required' => true,
            'filters' => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array('name' => 'NotEmpty', 'options' => array('messages' => array('isEmpty' => 'Informe a senha'))),
                array('name' => 'StringLength', 'options' => array('min' => 4, 'max' => 20, 'messages' => array('stringLengthTooShort' => 'Tamanho mínimo 4 caracteres', 'stringLengthTooLong' => 'Tamanho máximo 20 caracteres'))),
            )
        ));

        $this->add(array(
            'name' => 'senha_repete',
            'required' => true,
            'filters' => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array('name' => 'NotEmpty', 'options' => array('messages' => array('isEmpty' => 'Informe a senha de confirmação'))),
                array('name' => 'StringLength', 'options' => array('min' => 4, 'max' => 20, 'messages' => array('stringLengthTooShort' => 'Tamanho mínimo 4 caracteres', 'stringLengthTooLong' => 'Tamanho máximo 20 caracteres'))),
            )
        ));

        $this->add(array(
            'name' => 'senha_repete',
            'required' => true,
            'filters' => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array(
                    'name' => 'Identical', 'options' => array(
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

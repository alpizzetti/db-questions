<?php

namespace ISConfiguracao\Form;

use Zend\InputFilter\InputFilter;

class UsuarioDadosFilter extends InputFilter
{

    public function __construct($acao = "novo")
    {
        $this->addElements($acao);
    }

    private function addElements($acao)
    {
        $this->add(array(
            'name' => 'unidade',
            'required' => true,
            'filters' => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array('name' => 'NotEmpty', 'options' => array('messages' => array('isEmpty' => 'Campo obrigatório')))
            )
        ));

        $this->add(array(
            'name' => 'grupo',
            'required' => true,
            'filters' => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array('name' => 'NotEmpty', 'options' => array('messages' => array('isEmpty' => 'Campo obrigatório')))
            )
        ));

        $this->add(array(
            'name' => 'sexo',
            'required' => true,
            'filters' => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array('name' => 'NotEmpty', 'options' => array('messages' => array('isEmpty' => 'Campo obrigatório')))
            )
        ));

        $this->add(array(
            'name' => 'nome',
            'required' => true,
            'filters' => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array('name' => 'NotEmpty', 'options' => array('messages' => array('isEmpty' => 'Campo obrigatório')))
            )
        ));

        $this->add(array(
            'name' => 'matricula',
            'required' => true,
            'filters' => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array('name' => 'NotEmpty', 'options' => array('messages' => array('isEmpty' => 'Campo obrigatório')))
            )
        ));

        $this->add(array(
            'name' => 'email',
            'required' => true,
            'filters' => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array('name' => 'NotEmpty', 'options' => array('messages' => array('isEmpty' => 'Campo obrigatório')))
            )
        ));

        if ($acao == "novo") {
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
                'name' => 'confirmacao',
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
                'name' => 'confirmacao',
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
        } else {
            $this->add(array('name' => 'unidade', 'required' => false));
        }
    }
}

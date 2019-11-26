<?php

namespace ISCadastro\Form;

use Zend\InputFilter\InputFilter;

class QuestaoFilter extends InputFilter
{
    public function __construct()
    {
        $this->addElements();
    }

    private function addElements()
    {
        $this->add(array(
            'name' => 'unidade_curricular',
            'required' => true,
            'filters' => array(array('name' => 'StripTags'), array('name' => 'StringTrim')),
            'validators' => array(
                array(
                    'name' => 'NotEmpty',
                    'options' => array(
                        'messages' => array('isEmpty' => 'Campo obrigatório')
                    )
                )
            )
        ));

        $this->add(array(
            'name' => 'dificuldade',
            'required' => true,
            'filters' => array(array('name' => 'StripTags'), array('name' => 'StringTrim')),
            'validators' => array(
                array(
                    'name' => 'NotEmpty',
                    'options' => array(
                        'messages' => array('isEmpty' => 'Campo obrigatório')
                    )
                )
            )
        ));

        $this->add(array(
            'name' => 'capacidade',
            'required' => true,
            'filters' => array(array('name' => 'StripTags'), array('name' => 'StringTrim')),
            'validators' => array(
                array(
                    'name' => 'NotEmpty',
                    'options' => array(
                        'messages' => array('isEmpty' => 'Campo obrigatório')
                    )
                )
            )
        ));

        $this->add(array(
            'name' => 'enunciado',
            'required' => true,
            'filters' => array(array('name' => 'StripTags'), array('name' => 'StringTrim')),
            'validators' => array(
                array(
                    'name' => 'NotEmpty',
                    'options' => array(
                        'messages' => array('isEmpty' => 'Campo obrigatório')
                    )
                )
            )
        ));

        $this->add(array(
            'name' => 'item_a',
            'required' => true,
            'filters' => array(array('name' => 'StripTags'), array('name' => 'StringTrim')),
            'validators' => array(
                array(
                    'name' => 'NotEmpty',
                    'options' => array(
                        'messages' => array('isEmpty' => 'Campo obrigatório')
                    )
                )
            )
        ));

        $this->add(array(
            'name' => 'item_b',
            'required' => true,
            'filters' => array(array('name' => 'StripTags'), array('name' => 'StringTrim')),
            'validators' => array(
                array(
                    'name' => 'NotEmpty',
                    'options' => array(
                        'messages' => array('isEmpty' => 'Campo obrigatório')
                    )
                )
            )
        ));

        $this->add(array(
            'name' => 'item_c',
            'required' => true,
            'filters' => array(array('name' => 'StripTags'), array('name' => 'StringTrim')),
            'validators' => array(
                array(
                    'name' => 'NotEmpty',
                    'options' => array(
                        'messages' => array('isEmpty' => 'Campo obrigatório')
                    )
                )
            )
        ));

        $this->add(array(
            'name' => 'item_d',
            'required' => true,
            'filters' => array(array('name' => 'StripTags'), array('name' => 'StringTrim')),
            'validators' => array(
                array(
                    'name' => 'NotEmpty',
                    'options' => array(
                        'messages' => array('isEmpty' => 'Campo obrigatório')
                    )
                )
            )
        ));

        $this->add(array(
            'name' => 'item_e',
            'required' => true,
            'filters' => array(array('name' => 'StripTags'), array('name' => 'StringTrim')),
            'validators' => array(
                array(
                    'name' => 'NotEmpty',
                    'options' => array(
                        'messages' => array('isEmpty' => 'Campo obrigatório')
                    )
                )
            )
        ));

        $this->add(array(
            'name' => 'gabarito',
            'required' => true,
            'filters' => array(array('name' => 'StripTags'), array('name' => 'StringTrim')),
            'validators' => array(
                array(
                    'name' => 'NotEmpty',
                    'options' => array(
                        'messages' => array('isEmpty' => 'Campo obrigatório')
                    )
                )
            )
        ));

        $this->add(array('name' => 'item', 'required' => false));
        $this->add(array('name' => 'imagens', 'required' => false));
    }
}

<?php

namespace ISConfiguracao\Form;

use Zend\InputFilter\InputFilter;

class UnidadeFilter extends InputFilter {

    public function __construct($pessoa) {
        $this->addElements($pessoa);
    }

    private function addElements($pessoa) {
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
            'name' => 'cep',
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
            'name' => 'estado',
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
            'name' => 'cidade',
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
            'name' => 'bairro',
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
            'name' => 'logradouro',
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
            'name' => 'numero',
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

        $this->add(array(
            'name' => 'fone_comercial',
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
            'name' => 'royalties_produtos',
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
            'name' => 'royalties_servicos',
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
            'name' => 'segunda_sexta_abertura',
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
            'name' => 'segunda_sexta_fechamento',
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
            'name' => 'sabado_abertura',
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
            'name' => 'sabado_fechamento',
            'required' => true,
            'filters' => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array('name' => 'NotEmpty', 'options' => array('messages' => array('isEmpty' => 'Campo obrigatório')))
            )
        ));

        if ($pessoa == "PJ") {
            $this->add(array(
                'name' => 'razao_social',
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
                'name' => 'nome_responsavel',
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
                'name' => 'cpf_responsavel',
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
                'name' => 'fone_responsavel',
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
                'name' => 'email_responsavel',
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
                'name' => 'simples_nacional',
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
                'name' => 'cnpj',
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array('name' => 'NotEmpty', 'options' => array('messages' => array('isEmpty' => 'Campo obrigatório')))
                )
            ));
        } else {
            $this->add(array(
                'name' => 'cpf',
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array('name' => 'NotEmpty', 'options' => array('messages' => array('isEmpty' => 'Campo obrigatório')))
                )
            ));
        
            $this->add(array('name' => 'simples_nacional', 'required' => false));
        }
    }

}

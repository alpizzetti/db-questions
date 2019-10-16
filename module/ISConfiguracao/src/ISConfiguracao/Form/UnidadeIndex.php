<?php

namespace ISConfiguracao\Form;

use Zend\Form\Element\Select;
use Zend\Form\Element\Text;
use Zend\Form\Form;

class UnidadeIndex extends Form {

    public function __construct($estados) {
        parent::__construct("form_unidade_index");
        $this->addElements($estados);
    }

    private function addElements($estados) {
        $this->setAttribute('method', 'get');

        $this->add((new Select())
                        ->setLabel('Status:')
                        ->setAttribute('class', 'form-control')
                        ->setName('status')
                        ->setOptions(array('label_attributes' => array('class' => 'control-label'), 'value_options' => array(1 => 'Ativo', 0 => 'Inativo'))));

        $this->add((new Select())
                        ->setLabel('Estado:')
                        ->setAttribute('class', 'form-control')
                        ->setName('estado')
                        ->setOptions(array('label_attributes' => array('class' => 'control-label'), 'disable_inarray_validator' => true, 'empty_option' => 'Selecione', 'value_options' => $estados)));
        
        $this->add((new Text('filtro'))
                        ->setLabel('Refinar Pesquisa:')
                        ->setAttributes(['maxLength' => 100, 'class' => 'form-control', 'placeholder' => 'Pesquise por: nome, e-mail ou telefone'])
                        ->setOptions(array('label_attributes' => array('class' => 'control-label'))));
    }

}

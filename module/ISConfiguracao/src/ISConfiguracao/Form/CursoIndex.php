<?php

namespace ISConfiguracao\Form;

use Zend\Form\Element\Select;
use Zend\Form\Element\Text;
use Zend\Form\Form;

class CursoIndex extends Form {

    public function __construct($unidades) {
        parent::__construct();
        $this->addElements($unidades);
    }

    private function addElements($unidades) {
        $this->setAttribute('method', 'get');

        $this->add((new Select())
                        ->setLabel('*Status:')
                        ->setAttribute('class', 'form-control')
                        ->setName('status')
                        ->setOptions(array('label_attributes' => array('class' => 'control-label'), 'value_options' => array(1 => 'Ativo', 0 => 'Inativo'))));

        $this->add((new Text('nome'))
                        ->setLabel('Nome:')
                        ->setAttributes(['maxLength' => 100, 'class' => 'form-control'])
                        ->setOptions(array('label_attributes' => array('class' => 'control-label'))));

        $this->add((new Select())
                        ->setLabel('Tipo:')
                        ->setAttributes(array('class' => 'form-control'))
                        ->setName('tipo')
                        ->setOptions(array('label_attributes' => array('class' => 'control-label'), 'disable_inarray_validator' => true, 'empty_option' => 'Selecione', 'value_options' => \ISBase\Util\Arrays::cursosTipos())));

        $this->add((new Select())
                        ->setLabel('Unidade:')
                        ->setAttributes(array('class' => 'form-control'))
                        ->setName('unidade')
                        ->setOptions(array('label_attributes' => array('class' => 'control-label'), 'disable_inarray_validator' => true, 'empty_option' => 'Selecione', 'value_options' => $unidades)));
    }

}

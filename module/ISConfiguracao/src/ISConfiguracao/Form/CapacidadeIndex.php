<?php

namespace ISConfiguracao\Form;

use Zend\Form\Element\Select;
use Zend\Form\Element\Text;
use Zend\Form\Form;

class CapacidadeIndex extends Form
{
    public function __construct($unidadesCurriculares)
    {
        parent::__construct();
        $this->addElements($unidadesCurriculares);
    }

    private function addElements($unidadesCurriculares)
    {
        $this->setAttribute('method', 'get');

        $this->add(
            (new Select())
                ->setLabel('*Status:')
                ->setAttribute('class', 'form-control')
                ->setName('status')
                ->setOptions(array('label_attributes' => array('class' => 'control-label'), 'value_options' => array(1 => 'Ativo', 0 => 'Inativo')))
        );

        $this->add(
            (new Text('numero'))
                ->setLabel('Código da Capacidade:')
                ->setAttributes(['maxLength' => 100, 'class' => 'form-control'])
                ->setOptions(array('label_attributes' => array('class' => 'control-label')))
        );

        $this->add(
            (new Select())
                ->setLabel('Unidade Curricular:')
                ->setAttributes(array('class' => 'form-control'))
                ->setName('unidadeCurricular')
                ->setOptions(array(
                    'label_attributes' => array('class' => 'control-label'),
                    'disable_inarray_validator' => true,
                    'empty_option' => 'Selecione',
                    'value_options' => $unidadesCurriculares
                ))
        );
    }
}

<?php

namespace ISConfiguracao\Form;

use Zend\Form\Element\Select;
use Zend\Form\Form;

class PrivelegioIndex extends Form
{
    public function __construct($name = null, array $grupos = null, array $fucionalidades = null)
    {
        parent::__construct($name);
        $this->addElements($grupos, $fucionalidades);
    }

    private function addElements($grupos, $fucionalidades)
    {
        $this->setAttribute('method', 'get');
        $this->add(
            (new Select())
                ->setLabel('Grupo:')
                ->setAttribute('class', 'form-control')
                ->setName('grupo')
                ->setOptions(array(
                    'label_attributes' => array('class' => 'control-label'),
                    'disable_inarray_validator' => true,
                    'empty_option' => 'Selecione',
                    'value_options' => $grupos
                ))
        );

        $this->add(
            (new Select())
                ->setLabel('Funcionalidade:')
                ->setAttribute('class', 'form-control')
                ->setName('funcionalidade')
                ->setOptions(array(
                    'label_attributes' => array('class' => 'control-label'),
                    'disable_inarray_validator' => true,
                    'empty_option' => 'Selecione',
                    'value_options' => $fucionalidades
                ))
        );
    }
}

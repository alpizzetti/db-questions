<?php

namespace ISConfiguracao\Form;

use Zend\Form\Element\Select;
use Zend\Form\Element\Text;
use Zend\Form\Form;

class GrupoIndex extends Form
{
    public function __construct($name = null)
    {
        parent::__construct($name);
        $this->addElements();
    }

    private function addElements()
    {
        $this->setAttribute('method', 'get');

        $this->add(
            (new Select())
                ->setLabel('Status:')
                ->setAttribute('class', 'form-control')
                ->setName('status')
                ->setOptions(array('label_attributes' => array('class' => 'control-label'), 'value_options' => array(1 => 'Ativo', 0 => 'Inativo')))
        );

        $this->add(
            (new Text('nome'))
                ->setLabel('Nome:')
                ->setAttributes(array('maxLength' => 100, 'class' => 'form-control'))
                ->setOptions(array('label_attributes' => array('class' => 'control-label')))
        );
    }
}

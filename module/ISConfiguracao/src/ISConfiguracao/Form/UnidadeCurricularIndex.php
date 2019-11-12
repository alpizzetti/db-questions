<?php

namespace ISConfiguracao\Form;

use Zend\Form\Element\Select;
use Zend\Form\Element\Text;
use Zend\Form\Form;

class UnidadeCurricularIndex extends Form
{

    public function __construct($cursos)
    {
        parent::__construct();
        $this->addElements($cursos);
    }

    private function addElements($cursos)
    {
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
            ->setLabel('Curso:')
            ->setAttributes(array('class' => 'form-control'))
            ->setName('curso')
            ->setOptions(array('label_attributes' => array('class' => 'control-label'), 'disable_inarray_validator' => true, 'empty_option' => 'Selecione', 'value_options' => $cursos)));
    }
}

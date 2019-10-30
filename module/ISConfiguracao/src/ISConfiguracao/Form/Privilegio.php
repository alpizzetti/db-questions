<?php

namespace ISConfiguracao\Form;

use Zend\Form\Element\Csrf;
use Zend\Form\Element\Hidden;
use Zend\Form\Element\Select;
use Zend\Form\Form;

class Privilegio extends Form
{

    public function __construct($name = null, array $grupos = null, array $funcionalidades = null)
    {
        parent::__construct($name);
        $this->addElements($grupos, $funcionalidades);
    }

    private function addElements($grupos, $funcionalidades)
    {
        $this->setInputFilter(new PrivilegioFilter())
            ->setAttributes(['method' => 'post', 'class' => 'horizontal-form']);

        $this->add((new Hidden('id')));

        $this->add((new Csrf('security')));

        $this->add((new Select())
            ->setLabel('*Permissão Ler:')
            ->setAttribute('class', 'form-control')
            ->setName('ler')
            ->setOptions(array('label_attributes' => array('class' => 'control-label'), 'disable_inarray_validator' => true, 'empty_option' => 'Selecione', 'value_options' => array(1 => 'Sim', 0 => 'Não'))));

        $this->add((new Select())
            ->setLabel('*Permissão Escrever:')
            ->setAttribute('class', 'form-control')
            ->setName('escrever')
            ->setOptions(array('label_attributes' => array('class' => 'control-label'), 'disable_inarray_validator' => true, 'empty_option' => 'Selecione', 'value_options' => array(1 => 'Sim', 0 => 'Não'))));

        $this->add((new Select())
            ->setLabel('*Grupo:')
            ->setAttribute('class', 'form-control')
            ->setName('grupo')
            ->setOptions(array('label_attributes' => array('class' => 'control-label'), 'disable_inarray_validator' => true, 'empty_option' => 'Selecione', 'value_options' => $grupos)));

        $this->add((new Select())
            ->setLabel('*Funcionalidade:')
            ->setAttribute('class', 'form-control')
            ->setName('funcionalidade')
            ->setOptions(array('label_attributes' => array('class' => 'control-label'), 'disable_inarray_validator' => true, 'empty_option' => 'Selecione', 'value_options' => $funcionalidades)));
    }
}

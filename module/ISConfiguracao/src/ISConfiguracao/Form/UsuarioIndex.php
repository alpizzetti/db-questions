<?php

namespace ISConfiguracao\Form;

use Zend\Form\Element\Select;
use Zend\Form\Element\Text;
use Zend\Form\Form;

class UsuarioIndex extends Form
{

    public function __construct($name = null, array $grupos = null, array $unidades = null)
    {
        parent::__construct($name);
        $this->addElements($grupos, $unidades);
    }

    private function addElements($grupos, $unidades)
    {
        $this->setAttribute('method', 'get');

        $this->add((new Select())
            ->setLabel('Status:')
            ->setAttribute('class', 'form-control')
            ->setName('status')
            ->setOptions(array('label_attributes' => array('class' => 'control-label'), 'value_options' => array(1 => 'Ativo', 0 => 'Inativo'))));

        $this->add((new Select())
            ->setLabel('Grupo:')
            ->setAttribute('class', 'form-control')
            ->setName('grupo')
            ->setOptions(array('label_attributes' => array('class' => 'control-label'), 'empty_option' => 'Selecione', 'value_options' => $grupos)));

        $this->add((new Select())
            ->setLabel('Unidade:')
            ->setAttribute('class', 'form-control')
            ->setName('unidade')
            ->setOptions(array('label_attributes' => array('class' => 'control-label'), 'empty_option' => 'Selecione', 'value_options' => $unidades)));

        $this->add((new Text('filtro'))
            ->setLabel('Refinar Pesquisa:')
            ->setAttributes(['maxLength' => 100, 'placeholder' => 'Nome, e-mail ou login', 'class' => 'form-control'])
            ->setOptions(array('label_attributes' => array('class' => 'control-label'))));
    }
}

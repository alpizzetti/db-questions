<?php

namespace ISConfiguracao\Form;

use Zend\Form\Element\Csrf;
use Zend\Form\Element\Hidden;
use Zend\Form\Element\Password;
use Zend\Form\Element\Select;
use Zend\Form\Element\Text;
use Zend\Form\Form;

class UsuarioDados extends Form {

    public function __construct($name, $grupos, $unidades) {
        parent::__construct($name);
        $this->addElements($grupos, $unidades);
    }

    private function addElements($grupos, $unidades) {
        $this->setAttributes(['method' => 'post', 'class' => 'horizontal-form'])
                ->setInputFilter(new UsuarioDadosFilter());

        $this->add((new Hidden('id')));

        $this->add((new Csrf('security')));

        $this->add((new Select())
                        ->setLabel('*Status:')
                        ->setAttribute('class', 'form-control')
                        ->setName('status')
                        ->setOptions(array('label_attributes' => array('class' => 'control-label'), 'value_options' => array(1 => 'Ativo', 0 => 'Inativo'))));

        $this->add((new Select())
                        ->setLabel('*Unidade:')
                        ->setAttributes(array('id' => 'unidade', 'class' => 'form-control'))
                        ->setName('unidade')
                        ->setOptions(array('label_attributes' => array('class' => 'control-label'), 'disable_inarray_validator' => true, 'empty_option' => 'Selecione', 'value_options' => $unidades)));

        $this->add((new Select())
                        ->setLabel('*Grupo:')
                        ->setAttributes(['class' => 'form-control'])
                        ->setName('grupo')
                        ->setOptions(array('label_attributes' => array('class' => 'control-label'), 'empty_option' => 'Selecione', 'disable_inarray_validator' => true, 'value_options' => $grupos)));

        $this->add((new Select())
                        ->setLabel('*Sexo:')
                        ->setAttribute('class', 'form-control')
                        ->setName('sexo')
                        ->setOptions(array('label_attributes' => array('class' => 'control-label'), 'empty_option' => 'Selecione', 'disable_inarray_validator' => true, 'value_options' => array('M' => 'Masculino', 'F' => 'Feminino'))));

        $this->add((new Text('nome'))
                        ->setLabel('*Nome:')
                        ->setAttributes(array('maxLength' => 100, 'class' => 'form-control'))
                        ->setOptions(array('label_attributes' => array('class' => 'control-label'))));

        $this->add((new Text('email'))
                        ->setLabel('*E-mail (login):')
                        ->setAttributes(array('maxLength' => 100, 'class' => 'form-control'))
                        ->setOptions(array('label_attributes' => array('class' => 'control-label'))));

        $this->add((new Password('senha'))
                        ->setLabel('*Senha:')
                        ->setAttribute('class', 'form-control')
                        ->setOptions(array('label_attributes' => array('class' => 'control-label'))));

        $this->add((new Password('confirmacao'))
                        ->setLabel('*Redigite:')
                        ->setAttribute('class', 'form-control')
                        ->setOptions(array('label_attributes' => array('class' => 'control-label'))));
    }

}

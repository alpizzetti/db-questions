<?php

namespace ISConfiguracao\Form;

use Zend\Form\Element\Csrf;
use Zend\Form\Element\Hidden;
use Zend\Form\Element\Select;
use Zend\Form\Element\Text;
use Zend\Form\Form;

class Grupo extends Form {

    public function __construct() {
        parent::__construct();
        $this->addElements();
    }

    private function addElements() {
        $this->setAttribute('method', 'post');
        $this->setInputFilter(new GrupoFilter());

        $this->add((new Hidden('id'))->setAttribute("id", "id"));

        $this->add((new Csrf('security')));

        $this->add((new Select())
                        ->setLabel('*Status:')
                        ->setAttributes(array('class' => 'form-control'))
                        ->setName('status')
                        ->setOptions(array('label_attributes' => array('class' => 'control-label'), 'value_options' => array(1 => 'Ativo', 0 => 'Inativo'))));

        $this->add((new Text('nome'))
                        ->setLabel('*Nome:')
                        ->setAttributes(array('maxLength' => 100, 'class' => 'form-control'))
                        ->setOptions(array('label_attributes' => array('class' => 'control-label', 'id' => 'label-nome'))));

        $this->add((new Select())
                        ->setLabel('*Administardor:')
                        ->setAttributes(array('class' => 'form-control'))
                        ->setName('administrador')
                        ->setOptions(array('label_attributes' => array('class' => 'control-label'), 'disable_inarray_validator' => true, 'empty_option' => 'Selecione', 'value_options' => array(1 => 'Sim', 0 => 'Não'))));
         
        $this->add((new Select())
                        ->setLabel('*Professor:')
                        ->setAttributes(array('class' => 'form-control'))
                        ->setName('professor')
                        ->setOptions(array('label_attributes' => array('class' => 'control-label'), 'disable_inarray_validator' => true, 'empty_option' => 'Selecione', 'value_options' => array(1 => 'Sim', 0 => 'Não'))));
         
        $this->add((new Select())
                        ->setLabel('*Moderador:')
                        ->setAttributes(array('class' => 'form-control'))
                        ->setName('moderador')
                        ->setOptions(array('label_attributes' => array('class' => 'control-label'), 'disable_inarray_validator' => true, 'empty_option' => 'Selecione', 'value_options' => array(1 => 'Sim', 0 => 'Não'))));
    }

}

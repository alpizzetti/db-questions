<?php

namespace ISConfiguracao\Form;

use Zend\Form\Element\Hidden;
use Zend\Form\Element\Password;
use Zend\Form\Form;

class AutenticacaoSenhaConfirmar extends Form
{
    public function __construct($name = null)
    {
        parent::__construct($name);
        $this->addElements();
    }
    private function addElements()
    {
        $this->setAttributes(['method' => 'post', 'class' => 'forget-form', 'id' => 'form-confirmar']);

        $this->add((new Hidden('token'))->setAttribute('id', 'token'));

        $this->add(
            (new Password('senha'))
                ->setAttributes(['placeholder' => 'Nova senha', 'maxLength' => 100, 'class' => 'form-control', 'id' => 'senha'])
                ->setOptions(array('label_attributes' => array('class' => 'control-label')))
        );

        $this->add(
            (new Password('senha_repete'))
                ->setAttributes(['placeholder' => 'Confirmação da nova senha', 'maxLength' => 100, 'class' => 'form-control', 'id' => 'senha_repete'])
                ->setOptions(array('label_attributes' => array('class' => 'control-label')))
        );
    }
}

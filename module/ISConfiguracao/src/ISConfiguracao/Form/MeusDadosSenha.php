<?php

namespace ISConfiguracao\Form;

use Zend\Form\Element\Csrf;
use Zend\Form\Element\Hidden;
use Zend\Form\Element\Password;
use Zend\Form\Form;

class MeusDadosSenha extends Form
{

    public function __construct($name = null)
    {
        parent::__construct($name);
        $this->addElements();
    }

    private function addElements()
    {
        $this->setInputFilter(new MeusDadosSenhaFilter());
        $this->setAttribute('method', 'post');

        $this->add((new Hidden('id')));

        $this->add((new Password('senha_atual'))
            ->setLabel('*Senha Atual:')
            ->setAttributes(['class' => 'form-control'])
            ->setOptions(array('label_attributes' => array('class' => 'control-label'))));

        $this->add((new Password('senha'))
            ->setLabel('*Nova Senha:')
            ->setAttributes(['class' => 'form-control'])
            ->setOptions(array('label_attributes' => array('class' => 'control-label'))));

        $this->add((new Password('senha_repete'))
            ->setLabel('*Redigite a nova senha:')
            ->setAttributes(['class' => 'form-control'])
            ->setOptions(array('label_attributes' => array('class' => 'control-label'))));

        $this->add((new Csrf('security')));
    }
}

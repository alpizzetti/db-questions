<?php

namespace ISConfiguracao\Form;

use Zend\Form\Element\Password;
use Zend\Form\Element\Text;
use Zend\Form\Form;

class AutenticacaoEntrar extends Form
{
    public function __construct($name = null, $options = array())
    {
        parent::__construct($name, $options);
        $this->addElements();
    }

    private function addElements()
    {
        $this->setAttributes(['method' => 'post', 'class' => 'login-form', 'id' => 'form-login']);

        $this->add(
            (new Text('email'))->setAttributes([
                'placeholder' => 'E-mail',
                'id' => 'email',
                'maxLength' => 100,
                'class' => 'form-control form-control-solid placeholder-no-fix form-group'
            ])
        );

        $this->add(
            (new Password('senha'))->setAttributes([
                'placeholder' => 'Senha',
                'id' => 'senha',
                'maxLength' => 100,
                'class' => 'form-control form-control-solid placeholder-no-fix form-group'
            ])
        );
    }
}

<?php

namespace ISConfiguracao\Form;

use Zend\Form\Element\Text;
use Zend\Form\Form;

class AutenticacaoSenhaRedefinir extends Form
{
    public function __construct($name = null, $options = array())
    {
        parent::__construct($name, $options);
        $this->addElements();
    }
    private function addElements()
    {
        $this->setAttributes(['method' => 'post', 'class' => 'forget-form', 'id' => 'form-redefinir']);

        $this->add(
            (new Text('email'))->setAttributes([
                'placeholder' => 'E-mail',
                'maxLength' => 100,
                'class' => 'form-control placeholder-no-fix',
                'id' => 'email'
            ])
        );
    }
}

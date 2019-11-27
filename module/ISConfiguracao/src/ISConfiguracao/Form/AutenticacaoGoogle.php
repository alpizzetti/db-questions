<?php

namespace ISConfiguracao\Form;

use Zend\Form\Element\Text;
use Zend\Form\Form;

class AutenticacaoGoogle extends Form
{
    public function __construct($name = null, $options = array())
    {
        parent::__construct($name, $options);
        $this->addElements();
    }

    private function addElements()
    {
        $this->setAttributes(['method' => 'post', 'class' => 'login-form', 'id' => 'form-google-authenticator']);

        $this->add(
            (new Text('codigo'))->setAttributes([
                'placeholder' => 'Código de verificação',
                'id' => 'codigo',
                'maxLength' => 100,
                'class' => 'form-control form-control-solid placeholder-no-fix form-group googleauthenticator'
            ])
        );
    }
}

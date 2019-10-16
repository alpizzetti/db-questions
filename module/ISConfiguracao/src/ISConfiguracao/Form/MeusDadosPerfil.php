<?php

namespace ISConfiguracao\Form;

use Zend\Form\Element\Csrf;
use Zend\Form\Element\Hidden;
use Zend\Form\Element\Text;
use Zend\Form\Form;

class MeusDadosPerfil extends Form {

    public function __construct($name = null) {
        parent::__construct($name);
        $this->addElements();
    }

    private function addElements() {
        $this->setInputFilter(new MeusDadosPerfilFilter())->setAttribute('method', 'post');

        $this->add((new Hidden('id')));

        $this->add((new Csrf('security')));

        $this->add((new Text('nome'))
                        ->setLabel('*Nome:')
                        ->setAttributes(['maxLength' => 100, 'class' => 'form-control'])
                        ->setOptions(array('label_attributes' => array('class' => 'control-label'))));

        $this->add((new Text('email'))
                        ->setLabel('*E-mail:')
                        ->setAttributes(['readonly' => true, 'maxLength' => 100, 'class' => 'form-control'])
                        ->setOptions(array('label_attributes' => array('class' => 'control-label'))));
    }

}

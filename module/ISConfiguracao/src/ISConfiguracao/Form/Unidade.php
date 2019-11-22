<?php

namespace ISConfiguracao\Form;

use Zend\Form\Element\Csrf;
use Zend\Form\Element\Hidden;
use Zend\Form\Element\Select;
use Zend\Form\Element\Text;
use Zend\Form\Form;

class Unidade extends Form
{
    public function __construct()
    {
        parent::__construct("form_unidade");
        $this->addElements();
    }

    private function addElements()
    {
        $this->setAttribute('method', 'post');
        $this->setInputFilter(new UnidadeFilter());

        $this->add((new Hidden('id'))->setAttribute("id", "id"));

        $this->add(new Csrf('security'));

        $this->add(
            (new Select())
                ->setLabel('*Status:')
                ->setAttributes(array('class' => 'form-control', 'id' => 'status'))
                ->setName('status')
                ->setOptions(array('label_attributes' => array('class' => 'control-label'), 'value_options' => array(1 => 'Ativo', 0 => 'Inativo')))
        );

        $this->add(
            (new Text('nome'))
                ->setLabel('*Nome:')
                ->setAttributes(array('maxLength' => 100, 'class' => 'form-control', 'id' => 'nome'))
                ->setOptions(array('label_attributes' => array('class' => 'control-label', 'id' => 'label-nome')))
        );

        $this->add(
            (new Text('email'))
                ->setLabel('*E-mail:')
                ->setAttributes(array('maxLength' => 100, 'class' => 'form-control', 'id' => 'email'))
                ->setOptions(array('label_attributes' => array('class' => 'control-label')))
        );

        $this->add(
            (new Text('telefone'))
                ->setLabel('*Telefone:')
                ->setAttributes(array('maxLength' => 100, 'class' => 'form-control telefone', 'id' => 'telefone'))
                ->setOptions(array('label_attributes' => array('class' => 'control-label')))
        );
    }
}

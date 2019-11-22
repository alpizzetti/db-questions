<?php

namespace ISConfiguracao\Form;

use Zend\Form\Element\Csrf;
use Zend\Form\Element\Hidden;
use Zend\Form\Element\Select;
use Zend\Form\Element\Text;
use Zend\Form\Form;

class Curso extends Form
{
    public function __construct($unidades)
    {
        parent::__construct();
        $this->addElements($unidades);
    }
    private function addElements($unidades)
    {
        $this->setAttribute('method', 'post');
        $this->setInputFilter(new CursoFilter());

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
                ->setAttributes(array('maxLength' => 100, 'class' => 'form-control'))
                ->setOptions(array('label_attributes' => array('class' => 'control-label', 'id' => 'label-nome')))
        );

        $this->add(
            (new Select())
                ->setLabel('*Tipo:')
                ->setAttributes(array('class' => 'form-control'))
                ->setName('tipo')
                ->setOptions(array(
                    'label_attributes' => array('class' => 'control-label'),
                    'disable_inarray_validator' => true,
                    'empty_option' => 'Selecione',
                    'value_options' => \ISBase\Util\Arrays::cursosTipos()
                ))
        );

        $this->add(
            (new Select())
                ->setLabel('*Unidade:')
                ->setAttributes(array('class' => 'form-control'))
                ->setName('unidade')
                ->setOptions(array(
                    'label_attributes' => array('class' => 'control-label'),
                    'disable_inarray_validator' => true,
                    'empty_option' => 'Selecione',
                    'value_options' => $unidades
                ))
        );
    }
}

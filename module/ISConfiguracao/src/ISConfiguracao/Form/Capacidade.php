<?php

namespace ISConfiguracao\Form;

use Zend\Form\Element\Csrf;
use Zend\Form\Element\Hidden;
use Zend\Form\Element\Select;
use Zend\Form\Element\Text;
use Zend\Form\Form;

class Capacidade extends Form
{
    public function __construct($unidadesCurriculares)
    {
        parent::__construct();
        $this->addElements($unidadesCurriculares);
    }

    private function addElements($unidadesCurriculares)
    {
        $this->setAttribute('method', 'post');
        $this->setInputFilter(new CapacidadeFilter());

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
            (new Text('numero'))
                ->setLabel('*Código da Capacidade:')
                ->setAttributes(array('maxLength' => 3, 'class' => 'form-control'))
                ->setOptions(array('label_attributes' => array('class' => 'control-label', 'id' => 'label-numero')))
        );

        $this->add(
            (new Select())
                ->setLabel('*Unidade Curricular:')
                ->setAttributes(array('class' => 'form-control'))
                ->setName('unidadeCurricular')
                ->setOptions(array(
                    'label_attributes' => array('class' => 'control-label'),
                    'disable_inarray_validator' => true,
                    'empty_option' => 'Selecione',
                    'value_options' => $unidadesCurriculares
                ))
        );

        $this->add(
            (new Text('descricao'))
                ->setLabel('*Descrição da Capacidade:')
                ->setAttributes(array('maxLength' => 100, 'class' => 'form-control'))
                ->setOptions(array('label_attributes' => array('class' => 'control-label', 'id' => 'label-descricao')))
        );
    }
}

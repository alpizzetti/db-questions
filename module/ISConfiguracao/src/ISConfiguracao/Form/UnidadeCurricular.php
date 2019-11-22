<?php

namespace ISConfiguracao\Form;

use Zend\Form\Element\Csrf;
use Zend\Form\Element\Hidden;
use Zend\Form\Element\Select;
use Zend\Form\Element\Text;
use Zend\Form\Form;

class UnidadeCurricular extends Form
{
    public function __construct($cursos)
    {
        parent::__construct();
        $this->addElements($cursos);
    }

    private function addElements($cursos)
    {
        $this->setAttribute('method', 'post');
        $this->setInputFilter(new UnidadeCurricularFilter());

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
                ->setLabel('*Curso:')
                ->setAttributes(array('class' => 'form-control'))
                ->setName('curso')
                ->setOptions(array(
                    'label_attributes' => array('class' => 'control-label'),
                    'disable_inarray_validator' => true,
                    'empty_option' => 'Selecione',
                    'value_options' => $cursos
                ))
        );
    }
}

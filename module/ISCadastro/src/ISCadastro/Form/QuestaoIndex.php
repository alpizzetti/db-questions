<?php

namespace ISCadastro\Form;

use Zend\Form\Element\Select;
use Zend\Form\Element\Text;
use Zend\Form\Form;

class QuestaoIndex extends Form
{
    public function __construct($unidadesCurriculares)
    {
        parent::__construct();
        $this->addElements($unidadesCurriculares);
    }

    private function addElements($unidadesCurriculares)
    {
        $this->setAttribute('method', 'get');

        $this->add(
            (new Select())
                ->setLabel('*Status:')
                ->setAttribute('class', 'form-control')
                ->setName('status')
                ->setOptions(array(
                    'label_attributes' => array('class' => 'control-label'),
                    'value_options' => array(1 => 'Ativa', 0 => 'Pendente')
                ))
        );

        $this->add(
            (new Text('filtro'))
                ->setLabel('Refinar Pesquisa:')
                ->setAttributes([
                    'maxLength' => 100,
                    'class' => 'form-control',
                    'placeholder' => 'Pesquise por: enunciado, suporte ou comando'
                ])
                ->setOptions(array(
                    'label_attributes' => array('class' => 'control-label')
                ))
        );

        $this->add(
            (new Select())
                ->setLabel('Dificuldade:')
                ->setAttributes(array('class' => 'form-control'))
                ->setName('dificuldade')
                ->setOptions(array(
                    'label_attributes' => array('class' => 'control-label'),
                    'disable_inarray_validator' => true,
                    'empty_option' => 'Selecione',
                    'value_options' => \ISBase\Util\Arrays::questoesDificuldades()
                ))
        );

        $this->add(
            (new Select())
                ->setLabel('Unidade Curricular:')
                ->setAttributes(array('class' => 'form-control'))
                ->setName('unidade_curricular')
                ->setOptions(array(
                    'label_attributes' => array('class' => 'control-label'),
                    'disable_inarray_validator' => true,
                    'empty_option' => 'Selecione',
                    'value_options' => $unidadesCurriculares
                ))
        );
    }
}

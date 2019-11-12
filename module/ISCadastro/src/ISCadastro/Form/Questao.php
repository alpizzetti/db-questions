<?php

namespace ISCadastro\Form;

use Zend\Form\Element\Csrf;
use Zend\Form\Element\Hidden;
use Zend\Form\Element\Select;
use Zend\Form\Element\Textarea;
use Zend\Form\Form;

class Questao extends Form
{

    public function __construct($unidadesCurriculares)
    {
        parent::__construct();
        $this->addElements($unidadesCurriculares);
    }

    private function addElements($unidadesCurriculares)
    {
        $this->setAttribute('method', 'post');
        $this->setInputFilter(new QuestaoFilter());

        $this->add((new Hidden('id'))->setAttribute("id", "id"));

        $this->add((new Csrf('security')));

        $this->add((new Select())
            ->setLabel('*Status:')
            ->setAttributes(array('class' => 'form-control', 'id' => 'status'))
            ->setName('status')
            ->setOptions(array('label_attributes' => array('class' => 'control-label'), 'value_options' => array(1 => 'Ativo', 0 => 'Inativo'))));

        $this->add((new Select())
            ->setLabel('*Unidade Curricular:')
            ->setAttributes(array('class' => 'form-control'))
            ->setName('unidade_curricular')
            ->setOptions(array('label_attributes' => array('class' => 'control-label'), 'disable_inarray_validator' => true, 'empty_option' => 'Selecione', 'value_options' => $unidadesCurriculares)));

        $this->add((new Select())
            ->setLabel('*Dificuldade:')
            ->setAttributes(array('class' => 'form-control'))
            ->setName('dificuldade')
            ->setOptions(array('label_attributes' => array('class' => 'control-label'), 'disable_inarray_validator' => true, 'empty_option' => 'Selecione', 'value_options' => \ISBase\Util\Arrays::questoesDificuldades())));

        $this->add((new Textarea('enunciado'))
            ->setLabel('*Enunciado:')
            ->setAttributes(['class' => 'form-control', 'rows' => 2])
            ->setOptions(['label_attributes' => ['class' => 'control-label']]));

        $this->add((new Textarea('suporte'))
            ->setLabel('Suporte:')
            ->setAttributes(['class' => 'form-control', 'rows' => 2])
            ->setOptions(['label_attributes' => ['class' => 'control-label']]));

        $this->add((new Textarea('comando'))
            ->setLabel('Comando:')
            ->setAttributes(['class' => 'form-control', 'rows' => 2])
            ->setOptions(['label_attributes' => ['class' => 'control-label']]));

        $this->add((new Textarea('item_a'))
            ->setLabel('*Resposta A:')
            ->setAttributes(['class' => 'form-control', 'rows' => 1])
            ->setOptions(['label_attributes' => ['class' => 'control-label']]));

        $this->add((new Textarea('item_b'))
            ->setLabel('*Resposta B:')
            ->setAttributes(['class' => 'form-control', 'rows' => 1])
            ->setOptions(['label_attributes' => ['class' => 'control-label']]));

        $this->add((new Textarea('item_c'))
            ->setLabel('*Resposta C:')
            ->setAttributes(['class' => 'form-control', 'rows' => 1])
            ->setOptions(['label_attributes' => ['class' => 'control-label']]));

        $this->add((new Textarea('item_d'))
            ->setLabel('*Resposta D:')
            ->setAttributes(['class' => 'form-control', 'rows' => 1])
            ->setOptions(['label_attributes' => ['class' => 'control-label']]));

        $this->add((new Textarea('item_e'))
            ->setLabel('*Resposta E:')
            ->setAttributes(['class' => 'form-control', 'rows' => 1])
            ->setOptions(['label_attributes' => ['class' => 'control-label']]));

        $this->add((new Select())
            ->setLabel('*Gabarito:')
            ->setAttributes(array('class' => 'form-control'))
            ->setName('gabarito')
            ->setOptions(array('label_attributes' => array('class' => 'control-label'), 'disable_inarray_validator' => true, 'empty_option' => 'Selecione', 'value_options' => array("A" => "A", "B" => "B", "C" => "C", "D" => "D", "E" => "E"))));
    }
}

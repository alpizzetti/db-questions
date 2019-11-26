<?php

namespace ISCadastro\Form;

use Zend\Form\Element\Csrf;
use Zend\Form\Element\Hidden;
use Zend\Form\Element\Select;
use Zend\Form\Element\Textarea;
use Zend\Form\Element\File;
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
        $this->setInputFilter(new QuestaoFilter())->setAttributes([
            'id' => 'form_questoes',
            'method' => 'post',
            'class' => 'horizontal-form',
            'enctype' => 'multipart/form-data'
        ]);

        $this->add((new Hidden('id'))->setAttribute("id", "id"));

        $this->add(new Csrf('security'));

        $this->add(
            (new Select())
                ->setLabel('*Status:')
                ->setAttributes(array(
                    'class' => 'form-control',
                    'id' => 'status'
                ))
                ->setName('status')
                ->setOptions(array(
                    'label_attributes' => array('class' => 'control-label'),
                    'value_options' => array(1 => 'Ativa', 0 => 'Pendente')
                ))
        );

        $this->add(
            (new Select())
                ->setLabel('*Unidade Curricular:')
                ->setAttributes(array(
                    'class' => 'form-control',
                    'onchange' => 'unidadeCurricularCarregarCapacidades();',
                    'id' => 'unidade_curricular'
                ))
                ->setName('unidade_curricular')
                ->setOptions(array(
                    'label_attributes' => array('class' => 'control-label'),
                    'disable_inarray_validator' => true,
                    'empty_option' => 'Selecione',
                    'value_options' => $unidadesCurriculares
                ))
        );

        $this->add(
            (new Select())
                ->setLabel('*Capacidade:')
                ->setAttributes(array('class' => 'form-control', 'id' => 'capacidade'))
                ->setName('capacidade')
                ->setOptions(array(
                    'label_attributes' => array('class' => 'control-label'),
                    'disable_inarray_validator' => true,
                    'empty_option' => 'Selecione',
                    'value_options' => []
                ))
        );

        $this->add(
            (new Select())
                ->setLabel('*Dificuldade:')
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
            (new Textarea('enunciado'))
                ->setLabel('*Enunciado:')
                ->setAttributes(['class' => 'form-control', 'rows' => 2])
                ->setOptions([
                    'label_attributes' => ['class' => 'control-label']
                ])
        );

        $this->add(
            (new Textarea('suporte'))
                ->setLabel('Suporte:')
                ->setAttributes(['class' => 'form-control', 'rows' => 2])
                ->setOptions([
                    'label_attributes' => ['class' => 'control-label']
                ])
        );

        $this->add(
            (new Textarea('comando'))
                ->setLabel('Comando:')
                ->setAttributes(['class' => 'form-control', 'rows' => 2])
                ->setOptions([
                    'label_attributes' => ['class' => 'control-label']
                ])
        );

        $this->add(
            (new Textarea('item_a'))
                ->setLabel('*Resposta A:')
                ->setAttributes(['class' => 'form-control', 'rows' => 1])
                ->setOptions([
                    'label_attributes' => ['class' => 'control-label']
                ])
        );

        $this->add(
            (new Textarea('item_b'))
                ->setLabel('*Resposta B:')
                ->setAttributes(['class' => 'form-control', 'rows' => 1])
                ->setOptions([
                    'label_attributes' => ['class' => 'control-label']
                ])
        );

        $this->add(
            (new Textarea('item_c'))
                ->setLabel('*Resposta C:')
                ->setAttributes(['class' => 'form-control', 'rows' => 1])
                ->setOptions([
                    'label_attributes' => ['class' => 'control-label']
                ])
        );

        $this->add(
            (new Textarea('item_d'))
                ->setLabel('*Resposta D:')
                ->setAttributes(['class' => 'form-control', 'rows' => 1])
                ->setOptions([
                    'label_attributes' => ['class' => 'control-label']
                ])
        );

        $this->add(
            (new Textarea('item_e'))
                ->setLabel('*Resposta E:')
                ->setAttributes(['class' => 'form-control', 'rows' => 1])
                ->setOptions([
                    'label_attributes' => ['class' => 'control-label']
                ])
        );

        $this->add(
            (new Select())
                ->setLabel('*Gabarito:')
                ->setAttributes(array('class' => 'form-control'))
                ->setName('gabarito')
                ->setOptions(array(
                    'label_attributes' => array('class' => 'control-label'),
                    'disable_inarray_validator' => true,
                    'empty_option' => 'Selecione',
                    'value_options' => array(
                        "A" => "A",
                        "B" => "B",
                        "C" => "C",
                        "D" => "D",
                        "E" => "E"
                    )
                ))
        );

        $this->add(
            (new Select())
                ->setLabel('*Item:')
                ->setAttributes(array(
                    'class' => 'form-control',
                    'id' => 'item'
                ))
                ->setName('item')
                ->setOptions(array(
                    'label_attributes' => array('class' => 'control-label'),
                    'disable_inarray_validator' => true,
                    'empty_option' => 'Selecione',
                    'value_options' => array(
                        "enunciado" => "Enunciado",
                        "suporte" => "Suporte",
                        "comando" => "Comando"
                    )
                ))
        );

        $this->add(
            (new File('imagens'))
                ->setLabel("*Imagens:")
                ->setAttributes([
                    'id' => 'imagens',
                    'class' => 'note-image-input form-control note-form-control note-input',
                    'multiple' => 'multiple',
                    'accept' => 'image/*'
                ])
                ->setOptions(array(
                    'label_attributes' => array('class' => 'control-label')
                ))
        );
    }
}

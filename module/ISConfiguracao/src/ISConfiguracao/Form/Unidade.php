<?php

namespace ISConfiguracao\Form;

use Zend\Form\Element\Csrf;
use Zend\Form\Element\Hidden;
use Zend\Form\Element\Select;
use Zend\Form\Element\Text;
use Zend\Form\Element\Textarea;
use Zend\Form\Form;

class Unidade extends Form {

    public function __construct($estados) {
        parent::__construct("form_unidade");
        $this->addElements($estados);
    }

    private function addElements($estados) {
        $this->setAttribute('method', 'post');

        $this->add((new Hidden('id'))->setAttribute("id", "id"));

        $this->add((new Csrf('security')));

        $this->add((new Select())
                        ->setLabel('*Status:')
                        ->setAttributes(array('class' => 'form-control', 'id' => 'status'))
                        ->setName('status')
                        ->setOptions(array('label_attributes' => array('class' => 'control-label'), 'value_options' => array(1 => 'Ativo', 0 => 'Inativo'))));

        $this->add((new Select())
                        ->setLabel('*Pessoa:')
                        ->setName('pessoa')
                        ->setAttributes(array('class' => 'form-control', 'onchange' => 'unidadesMudarPfPj();', 'id' => 'pessoa'))
                        ->setOptions(array('label_attributes' => array('class' => 'control-label'), 'value_options' => \ISBase\Util\Arrays::pessoa())));

        $this->add((new Text('nome'))
                        ->setAttributes(array('maxLength' => 100, 'class' => 'form-control', 'id' => 'nome'))
                        ->setOptions(array('label_attributes' => array('class' => 'control-label', 'id' => 'label-nome'))));

        $this->add((new Text('nome_responsavel'))
                        ->setLabel('*Nome do Responsável:')
                        ->setAttributes(array('maxLength' => 100, 'class' => 'form-control', 'id' => 'nome_responsavel'))
                        ->setOptions(array('label_attributes' => array('class' => 'control-label'))));

        $this->add((new Text('razao_social'))
                        ->setLabel('*Razão Social:')
                        ->setAttributes(array('maxLength' => 100, 'class' => 'form-control', 'id' => 'razao_social'))
                        ->setOptions(array('label_attributes' => array('class' => 'control-label'))));

        $this->add((new Select())
                        ->setLabel('*Simples Nacional:')
                        ->setAttributes(array('class' => 'form-control', 'id' => 'simples_nacional'))
                        ->setName('simples_nacional')
                        ->setOptions(array('label_attributes' => array('class' => 'control-label'), 'disable_inarray_validator' => true, 'empty_option' => 'Selecione', 'value_options' => [1 => 'Sim', 0 => 'Não'])));

        $this->add((new Text('cnpj'))
                        ->setLabel('*CNPJ:')
                        ->setAttributes(array('class' => 'form-control cnpj', 'id' => 'cnpj'))
                        ->setOptions(array('label_attributes' => array('class' => 'control-label'))));

        $this->add((new Text('cpf'))
                        ->setLabel('*CPF:')
                        ->setAttributes(array('class' => 'form-control cpf', 'id' => 'cpf'))
                        ->setOptions(array('label_attributes' => array('class' => 'control-label'))));

        $this->add((new Text('cpf_responsavel'))
                        ->setLabel('*CPF do Responsável:')
                        ->setAttributes(array('class' => 'form-control cpf', 'id' => 'cpf_responsavel'))
                        ->setOptions(array('label_attributes' => array('class' => 'control-label'))));

        $this->add((new Text('rg'))
                        ->setLabel('RG:')
                        ->setAttributes(array('maxLength' => 100, 'class' => 'form-control', 'id' => 'rg'))
                        ->setOptions(array('label_attributes' => array('class' => 'control-label'))));

        $this->add((new Text('ie'))
                        ->setLabel('Ins. Estadual:')
                        ->setAttributes(array('maxLength' => 100, 'class' => 'form-control', 'id' => 'ie'))
                        ->setOptions(array('label_attributes' => array('class' => 'control-label'))));

        $this->add((new Text('email'))
                        ->setLabel('*E-mail:')
                        ->setAttributes(array('maxLength' => 100, 'class' => 'form-control', 'id' => 'email'))
                        ->setOptions(array('label_attributes' => array('class' => 'control-label'))));

        $this->add((new Text('email_responsavel'))
                        ->setLabel('*E-mail do Responsável:')
                        ->setAttributes(array('maxLength' => 100, 'class' => 'form-control', 'id' => 'email_responsavel'))
                        ->setOptions(array('label_attributes' => array('class' => 'control-label'))));

        $this->add((new Text('email_outro'))
                        ->setLabel('E-mail Outro:')
                        ->setAttributes(array('maxLength' => 100, 'class' => 'form-control', 'id' => 'email_outro'))
                        ->setOptions(array('label_attributes' => array('class' => 'control-label'))));

        $this->add((new Text('site'))
                        ->setLabel('Site:')
                        ->setAttributes(array('maxLength' => 100, 'class' => 'form-control', 'id' => 'site'))
                        ->setOptions(array('label_attributes' => array('class' => 'control-label'))));

        $this->add((new Text('fone_comercial'))
                        ->setLabel('*Fone Comercial:')
                        ->setAttributes(array('maxLength' => 100, 'class' => 'form-control telefone', 'id' => 'fone_comercial'))
                        ->setOptions(array('label_attributes' => array('class' => 'control-label'))));

        $this->add((new Text('fone_residencial'))
                        ->setLabel('Fone Residencial:')
                        ->setAttributes(array('maxLength' => 100, 'class' => 'form-control telefone', 'id' => 'fone_residencial'))
                        ->setOptions(array('label_attributes' => array('class' => 'control-label'))));

        $this->add((new Text('fone_celular'))
                        ->setLabel('Fone Celular:')
                        ->setAttributes(array('maxLength' => 100, 'class' => 'form-control telefone', 'id' => 'fone_celular'))
                        ->setOptions(array('label_attributes' => array('class' => 'control-label'))));

        $this->add((new Text('fone_responsavel'))
                        ->setLabel('*Fone do Responsável:')
                        ->setAttributes(array('maxLength' => 100, 'class' => 'form-control telefone', 'id' => 'fone_responsavel'))
                        ->setOptions(array('label_attributes' => array('class' => 'control-label'))));

        $this->add((new Text('fone_outro'))
                        ->setLabel('Fone Outro:')
                        ->setAttributes(array('maxLength' => 100, 'class' => 'form-control telefone', 'id' => 'fone_outro'))
                        ->setOptions(array('label_attributes' => array('class' => 'control-label'))));

        $this->add((new Text('cep'))
                        ->setLabel('*CEP:')
                        ->setAttributes(array('id' => 'cep', 'class' => 'form-control cep'))
                        ->setOptions(array('label_attributes' => array('class' => 'control-label'))));

        $this->add((new Select())
                        ->setLabel('*Estado:')
                        ->setAttributes(array('id' => 'estado', 'class' => 'form-control'))
                        ->setName('estado')
                        ->setOptions(array('label_attributes' => array('class' => 'control-label'), 'disable_inarray_validator' => true, 'empty_option' => 'Selecione', 'value_options' => $estados)));

        $this->add((new Text('cidade'))
                        ->setLabel('*Cidade:')
                        ->setAttributes(array('id' => 'cidade', 'maxLength' => 100, 'class' => 'form-control'))
                        ->setOptions(array('label_attributes' => array('class' => 'control-label'))));

        $this->add((new Text('bairro'))
                        ->setLabel('*Bairro:')
                        ->setAttributes(array('id' => 'bairro', 'maxLength' => 100, 'class' => 'form-control'))
                        ->setOptions(array('label_attributes' => array('class' => 'control-label'))));

        $this->add((new Text('logradouro'))
                        ->setLabel('*Rua:')
                        ->setAttributes(array('id' => 'logradouro', 'maxLength' => 100, 'class' => 'form-control'))
                        ->setOptions(array('label_attributes' => array('class' => 'control-label'))));

        $this->add((new Text('numero'))
                        ->setLabel('*Número:')
                        ->setAttributes(array('maxLength' => 100, 'class' => 'form-control', 'id' => 'numero'))
                        ->setOptions(array('label_attributes' => array('class' => 'control-label'))));

        $this->add((new Text('complemento'))
                        ->setLabel('Complemento:')
                        ->setAttributes(array('maxLength' => 100, 'class' => 'form-control', 'id' => 'complemento'))
                        ->setOptions(array('label_attributes' => array('class' => 'control-label'))));

        $this->add((new Textarea('observacoes'))
                        ->setLabel('Observações:')
                        ->setAttributes(['class' => 'form-control', 'rows' => 2, 'id' => 'observacoes'])
                        ->setOptions(['label_attributes' => ['class' => 'control-label']]));

        $this->add((new Text('segunda_sexta_abertura'))
                        ->setLabel('*Segunda a Sexta (abre):')
                        ->setAttributes(array('maxLength' => 5, 'class' => 'form-control timepicker-24', 'placeholder' => 'hh:mm'))
                        ->setOptions(array('label_attributes' => array('class' => 'control-label'))));

        $this->add((new Text('segunda_sexta_fechamento'))
                        ->setLabel('*Segunda a Sexta (fecha):')
                        ->setAttributes(array('maxLength' => 5, 'class' => 'form-control timepicker-24', 'placeholder' => 'hh:mm'))
                        ->setOptions(array('label_attributes' => array('class' => 'control-label'))));

        $this->add((new Text('sabado_abertura'))
                        ->setLabel('*Sábado (abre):')
                        ->setAttributes(array('maxLength' => 5, 'class' => 'form-control timepicker-24', 'placeholder' => 'hh:mm'))
                        ->setOptions(array('label_attributes' => array('class' => 'control-label'))));

        $this->add((new Text('sabado_fechamento'))
                        ->setLabel('*Sábado (fecha):')
                        ->setAttributes(array('maxLength' => 5, 'class' => 'form-control timepicker-24', 'placeholder' => 'hh:mm'))
                        ->setOptions(array('label_attributes' => array('class' => 'control-label'))));

        $this->add((new Text('domingo_abertura'))
                        ->setLabel('Domingo (abre):')
                        ->setAttributes(array('maxLength' => 5, 'class' => 'form-control timepicker-24', 'placeholder' => 'hh:mm'))
                        ->setOptions(array('label_attributes' => array('class' => 'control-label'))));

        $this->add((new Text('domingo_fechamento'))
                        ->setLabel('Domingo (fecha):')
                        ->setAttributes(array('maxLength' => 5, 'class' => 'form-control timepicker-24', 'placeholder' => 'hh:mm'))
                        ->setOptions(array('label_attributes' => array('class' => 'control-label'))));

        $this->add((new Text('royalties_produtos'))
                        ->setLabel('*Royalties Produtos:')
                        ->setAttributes(array('maxLength' => 100, 'class' => 'form-control dinheiro'))
                        ->setOptions(array('label_attributes' => array('class' => 'control-label'))));

        $this->add((new Text('royalties_servicos'))
                        ->setLabel('*Royalties Serviços:')
                        ->setAttributes(array('maxLength' => 100, 'class' => 'form-control dinheiro'))
                        ->setOptions(array('label_attributes' => array('class' => 'control-label'))));
    }

}

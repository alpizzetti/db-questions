<?php

namespace ISConfiguracao\Form;

use Zend\Form\Element\Csrf;
use Zend\Form\Element\Hidden;
use Zend\Form\Element\Select;
use Zend\Form\Element\Text;
use Zend\Form\Form;

class Curso extends Form
{

  public function __construct()
  {
    parent::__construct("form_curso");
    $this->addElements();
  }

  private function addElements()
  {
    $this->setAttribute('method', 'post');
    $this->setInputFilter(new CursoFilter());

    $this->add((new Hidden('id'))->setAttribute("id", "id"));

    $this->add((new Csrf('security')));

    $this->add((new Select())
      ->setLabel('*Status:')
      ->setAttributes(array('class' => 'form-control', 'id' => 'status'))
      ->setName('status')
      ->setOptions(array('label_attributes' => array('class' => 'control-label'), 'value_options' => array(1 => 'Ativo', 0 => 'Inativo'))));

    $this->add((new Text('nome'))
      ->setLabel('*Nome:')
      ->setAttributes(array('maxLength' => 100, 'class' => 'form-control', 'id' => 'nome'))
      ->setOptions(array('label_attributes' => array('class' => 'control-label', 'id' => 'label-nome'))));

    $this->add((new Select())
      ->setLabel('*Unidade:')
      ->setAttributes(array('class' => 'form-control', 'id' => 'unidade'))
      ->setName('unidade')
      ->setOptions(array('label_attributes' => array('class' => 'control-label'), 'value_options' => array('Técnico' => 'Técnico', 'Superior' => 'Superior'))));

    $this->add((new Select())
      ->setLabel('*Tipo:')
      ->setAttributes(array('class' => 'form-control', 'id' => 'tipo'))
      ->setName('tipo')
      ->setOptions(array('label_attributes' => array('class' => 'control-label'), 'value_options' => array('tec' => 'Técnico', 'sup' => 'Superior'))));
  }
}

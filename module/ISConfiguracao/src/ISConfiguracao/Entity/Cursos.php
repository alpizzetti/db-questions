<?php

namespace ISCadastro\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Stdlib\Hydrator;

/**
 * @ORM\Table(name="cursos")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="CursosRepository")
 */
class Cursos
{

  /**
   * @var integer
   *
   * @ORM\Column(name="id", type="integer", nullable=false)
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="IDENTITY")
   */
  private $id;

  /**
   * @ORM\OneToOne(targetEntity="ISConfiguracao\Entity\Unidade")
   * @ORM\JoinColumn(name="unidade", referencedColumnName="id")
   */
  private $unidade;

  /**
   * @var string
   *
   * @ORM\Column(name="nome", type="string", length=100, precision=0, scale=0, nullable=false, unique=false)
   */
  private $nome;

  /**
   * @var string
   *
   * @ORM\Column(name="tipo", type="string", length=5, precision=0, scale=0, nullable=false, unique=false)
   */
  private $tipo;

  public function __construct(array $options = array())
  {
    (new Hydrator\ClassMethods)->hydrate($options, $this);
  }


  public function getId()
  {
    return $this->id;
  }

  public function setId($id)
  {
    $this->id = $id;

    return $this;
  }

  public function getNome()
  {
    return $this->nome;
  }

  public function setNome(string $nome)
  {
    $this->nome = $nome;

    return $this;
  }

  public function getTipo()
  {
    return $this->tipo;
  }

  public function setTipo(string $tipo)
  {
    $this->tipo = $tipo;

    return $this;
  }

  public function getUnidade()
  {
    return $this->unidade;
  }

  public function setUnidade(\ISConfiguracao\Entity\Unidade $unidade)
  {
    $this->unidade = $unidade;

    return $this;
  }
}

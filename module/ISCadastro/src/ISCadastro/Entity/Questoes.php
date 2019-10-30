<?php

namespace ISConfiguracao\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Stdlib\Hydrator;

/**
 * @ORM\Table(name="questoes")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="QuestoesRepository")
 */
class Unidade
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
   * @var string
   *
   * @ORM\Column(name="dificuldade", type="string", length=45, precision=0, scale=0, nullable=false, unique=false)
   */
  private $dificuldade;

  /**
   * @var string
   *
   * @ORM\Column(name="enunciado", type="string", length=100, precision=0, scale=0, nullable=true, unique=false)
   */
  private $enunciado;

  /**
   * @var string
   *
   * @ORM\Column(name="enunciado_img", type="string", length=100, precision=0, scale=0, nullable=true, unique=false)
   */
  private $enunciado_img;

  /**
   * @var string
   *
   * @ORM\Column(name="suporte", type="string", length=100, precision=0, scale=0, nullable=true, unique=false)
   */
  private $suporte;

  /**
   * @var string
   *
   * @ORM\Column(name="suporte_img", type="string", length=100, precision=0, scale=0, nullable=true, unique=false)
   */
  private $suporte_img;

  /**
   * @var string
   *
   * @ORM\Column(name="comando", type="string", length=100, precision=0, scale=0, nullable=false, unique=false)
   */
  private $comando;

  /**
   * @var string
   *
   * @ORM\Column(name="comando_img", type="string", length=100, precision=0, scale=0, nullable=true, unique=false)
   */
  private $comando_img;

  /**
   * @var string
   *
   * @ORM\Column(name="item_a", type="string", length=300, precision=0, scale=0, nullable=false, unique=false)
   */
  private $item_a;

  /**
   * @var string
   *
   * @ORM\Column(name="item_b", type="string", length=300, precision=0, scale=0, nullable=false, unique=false)
   */
  private $item_b;

  /**
   * @var string
   *
   * @ORM\Column(name="item_c", type="string", length=300, precision=0, scale=0, nullable=false, unique=false)
   */
  private $item_c;

  /**
   * @var string
   *
   * @ORM\Column(name="item_d", type="string", length=300, precision=0, scale=0, nullable=false, unique=false)
   */
  private $item_d;

  /**
   * @var string
   *
   * @ORM\Column(name="item_e", type="string", length=300, precision=0, scale=0, nullable=false, unique=false)
   */
  private $item_e;

  /**
   * @var integer
   *
   * @ORM\Column(name="gabarito", type="interger", length=11, precision=0, scale=0, nullable=false, unique=false)
   */
  private $gabarito;

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

  public function getDificuldade()
  {
    return $this->dificuldade;
  }

  public function setDificuldade(string $dificuldade)
  {
    $this->dificuldade = $dificuldade;

    return $this;
  }

  public function getEnunciado()
  {
    return $this->enunciado;
  }

  public function setEnunciado(string $enunciado)
  {
    $this->enunciado = $enunciado;

    return $this;
  }

  public function getEnunciado_img()
  {
    return $this->enunciado_img;
  }

  public function setEnunciado_img(string $enunciado_img)
  {
    $this->enunciado_img = $enunciado_img;

    return $this;
  }

  public function getSuporte()
  {
    return $this->suporte;
  }

  public function setSuporte(string $suporte)
  {
    $this->suporte = $suporte;

    return $this;
  }

  public function getSuporte_img()
  {
    return $this->suporte_img;
  }

  public function setSuporte_img(string $suporte_img)
  {
    $this->suporte_img = $suporte_img;

    return $this;
  }

  public function getComando()
  {
    return $this->comando;
  }

  public function setComando(string $comando)
  {
    $this->comando = $comando;

    return $this;
  }

  public function getComando_img()
  {
    return $this->comando_img;
  }

  public function setComando_img(string $comando_img)
  {
    $this->comando_img = $comando_img;

    return $this;
  }

  public function getItem_a()
  {
    return $this->item_a;
  }

  public function setItem_a(string $item_a)
  {
    $this->item_a = $item_a;

    return $this;
  }

  public function getItem_b()
  {
    return $this->item_b;
  }

  public function setItem_b(string $item_b)
  {
    $this->item_b = $item_b;

    return $this;
  }

  public function getItem_c()
  {
    return $this->item_c;
  }

  public function setItem_c(string $item_c)
  {
    $this->item_c = $item_c;

    return $this;
  }

  public function getItem_d()
  {
    return $this->item_d;
  }

  public function setItem_d(string $item_d)
  {
    $this->item_d = $item_d;

    return $this;
  }

  public function getItem_e()
  {
    return $this->item_e;
  }

  public function setItem_e(string $item_e)
  {
    $this->item_e = $item_e;

    return $this;
  }

  public function getGabarito()
  {
    return $this->gabarito;
  }

  public function setGabarito(string $gabarito)
  {
    $this->gabarito = $gabarito;

    return $this;
  }
}

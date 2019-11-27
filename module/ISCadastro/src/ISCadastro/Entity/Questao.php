<?php

namespace ISCadastro\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Stdlib\Hydrator;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Table(name="questoes")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="QuestaoRepository")
 */
class Questao
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
     * @ORM\OneToOne(targetEntity="ISConfiguracao\Entity\Usuario")
     * @ORM\JoinColumn(name="usuario", referencedColumnName="id")
     *
     */
    private $usuario;

    /**
     * @ORM\OneToOne(targetEntity="ISConfiguracao\Entity\UnidadeCurricular")
     * @ORM\JoinColumn(name="unidade_curricular", referencedColumnName="id")
     */
    private $unidadeCurricular;

    /**
     * @ORM\OneToOne(targetEntity="ISConfiguracao\Entity\Capacidade")
     * @ORM\JoinColumn(name="capacidade", referencedColumnName="id")
     *
     */
    private $capacidade;

    /**
     * @var string
     *
     * @ORM\Column(name="dificuldade", type="string", length=10, precision=0, scale=0, nullable=false, unique=false)
     */
    private $dificuldade;

    /**
     * @var string
     *
     * @ORM\Column(name="enunciado", type="string", precision=0, scale=0, nullable=true, unique=false)
     */
    private $enunciado;

    /**
     * @var string
     *
     * @ORM\Column(name="suporte", type="string", precision=0, scale=0, nullable=true, unique=false)
     */
    private $suporte;

    /**
     * @var string
     *
     * @ORM\Column(name="comando", type="string", precision=0, scale=0, nullable=false, unique=false)
     */
    private $comando;

    /**
     * @var string
     *
     * @ORM\Column(name="item_a", type="string", precision=0, scale=0, nullable=false, unique=false)
     */
    private $itemA;

    /**
     * @var string
     *
     * @ORM\Column(name="item_b", type="string", precision=0, scale=0, nullable=false, unique=false)
     */
    private $itemB;

    /**
     * @var string
     *
     * @ORM\Column(name="item_c", type="string", precision=0, scale=0, nullable=false, unique=false)
     */
    private $itemC;

    /**
     * @var string
     *
     * @ORM\Column(name="item_d", type="string", precision=0, scale=0, nullable=false, unique=false)
     */
    private $itemD;

    /**
     * @var string
     *
     * @ORM\Column(name="item_e", type="string", precision=0, scale=0, nullable=false, unique=false)
     */
    private $itemE;

    /**
     * @var string
     *
     * @ORM\Column(name="gabarito", type="string", length=1, precision=0, scale=0, nullable=true, unique=false)
     */
    private $gabarito;

    /**
     * @var boolean
     *
     * @ORM\Column(name="status", type="boolean", nullable=true)
     */
    private $status;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_criacao", type="datetime", nullable=false)
     */
    private $dataCriacao;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_alteracao", type="datetime", nullable=true)
     */
    private $dataAlteracao;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="ISCadastro\Entity\QuestaoImagem", mappedBy="questao")
     */
    private $imagens;

    public function __construct(array $options = array())
    {
        (new Hydrator\ClassMethods())->hydrate($options, $this);
        $this->dataCriacao = new \DateTime("now");
        $this->imagens = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUsuario()
    {
        return $this->usuario;
    }

    public function getUnidadeCurricular()
    {
        return $this->unidadeCurricular;
    }

    public function getCapacidade()
    {
        return $this->capacidade;
    }

    public function getDificuldade()
    {
        return $this->dificuldade;
    }

    public function getEnunciado()
    {
        return $this->enunciado;
    }

    public function getSuporte()
    {
        return $this->suporte;
    }

    public function getComando()
    {
        return $this->comando;
    }

    public function getItemA()
    {
        return $this->itemA;
    }

    public function getItemB()
    {
        return $this->itemB;
    }

    public function getItemC()
    {
        return $this->itemC;
    }

    public function getItemD()
    {
        return $this->itemD;
    }

    public function getItemE()
    {
        return $this->itemE;
    }

    public function getGabarito()
    {
        return $this->gabarito;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getDataCriacao()
    {
        return $this->dataCriacao;
    }

    public function getDataAlteracao()
    {
        return $this->dataAlteracao;
    }

    public function getImagens()
    {
        return $this->imagens;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
        return $this;
    }

    public function setUnidadeCurricular($unidadeCurricular)
    {
        $this->unidadeCurricular = $unidadeCurricular;
        return $this;
    }

    public function setCapacidade($capacidade)
    {
        $this->capacidade = $capacidade;
        return $this;
    }

    public function setDificuldade($dificuldade)
    {
        $this->dificuldade = $dificuldade;
        return $this;
    }

    public function setEnunciado($enunciado)
    {
        $this->enunciado = $enunciado;
        return $this;
    }

    public function setEnunciadoImg($enunciadoImg)
    {
        $this->enunciadoImg = $enunciadoImg;
        return $this;
    }

    public function setSuporte($suporte)
    {
        $this->suporte = $suporte;
        return $this;
    }

    public function setSuporteImg($suporteImg)
    {
        $this->suporteImg = $suporteImg;
        return $this;
    }

    public function setComando($comando)
    {
        $this->comando = $comando;
        return $this;
    }

    public function setComandoImg($comandoImg)
    {
        $this->comandoImg = $comandoImg;
        return $this;
    }

    public function setItemA($itemA)
    {
        $this->itemA = $itemA;
        return $this;
    }

    public function setItemB($itemB)
    {
        $this->itemB = $itemB;
        return $this;
    }

    public function setItemC($itemC)
    {
        $this->itemC = $itemC;
        return $this;
    }

    public function setItemD($itemD)
    {
        $this->itemD = $itemD;
        return $this;
    }

    public function setItemE($itemE)
    {
        $this->itemE = $itemE;
        return $this;
    }

    public function setGabarito($gabarito)
    {
        $this->gabarito = $gabarito;
        return $this;
    }

    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    public function setDataCriacao()
    {
        $this->dataCriacao = new \DateTime("now");
        return $this;
    }

    public function setDataAlteracao()
    {
        $this->dataAlteracao = new \DateTime("now");
        return $this;
    }

    public function toArray()
    {
        return (new Hydrator\ClassMethods())->extract($this);
    }
}

<?php

namespace ISConfiguracao\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Stdlib\Hydrator;

/**
 * @ORM\Table(name="cursos")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="CursoRepository")
 */
class Curso {

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

    public function __construct(array $options = array()) {
        (new Hydrator\ClassMethods)->hydrate($options, $this);
        $this->dataCriacao = new \DateTime("now");
    }

    public function getId() {
        return $this->id;
    }

    public function getUnidade() {
        return $this->unidade;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getTipo() {
        return $this->tipo;
    }

    public function getStatus() {
        return $this->status;
    }

    public function getDataCriacao() {
        return $this->dataCriacao;
    }

    public function getDataAlteracao() {
        return $this->dataAlteracao;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setUnidade($unidade) {
        $this->unidade = $unidade;
    }

    public function setNome($nome) {
        $this->nome = \ISBase\Util\IdealizeUtil::normalizarNome($nome);
    }

    public function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function setDataCriacao() {
        $this->dataCriacao = new \DateTime("now");
        return $this;
    }

    public function setDataAlteracao() {
        $this->dataAlteracao = new \DateTime("now");
        return $this;
    }

    public function toArray() {
        return (new Hydrator\ClassMethods())->extract($this);
    }

}

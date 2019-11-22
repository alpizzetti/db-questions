<?php

namespace ISConfiguracao\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Stdlib\Hydrator;

/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="grupos")
 * @ORM\Entity(repositoryClass="ISConfiguracao\Entity\GrupoRepository")
 */
class Grupo
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="ISConfiguracao\Entity\Grupo")
     * @ORM\JoinColumn(name="herda", referencedColumnName="id")
     */
    private $herda;

    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=100, nullable=false)
     */
    private $nome;

    /**
     * @ORM\Column(name="administrador", type="boolean")
     * @var boolean
     */
    private $administrador;

    /**
     * @ORM\Column(name="professor", type="boolean")
     * @var boolean
     */
    private $professor;

    /**
     * @ORM\Column(name="moderador", type="boolean")
     * @var boolean
     */
    private $moderador;

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

    public function __construct($options = array())
    {
        (new Hydrator\ClassMethods())->hydrate($options, $this);
        $this->dataCriacao = new \DateTime("now");
    }

    public function getId()
    {
        return $this->id;
    }

    public function getHerda()
    {
        return $this->herda;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function getAdministrador()
    {
        return $this->administrador;
    }

    public function getProfessor()
    {
        return $this->professor;
    }

    public function getModerador()
    {
        return $this->moderador;
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

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function setHerda($herda)
    {
        $this->herda = $herda;
        return $this;
    }

    public function setNome($nome)
    {
        $this->nome = \ISBase\Util\IdealizeUtil::normalizarNome($nome);
        return $this;
    }

    public function setAdministrador($administrador)
    {
        $this->administrador = $administrador;
        return $this;
    }

    public function setProfessor($professor)
    {
        $this->professor = $professor;
    }

    public function setModerador($moderador)
    {
        $this->moderador = $moderador;
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

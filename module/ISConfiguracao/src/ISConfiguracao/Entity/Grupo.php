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
class Grupo {

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
     * @var boolean
     *
     * @ORM\Column(name="status", type="boolean", nullable=true)
     */
    private $status;

    public function __construct($options = array()) {
        (new Hydrator\ClassMethods)->hydrate($options, $this);
    }

    public function getId() {
        return $this->id;
    }

    public function getHerda() {
        return $this->herda;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getAdministrador() {
        return $this->administrador;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setHerda($herda) {
        $this->herda = $herda;
        return $this;
    }

    public function setNome($nome) {
        $this->nome = $nome;
        return $this;
    }

    public function setAdministrador($administrador) {
        $this->administrador = $administrador;
        return $this;
    }

    public function setStatus($status) {
        $this->status = $status;
        return $this;
    }

    public function toArray() {
        return (new Hydrator\ClassMethods())->extract($this);
    }

}

<?php

namespace ISConfiguracao\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Stdlib\Hydrator;

/**
 * @ORM\Table(name="usuarios_acessos")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="ISConfiguracao\Entity\UsuarioAcessoRepository")
 */
class UsuarioAcesso {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @ORM\OneToOne(targetEntity="ISConfiguracao\Entity\Usuario")
     * @ORM\JoinColumn(name="usuario", referencedColumnName="id")
     */
    protected $usuario;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data", type="datetime", nullable=true)
     */
    private $data;

    public function __construct(array $options = array()) {
        (new Hydrator\ClassMethods)->hydrate($options, $this);
        $this->data = new \DateTime("now");
    }

    public function getId() {
        return $this->id;
    }

    public function getUsuario() {
        return $this->usuario;
    }

    public function getData() {
        return $this->data;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setUsuario($usuario) {
        $this->usuario = $usuario;
        return $this;
    }

    public function setData(\DateTime $data) {
        $this->data = $data;
        return $this;
    }

    public function toArray() {
        return (new Hydrator\ClassMethods())->extract($this);
    }

}
